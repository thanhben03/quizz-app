<?php

namespace App\Http\Controllers;

use App\Repositories\Student\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $studentRepo;

    public function __construct(StudentRepositoryInterface $studentRepo)
    {
        $this->studentRepo = $studentRepo;
    }

    public function deleteStudent($user_id)
    {
        return $this->studentRepo->deleteStudent($user_id);
    }

    public function countSubmitted()
    {
        return $this->studentRepo->countSubmitted();
    }

    public function getStudent()
    {
        return $this->studentRepo->getStudent();
    }
}
