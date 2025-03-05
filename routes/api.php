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

Route::prefix('v1')->group(function () {
    Route::get('/students', [StudentController::class, 'index']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{student}', [StudentController::class, 'show']);
    Route::put('/students/{student}', [StudentController::class, 'update']);
    Route::patch('/students/{student}', [StudentController::class, 'update']);
    Route::delete('/students/{student}', [StudentController::class, 'destroy']);
    Route::post('/students/{studentId}/create-user', [StudentController::class, 'createUserAccount']);

    Route::get('/teachers', [TeacherController::class, 'index']); // Get all teachers (paginated)
    Route::post('/teachers', [TeacherController::class, 'store']); // Create a new teacher
    Route::get('/teachers/{id}', [TeacherController::class, 'show']); // Get a specific teacher
    Route::put('/teachers/{id}', [TeacherController::class, 'update']); // Update a teacher
    Route::patch('/teachers/{id}', [TeacherController::class, 'update']); // Partial update
    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']); // Delete a teacher
    Route::post('/teachers/{id}/create-user', [TeacherController::class, 'createTeacherAccount']);

    Route::get('/subjects', [SubjectController::class, 'index']);
    Route::post('/subjects', [SubjectController::class, 'store']);
    Route::get('/subjects/{id}', [SubjectController::class, 'show']);
    Route::put('/subjects/{id}', [SubjectController::class, 'update']);
    Route::patch('/subjects/{id}', [SubjectController::class, 'update']);
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']);

});
