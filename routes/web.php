<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('dashboard', function () {
    return view('web.dashboard');
})->name('dashboard');

Route::prefix('student')->group(function () {

    Route::get('/', function () {
        return view('web.student.index');
    })->name('student.index');

    // Route::get('create', 'StudentController@create');
    // Route::post('store', 'StudentController@store');
    // Route::get('edit/{id}', 'StudentController@edit');
    // Route::post('update/{id}', 'StudentController@update');
    // Route::get('delete/{id}', 'StudentController@delete');
});
