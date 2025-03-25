<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\TeacherController;
use App\Http\Controllers\Api\V1\SubjectController;
use App\Http\Controllers\Api\V1\ClassroomController;
use App\Http\Controllers\Api\V1\ExamController;
use App\Http\Controllers\Api\V1\SectionController;


Route::prefix('v1')->controller(StudentController::class)->group(function () {
    // Specific routes for student statuses
    Route::get('/students/pending', 'getpendingStudents');
    Route::get('/students/approved', 'getapprovedStudents'); //MSG: Not implemented
    Route::get('/students/rejected', 'getrejectedStudents'); //MSG: Not implemented

    // Dynamic routes for student operations
    Route::get('/students', 'index');
    Route::post('/students', 'store');
    Route::get('/students/{slug}', 'show');
    Route::put('/students/{slug}', 'update');
    Route::patch('/students/{slug}', 'update');
    Route::delete('/students/{slug}', 'destroy');

    Route::post('/students/{slug}/create-user', 'createUserAccount'); //MSG: Not implemented
    Route::patch('/students/{slug}/approve', 'approveStudent'); //MSG: Not implemented
    Route::patch('/students/{slug}/reject', 'rejectStudent'); //MSG: Not implemented
});



Route::prefix('v1')->group(function () {

    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::post('/teachers', [TeacherController::class, 'store']);
    Route::get('/teachers/{id}', [TeacherController::class, 'show']);
    Route::put('/teachers/{id}', [TeacherController::class, 'update']);
    Route::patch('/teachers/{id}', [TeacherController::class, 'update']);
    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']);
    Route::post('/teachers/{id}/create-user', [TeacherController::class, 'createTeacherAccount']);

    Route::get('/subjects', [SubjectController::class, 'index']);
    Route::post('/subjects', [SubjectController::class, 'store']);
    Route::get('/subjects/{id}', [SubjectController::class, 'show']);
    Route::put('/subjects/{id}', [SubjectController::class, 'update']);
    Route::patch('/subjects/{id}', [SubjectController::class, 'update']);
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']);

    Route::get('/classrooms', [ClassroomController::class, 'index']);
    Route::post('/classrooms', [ClassroomController::class, 'store']);
    Route::get('/classrooms/{id}', [ClassroomController::class, 'show']);
    Route::put('/classrooms/{id}', [ClassroomController::class, 'update']);
    Route::patch('/classrooms/{id}', [ClassroomController::class, 'update']);
    Route::delete('/classrooms/{id}', [ClassroomController::class, 'destroy']);

    Route::get('/sections', [SectionController::class, 'index']);
    Route::post('/sections', [SectionController::class, 'store']);
    Route::get('/sections/{id}', [SectionController::class, 'show']);
    Route::put('/sections/{id}', [SectionController::class, 'update']);
    Route::patch('/sections/{id}', [SectionController::class, 'update']);
    Route::delete('/sections/{id}', [SectionController::class, 'destroy']);

    Route::get('/exams', [ExamController::class, 'index']);
    Route::post('/exams', [ExamController::class, 'store']);
    Route::get('/exams/{exam}', [ExamController::class, 'show']);
    Route::put('/exams/{exam}', [ExamController::class, 'update']);
    Route::delete('/exams/{exam}', [ExamController::class, 'destroy']);
});