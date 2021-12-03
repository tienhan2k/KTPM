<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\SocialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/student', StudentController::class)->names('student')->middleware('auth');
// Route::post('/student/create', [StudentController::class,'create'])->middleware('auth');
// Route::get('/student/{student}/edit', [StudentController::class,'edit'])->name('edit')->middleware('auth');
// Route::put('/student/{student} ', [StudentController::class,'update']);
// Route::get('/student', [StudentController::class,'index'])->name('student')->middleware('auth');

// Route::get('/student', [StudentController::class,'index'])->name('student')->middleware('auth');

Route::get('/redirect-google', [SocialController::class, 'redirectGoogle'])->name('redirectGoogle');
Route::get('/google_callback', [SocialController::class, 'processGoogleLogin']);
