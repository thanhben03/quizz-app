<?php

namespace App\Http\Controllers;

use App\Repositories\Exam\ExamRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    private $examRepo;

    public function __construct(ExamRepositoryInterface $examRepo)
    {
        $this->examRepo = $examRepo;
    }

    public function scanQuestionFromImage(Request $request)
    {
        $file = $request->file('uploadFile');
        return $this->examRepo->scanQuestionFromImage($file['raw']);
    }

    public function spellChecking(Request $request)
    {
        $sentence = $request->sentence;
        return $this->examRepo->spellChecking($sentence);
    }

    public function createExam(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'duration' => 'required',
            'password' => 'required',
            'status' => 'required',
            'point' => 'required',
        ]);
        $questions = $request->questions;
        // dd(Auth::user()->teacher);
        $validated['teacher_id'] = Auth::user()->id;
        return $this->examRepo->createExam($validated, $questions);
    }

    public function getAll()
    {
        return $this->examRepo->getAll();
    }

    public function getPractice()
    {
        return $this->examRepo->getPractice();
    }

    public function edit($exam_id)
    {
        return $this->examRepo->edit($exam_id);
    }

    public function updateExamAndQuestions(Request $request)
    {
        $exam = $request->exam;
        $questions = $request->questions;
        // dd(1);
        return $this->examRepo->updateExamAndQuestions($exam, $questions);
    }
    public function deleteExam($exam_id)
    {
        return $this->examRepo->deleteExam($exam_id);
    }

    public function getExamAndQuestion($exam_id)
    {
        $data = $this->examRepo->getExamAndQuestion($exam_id);

        return response()->json($data);
    }

    public function getMark(Request $request)
    {
        $dataExam = $request->answers;
        $type_id = $request->type_id;
        $type_log = $request->type_log;
        return $this->examRepo->getMark($dataExam, $type_id, $type_log);
    }

    public function joinPractice($practice_id)
    {
        return $this->examRepo->joinPractice($practice_id);
    }

    public function checkPass(Request $request)
    {
        $exam_id = $request->exam_id;
        $password = $request->password;

        return $this->examRepo->checkPass($exam_id, $password);
    }

}
