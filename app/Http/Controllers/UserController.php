<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Traits\ResponseTrait;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseTrait;
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function index()
    {
        return $this->userRepo->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        return $this->userRepo->store($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        $data = $request->all();
        return $this->userRepo->login($data);
    }

    public function user(Request $request)
    {
        // return response()->json($request->cookie());
        return $this->userRepo->user();
    }

    public function logout()
    {
        return $this->userRepo->logout();
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        return $this->userRepo->register($data);
    }

    public function changePass(Request $request)
    {

        return $this->userRepo->changePass($request->oldPassword, $request->newPassword);
    }

    public function changeAvatar(Request $request)
    {
        $file = $request->file;
        return $this->userRepo->changeAvatar($file);
    }

    public function changeClass(Request $request)
    {
        $classId = $request->classId;
        return $this->userRepo->changeClass($classId);
    }

    public function rank($type)
    {
        return $this->userRepo->rank($type);
    }
}
