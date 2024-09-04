<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', '/student');

Route::get('/index', function () {
    return view('index');
});
Route::resource('/student', StudentController::class);
