<?php

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\AttendanceListController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonPlansController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KidsController;
use App\Http\Controllers\UsersController;
use App\Models\LessonPlan;
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
Route::match(['get', 'post'], 'profil/edytuj', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('profil/edytuj/haslo', [ProfileController::class, 'changePassword'])->name('profile_password.edit');

//DYREKTOR
Route::middleware('is_director')->group(function(){
    Route::get('dyrektor', [HomeController::class, 'directorHome'])->name('director_home.show');
    Route::get('dyrektor/grupy', [GroupsController::class, 'directorIndex'])->name('director.groups.index');
    Route::match(['get', 'post'], 'dyrektor/grupy/edytuj/{id?}', [GroupsController::class, 'directorEdit'])->name('director.groups.edit');
    Route::get('dyrektor/grupy/usun/{id}', [GroupsController::class, 'directorDelete'])->name('director.groups.delete');
    Route::get('dyrektor/grupy/szczegoly/{id}', [GroupsController::class, 'directorShow'])->name('director.groups.show');

    Route::get('dyrektor/uzytkownicy', [UsersController::class, 'index'])->name('director.users.index');
    Route::match(['get', 'post'], 'dyrektor/uzytkownicy/edytuj/{id?}', [UsersController::class, 'edit'])->name('director.users.edit');
    Route::get('dyrektor/uzytkownicy/usun/{id?}', [UsersController::class, 'delete'])->name('director.users.delete');

    Route::match(['get', 'post'], 'dyrektor/konfiguracja/email', [ConfigurationController::class, 'editMail'])->name('director.configuration.email');

    Route::get('dyrektor/dzieci', [KidsController::class, 'directorIndex'])->name('director.kids.index');
    Route::match(['get', 'post'], 'dyrektor/dzieci/edytuj/{id?}', [KidsController::class, 'directorEdit'])->name('director.kids.edit');
    Route::get('dyrektor/dzieci/usun/{id?}', [KidsController::class, 'directorDelete'])->name('director.kids.delete');

    Route::match(['get', 'post'], 'dyrektor/grupy/ogloszenia/edytuj/{group_id}/{id?}', [AnnouncementsController::class, 'edit'])->name('director.announcement.edit');
    Route::get('dyrektor/grupy/ogloszenia/usun/{id?}', [AnnouncementsController::class, 'delete'])->name('director.announcement.delete');
    Route::get('dyrektor/grupy/szczegoly/{id}/ogloszenia', [AnnouncementsController::class, 'indexGroup'])->name('director.announcement.group.index');

    Route::match(['get', 'post'], 'dyrektor/grupy/szczegoly/plan/{group_id}/edytuj/{id?}', [LessonPlansController::class, 'edit'])->name('lesson_plan.edit');
    Route::get('dyrektor/grupy/szczegoly/plan/{id?}', [LessonPlansController::class, 'show'])->name('lesson_plan.show');
    Route::get('dyrektor/grupy/szczegoly/plan/usun/{id?}', [LessonPlansController::class, 'delete'])->name('lesson_plan.delete');

    Route::match(['get', 'post'], 'dyrektor/grupy/szczegoly/obecnosci/{group_id}/edytuj/{date}', [AttendanceListController::class, 'edit'])->name('attendance_list.edit');


});




Route::get('nauczyciel', [HomeController::class, 'teacherHome'])->name('teacher_home.show')->middleware('is_teacher');
Route::get('rodzic', [HomeController::class, 'parentHome'])->name('parent_home.show')->middleware('is_parent');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
