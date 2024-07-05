<?php

namespace App\Repositories\Student;

use App\Http\Traits\ResponseTrait;
use App\Models\Student;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    use ResponseTrait;
    public function getModel()
    {
        return Student::class;
    }

    public function getStudentOfTeacher()
    {
        // $teacher_id = Auth::user()->teacher->id;
        $teacher_class_id = Auth::user()->class_id;
        $student = DB::table('users')
            ->where('class_id', $teacher_class_id);
        return $this->responseSuccess($student);
    }

    public function deleteStudent($user_id)
    {
        try {
            $user = User::find($user_id);
            $user->delete();

            return $this->responseSuccess('Xóa thành công !');
        } catch (\Throwable $th) {
            return $this->responseError('Đã xảy ra lỗi !');

        }
    }

    public function countSubmitted()
    {
        $count = User::withCount('log_practice')->find(Auth::user()->id);
    }

    public function getStudent()
    {
        $user = User::withCount('log_practice')->withSum('log_practice', 'point')->find(Auth::user()->id);
        return $this->responseSuccess($user);
    }
}
