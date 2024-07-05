<?php

namespace App\Repositories\Student;

use App\Repositories\Interfaces\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface {
    public function getStudentOfTeacher();
    public function deleteStudent($student_id);
    public function countSubmitted();
    public function getStudent();

}


?>
