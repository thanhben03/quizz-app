<?php

namespace App\Http\Controllers;

use App\Repositories\Teacher\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private $teacherRepo;

    public function __construct(TeacherRepositoryInterface $teacherRepo)
    {
        $this->teacherRepo = $teacherRepo;
    }

    public function getStudentsOfTeacher()
    {
        return $this->teacherRepo->getStudentsOfTeacher();
    }

    public function updateStudent(Request $request, $student_id)
    {
        $dataStudent = $request->except(['class_name', 'id']);
        return $this->teacherRepo->updateStudent($dataStudent, $student_id);
    }
}
