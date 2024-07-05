<?php

namespace App\Repositories\Exam;

use App\Http\Traits\ResponseTrait;
use App\Models\Contest;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Practice;
use App\Models\Question;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ExamRepository extends BaseRepository implements ExamRepositoryInterface
{
    use ResponseTrait;
    public function getModel()
    {
        return Exam::class;
    }

    public function scanQuestionFromImage($fileImage)
    {
        try {
            $text = (new TesseractOCR($fileImage))
                ->lang('vie')
                ->run();
            $init_questions = explode("Câu", $text);
            $question_options = []; // cau hoi va cau tra loi
            $questions = $options = [];
            foreach ($init_questions as $item) {
                if ($item != '') {
                    $item = str_replace("\n", " ", $item);
                    $item = substr($item, 4); // cau 1: 1 + 1 => 1 + 1
                    array_push($question_options, $item);
                }
            }

            foreach ($question_options as $item) {
                $pos = strpos($item, 'A');
                $question = trim(substr($item, 0, $pos));
                $option = substr($item, $pos, strlen($item));

                $questions[] = [
                    'question' => $question,
                    'option' => $this->getAnswer($option)
                ];
                // dd($questions);
                $options[] = $this->getAnswer($option);
            }

            return response()->json($questions);
        } catch (\Throwable $th) {
            return $this->responseError($th->getMessage());
        }
    }

    public function getAnswer($option)
    {
        $option_filter = [];
        $original_string = $option;
        // Tách chuỗi thành các phần tử dựa trên dấu chấm câu và khoảng trắng
        $elements = explode(". ", $original_string);
        for ($i = 0; $i < count($elements); $i += 2) {
            if ($i != count($elements) - 1) {
                $new_string = trim($elements[$i] . ': ' . $elements[$i + 1]);
                $option_filter[] = $new_string;
            }
        }
        return $option_filter;
    }

    public function spellChecking($sentence)
    {
        // Tạo đối tượng curl
        $curl = curl_init();

        // Thiết lập URL của API
        curl_setopt($curl, CURLOPT_URL, 'https://viettelgroup.ai/nlp/api/v1/spell-checking');

        // Thiết lập headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'token: 2TW-aQFY2CxExkGsTC8o7L7-KVqMuJhRIjhovuA1EODRVExuLNxNxsxxz22uaGyJ',
        ));

        // Thiết lập dữ liệu gửi lên
        $data = json_encode(array(
            'sentence' => $sentence,
        ));

        // Thiết lập phương thức gửi là POST
        curl_setopt($curl, CURLOPT_POST, 1);

        // Thiết lập dữ liệu gửi
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // Thực thi curl
        $result = curl_exec($curl);

        // Đóng kết nối curl
        curl_close($curl);

        // Xử lý kết quả
        if ($result) {
            // Xử lý kết quả thành JSON
            $response = json_decode($result);

            return response()->json($response);
        } else {
            // Xử lý lỗi
            echo 'Có lỗi xảy ra!';
        }
    }

    public function createExam($data, $questions)
    {
        try {
            $exam = Exam::create($data);
            $this->createQuestions($questions, $exam->id);
            return $this->responseSuccess($exam);
        } catch (\Throwable $th) {
            return $this->responseError($th->getMessage());
        }
    }
    public function createQuestions($questions, $exam_id)
    {
        // DB::transaction();

        try {
            foreach ($questions as $item) {
                $question = $item['question'];
                $options = $item['option'];
                $optonsArr = [];

                $lastId = DB::table('questions')->insertGetId([
                    'exam_id' => $exam_id,
                    'question_text' => $question,
                ]);

                foreach ($options as $item) {
                    $optonsArr[] = [
                        'question_id' => $lastId,
                        'option_text' => $item
                    ];
                }

                DB::table('options')->insert($optonsArr);
            }
        } catch (\Throwable $th) {
            // DB::rollback();
        }
    }

    public function getAll()
    {
        // $teacher_id = Auth::user->id;
        // $exam = Practice::with('exam')->get();
        $exam = Exam::get();
        // dd($exam);
        return $this->responseSuccess($exam);
    }

    public function getPractice()
    {
        $practices = Practice::with('exam')->where('status',1)->get();
        return $this->responseSuccess($practices);

    }

    public function getAllByTeacherId()
    {
        $teacher_id = Auth::user()->teacher->id;
        $exam = Exam::where('teacher_id', $teacher_id)->with('questions')->get();
        return $this->responseSuccess($exam);
    }


    public function edit($exam_id)
    {
        $data = $this->getExamAndQuestion($exam_id);
        return $this->responseSuccess($data);
    }

    public function getExamAndQuestion($exam_id)
    {
        $exam = Exam::where('id', $exam_id)->first();
        $data = [
            'exam' => $exam
        ];
        $filter = [];
        $questions = $exam->questions;
        foreach ($questions as $item) {
            $options = $item->options->toArray();
            $filter[] = [
                'question' => $item->question_text,
                'question_id' => $item->id,
                'correct_option' => $item->correct_option,
                'option' => $options
            ];
        }
        $data['questions'] = $filter;

        return $data;
    }

    public function joinPractice($practice_id)
    {
        $practice = Practice::find($practice_id);
        $exam = $this->getExamAndQuestion($practice->exam_id);
        $exam['start_time'] = $practice->start_time;
        $exam['end_time'] = $practice->end_time;
        return $this->responseSuccess($exam);
    }

    public function updateExamAndQuestions($examData, $questionsData)
    {
        try {
            $exam_id = $examData['id'];
            $exam = Exam::find($exam_id);
            $exam->update($examData);
            $optionArr = [];
            $this->createContestOrPractice($exam_id, $examData['type'], $examData['status']);
            foreach ($questionsData as $item) {
                $question = Question::find($item['question_id']);
                $question->question_text = $item['question'];
                $question->correct_option = $item['correct_option'];
                $question->save();
                foreach ($item['option'] as $option) {
                    $optionArr[] = [
                        'id' => $option['id'],
                        'option_text' => $option['option_text'],
                        'question_id' => $question->id
                    ];
                }

                DB::table('options')->upsert($optionArr, ['id', 'question_id'], ['option_text']);
            }
            return $this->responseSuccess('Cập nhật thành công !');
        } catch (\Throwable $th) {
            return $this->responseError($th->getMessage());
        }
    }

    public function createContestOrPractice($exam_id, $type, $status)
    {
        try {
            $today = date('Y-m-d H:i:s');
            $data = [
                'exam_id' => $exam_id,
                'status' => $status,
                'start_time' => $today,
            ];
            if ($type != 'practices') {
                $data['end_time'] = $today;
            }

            if ($practice = Practice::where('exam_id', $exam_id)) {
                $practice->delete();
            }
            if ($contest = Contest::where('exam_id', $exam_id)) {
                $contest->delete();
            }


            DB::table($type)
                ->insert($data);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteExam($exam_id)
    {
        try {
            $exam = Exam::find($exam_id);
            $exam->delete();
            return $this->responseSuccess('Xóa thành công !');
        } catch (\Throwable $th) {
            return $this->responseError($th->getMessage());
        }
    }

    public function getMark($dataExam, $type_id, $type_log)
    {
        $questionIds = array_column($dataExam, 'question_id');
        $optionIds = array_column($dataExam, 'option_id');
        $questions_correct = DB::table('questions')
            ->whereIn('id', $questionIds)
            ->whereIn('correct_option', $optionIds)
            ->get();
        $result = [
            'question_correct' => $questions_correct,
            'total' => $questions_correct->count()
        ];

        $log = [
            'user_id' => Auth::user()->id,
            'point' => $questions_correct->count(),
            'created_at' => date('Y-m-d H:i:s')
        ];
        if ($type_log == 'log_practice') {
            $log['practice_id'] = $type_id;
        } else {
            $log['contest_id'] = $type_id;
        }
        // update log practice
        DB::table($type_log)
            ->insert($log);

        return $this->responseSuccess($result);
    }

    public function checkPass($exam_id, $password)
    {
        $exam = Exam::find($exam_id);
        if ($exam->password != $password) {
            return $this->responseError('Sai password');
        }

        return $this->responseSuccess('success');
    }
}
