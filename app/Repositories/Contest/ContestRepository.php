<?php

namespace App\Repositories\Contest;

use App\Http\Traits\ResponseTrait;
use App\Models\Contest;
use App\Models\Exam;
use App\Repositories\BaseRepository;


class ContestRepository extends BaseRepository implements ContestRepositoryInterface
{
    use ResponseTrait;
    public function getModel()
    {
        return Contest::class;
    }

    public function getAllContest()
    {
        $exam = $this->model->with('exam')->get();
        return $this->responseSuccess($exam);
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

    public function joinContest($contest_id)
    {
        $contest = Contest::find($contest_id);
        $exam = $this->getExamAndQuestion($contest->exam_id);
        // $exam['start_time'] = $contest->start_time;
        // $exam['end_time'] = $contest->end_time;
        return $this->responseSuccess($exam);
    }

}
