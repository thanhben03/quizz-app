<?php

use App\Http\Controllers\ClassUserController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/user', [UserController::class, 'user']);
    Route::get('/auth/logout', [UserController::class, 'logout']);
    Route::post('/auth/change-pass', [UserController::class, 'changePass']);
    Route::post('/auth/change-avatar', [UserController::class, 'changeAvatar']);
    Route::post('/auth/change-class', [UserController::class, 'changeClass']);

    Route::get('/user/rank/{type}', [UserController::class, 'rank']);

    Route::resource('/class', ClassUserController::class);
    Route::post('/exam/scanQuestion', [ExamController::class, 'scanQuestionFromImage']);
    Route::post('/exam/create', [ExamController::class, 'createExam']);
    Route::delete('/exam/{exam_id}', [ExamController::class, 'deleteExam']);
    Route::get('/exam', [ExamController::class, 'getAll']);
    Route::get('/exam/practice', [ExamController::class, 'getPractice']);
    Route::get('/exam/join/{exam_id}', [ExamController::class, 'joinPractice']);
    Route::get('/exam/{exam_id}/edit', [ExamController::class, 'edit']);
    Route::post('/exam/updateExamAndQuestions', [ExamController::class, 'updateExamAndQuestions']);
    Route::post('/exam/getMark', [ExamController::class, 'getMark']);
    Route::post('/exam/check_pass', [ExamController::class, 'checkPass']);

    Route::get('/teacher/getStudentsOfTeacher', [TeacherController::class, 'getStudentsOfTeacher']);
    Route::put('/teacher/{student_id}/updateStudent', [TeacherController::class, 'updateStudent']);

    Route::get('/student', [StudentController::class, 'getStudent']);
    Route::delete('/student/{user_id}', [StudentController::class, 'deleteStudent']);
    Route::get('/student/count_submitted', [StudentController::class, 'countSubmitted']);

    Route::get('/contest', [ContestController::class, 'getAllContest']);
    Route::get('/contest/join/{contest_id}', [ContestController::class, 'joinContest']);



});

Route::post('/auth/register', [UserController::class,'register']);
Route::post('/exam/check', [ExamController::class,'spellChecking']);
