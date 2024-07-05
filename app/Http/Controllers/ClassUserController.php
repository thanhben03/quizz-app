<?php

namespace App\Http\Controllers;

use App\Repositories\ClassUser\ClassUserRepositoryInterface;
use Illuminate\Http\Request;

class ClassUserController extends Controller
{
    private $classUserRepo;

    public function __construct(ClassUserRepositoryInterface $classUserRepo)
    {
        $this->classUserRepo = $classUserRepo;
    }

    public function index()
    {
        return $this->classUserRepo->index();
    }
}
