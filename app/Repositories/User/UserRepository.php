<?php

namespace App\Repositories\User;

use App\Http\Traits\ResponseTrait;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Sami\Parser\Filter\CloudinaryFilter;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    use ResponseTrait;
    public function getModel()
    {
        return User::class;
    }

    public function login($data = [])
    {
        $email = $data['email'];
        $password = $data['password'];

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return response([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }
        /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;

        // $cookie = cookie('jwt', $token, 1); // 1 day

        return response([
            'message' => $token,
            'user' => $user
        ]);
    }

    public function user()
    {
        $user = User::find(Auth::id());
        return $user;
    }
    public function logout()
    {
        /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
        }
    }

    public function register($data)
    {
        try {
            $user = DB::table('users')->insert($data);
            return response()->json($user);
        } catch (QueryException $th) {
            return response()->json($th->getMessage());
        }
    }


    public function changePass($oldPassword, $newPassword)
    {
        $user = User::find(Auth::id());

        if (!Hash::check($oldPassword, $user->password)) {
            return $this->responseError('Mật khẩu hiện tại không đúng !', 501);
        }

        $newPassword = Hash::make($newPassword);
        $user->password = $newPassword;
        try {
            $user->save();
            return $this->responseSuccess('Thay đổi mật khẩu thành công !');
        } catch (\Throwable $th) {
            return $this->responseError($th->getMessage(), 501);
        }
    }

    public function changeAvatar($file)
    {
        try {
            $urlImage = Cloudinary::upload($file->getRealPath())->getSecurePath();
            $user = User::find(Auth::id());
            $user->avatar = $urlImage;
            $user->save();
            return $this->responseSuccess([
                'message' => 'Cập nhật thành công !',
                'url' => $user->avatar
            ]);
        } catch (\Throwable $th) {
            return $this->responseError($th->getMessage());
        }
    }

    public function changeClass($classId)
    {
        $user = $this->user();
        try {
            $user->class_id = $classId;
            $user->save();
            return $this->responseSuccess('Cập nhật thành công !');
        } catch (\Throwable $th) {
            return $this->responseError('Lỗi: ' . $th->getMessage());
        }
    }

    public function rank($type)
    {
        $query = DB::table('users AS u')
            ->Join('log_contest AS lp', 'u.id', '=', 'lp.user_id')
            ->Join('classes AS cl', 'u.class_id', '=', 'cl.id')
            ->select([
                DB::raw('SUM(lp.point) AS point'),
                'u.fullname',
                'u.avatar',
                'cl.name AS class_name',
            ])
            ->groupBy([
                'u.fullname',
                'u.avatar',
                'class_name',
            ])
            ->limit(10)
            ->orderBy('point', 'desc');
        if ($type == 'filter_month') {
            // dd(date('n'));
            $query->whereMonth('lp.created_at', '=', date('m'));
        } else if ($type == 'filter_year') {

            $query->whereYear('lp.created_at', '=', date('Y'));
        } else {
            $query->whereDate('lp.created_at', '=', date("Y-m-d"));
        }
        // echo date("m/d/Y");
        // print_r($query);
        $resultRank = $query->get();

        return $this->responseSuccess($resultRank);
    }
}
