<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [MainPageController::class, 'index'])->name('index.show');


Auth::routes();

//PROFILE
Route::get('profil', [ProfileController::class, 'show'])->name('profile.show');
Route::get('profil/edytuj', [ProfileController::class, 'editShow'])->name('profile_edit.show');
Route::post('profil/edytuj/zapisz', [ProfileController::class, 'edit'])->name('profile.edit');


Route::get('dyrektor', [HomeController::class, 'directorHome'])->name('director_home.show')->middleware('is_director');
Route::get('nauczyciel', [HomeController::class, 'teacherHome'])->name('teacher_home.show')->middleware('is_teacher');
Route::get('rodzic', [HomeController::class, 'parentHome'])->name('parent_home.show')->middleware('is_parent');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
