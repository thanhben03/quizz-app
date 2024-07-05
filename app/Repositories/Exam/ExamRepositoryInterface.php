<?php

namespace App\Repositories\Exam;

use App\Repositories\Interfaces\RepositoryInterface;

interface ExamRepositoryInterface extends RepositoryInterface {
    public function scanQuestionFromImage($fileImage);
    public function spellChecking($sentence);
    public function createExam($data, $questions);
    public function createQuestions($data, $exam_id);
    public function getAll();
    public function getPractice();
    public function getAllByTeacherId();
    public function edit($exam_id);
    public function updateExamAndQuestions($examData, $questionsData);
    public function deleteExam($exam_id);
    public function getExamAndQuestion($exam_id);
    public function getMark($dataExam, $practice_id, $type_log);
    public function joinPractice($practice_id);
    public function createContestOrPractice($exam_id,$type, $status);
    public function checkPass($exam_id,$password);
}


?>
