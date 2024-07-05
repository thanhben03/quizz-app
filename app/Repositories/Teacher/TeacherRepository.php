<?php

namespace App\Repositories\Teacher;

use App\Http\Traits\ResponseTrait;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherRepository extends BaseRepository implements TeacherRepositoryInterface
{
    use ResponseTrait;
    public function getModel()
    {
        return Teacher::class;
    }

    public function getStudentsOfTeacher()
    {
        // $teacher_id = Auth::user()->teacher->id;
        $teacher_class_id = Auth::user()->class_id;
        // dd($teacher_class_id);
        $students = DB::table('users as u')
            ->where('class_id', $teacher_class_id)
            ->whereNotIn('u.id', [Auth::user()->id])
            ->join('classes', 'u.class_id', '=', 'classes.id')
            ->get(['u.id','u.username', 'u.fullname','u.avatar', 'classes.name as class_name', 'u.email']);
        return $this->responseSuccess($students);
    }

    public function updateStudent($dataStudent, $student_id) {
        try {
            DB::table('users')
                ->where('id', $student_id)
                ->update($dataStudent);
            return $this->responseSuccess('Cập nhật thành công !');
        } catch (\Throwable $th) {
            return $this->responseError($th->getMessage());

        }
    }
}
