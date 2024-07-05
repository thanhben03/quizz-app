<?php

namespace App\Repositories\User;

use App\Repositories\Interfaces\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface {
    public function login($data = []);
    public function user();
    public function logout();
    public function register($data);
    public function changePass($oldPassword, $newPassword);
    public function changeAvatar($file);
    public function changeClass($classId);
    public function rank($type);
}


?>
