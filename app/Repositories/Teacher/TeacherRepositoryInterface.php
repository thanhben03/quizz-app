<?php

namespace App\Repositories\Teacher;

use App\Repositories\Interfaces\RepositoryInterface;

interface TeacherRepositoryInterface extends RepositoryInterface {
    public function getStudentsOfTeacher();
    public function updateStudent($dataStudent,$student_id);
}


?>
