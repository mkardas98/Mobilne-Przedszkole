<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('dyrektor', [HomeController::class, 'directorHome'])->name('director.home')->middleware('is_director');
Route::get('nauczyciel', [HomeController::class, 'teacherHome'])->name('teacher.home')->middleware('is_teacher');
Route::get('rodzic', [HomeController::class, 'parentHome'])->name('parent.home')->middleware('is_parent');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
