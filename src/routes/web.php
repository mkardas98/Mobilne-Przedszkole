<?php

use App\Http\Controllers\AllergensController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\AttendanceListController;
use App\Http\Controllers\BasicFieldsController;
use App\Http\Controllers\BehaviorsController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\EatMenuController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonPlansController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KidsController;
use App\Http\Controllers\UsersController;
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


Route::get('/', [PageController::class, 'index'])->name('index.show');
Auth::routes();

Route::get('/ckeditor', [CkeditorController::class, 'upload'])->name('ckeditor.upload');

Route::middleware('auth')->group(function(){
    Route::get('profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::match(['get', 'post'], 'profil/edytuj', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profil/edytuj/haslo', [ProfileController::class, 'changePassword'])->name('profile_password.edit');
    Route::get('profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('wiadomosci', [ChatsController::class, 'index'])->name('chats.index');
    Route::get('wiadomosci/nowa-konwersacja', [ChatsController::class, 'newChat'])->name('chats.new_chat');
    Route::post('wiadomosci/nowa-konwersacja/utworz', [ChatsController::class, 'create'])->name('chats.create');
    Route::get('wiadomosci/{id}', [ChatsController::class, 'show'])->name('chats.show');
    Route::post('wiadomosci/{id}/odpowiedz', [ChatsController::class, 'addMessage'])->name('chats.add_message');
});

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
    Route::get('dyrektor/dzieci/szczegoły/{id}', [KidsController::class, 'directorShow'])->name('director.kids.show');
    Route::get('dyrektor/dzieci/usun/{id?}', [KidsController::class, 'directorDelete'])->name('director.kids.delete');

    Route::match(['get', 'post'],'dyrektor/dzieci/szczegoly/{kid_id}/alergeny/edytuj/{id?}', [AllergensController::class, 'directorEdit'])->name('director.allergens.edit');
    Route::get('dyrektor/dzieci/szczegoly/alergeny/usun/{id}', [AllergensController::class, 'directorDelete'])->name('director.allergens.delete');

    Route::match(['get', 'post'],'dyrektor/dzieci/szczegoly/{kid_id}/zachowanie/edytuj/{id?}', [BehaviorsController::class, 'directorEdit'])->name('director.behaviors.edit');
    Route::match(['get', 'post'],'dyrektor/dzieci/szczegoly/zachowanie/usuń/{id}', [BehaviorsController::class, 'delete'])->name('director.behaviors.delete');

    Route::match(['get', 'post'], 'dyrektor/grupy/ogloszenia/edytuj/{group_id}/{id?}', [AnnouncementsController::class, 'directorEdit'])->name('director.announcement.edit');
    Route::get('dyrektor/grupy/ogloszenia/usun/{id?}', [AnnouncementsController::class, 'delete'])->name('director.announcement.delete');
    Route::get('dyrektor/grupy/szczegoly/{id}/ogloszenia', [AnnouncementsController::class, 'directorIndexGroup'])->name('director.announcement.group.index');
    Route::get('dyrektor/ogloszenia', [AnnouncementsController::class, 'directorIndex'])->name('director.announcements.index');

    Route::match(['get', 'post'], 'dyrektor/grupy/szczegoly/{group_id}/plan/edytuj', [LessonPlansController::class, 'edit'])->name('director.lesson_plan.edit');
//    Route::get('dyrektor/grupy/szczegoly/{group_id}/plan', [LessonPlansController::class, 'show'])->name('director.lesson_plan.show');
    Route::get('dyrektor/grupy/szczegoly/plan/{group_id}/plan/edytuj', [LessonPlansController::class, 'delete'])->name('director.lesson_plan.delete');

    Route::match(['get', 'post'], 'dyrektor/grupy/szczegoly/obecnosci/{group_id}/edytuj/{date}', [AttendanceListController::class, 'directorEdit'])->name('director.attendance_list.edit');

    Route::get('dyrektor/jadlospis', [EatMenuController::class, 'directorIndex'])->name('director.eat_menu.index');
    Route::match(['get', 'post'], 'dyrektor/jadlospis/edytuj/{id?}', [EatMenuController::class, 'directorEdit'])->name('director.eat_menu.edit');
    Route::get('dyrektor/jadlospis/{id}', [EatMenuController::class, 'directorShow'])->name('director.eat_menu.show');
    Route::get('dyrektor/jadlospis/usun/{id?}', [EatMenuController::class, 'delete'])->name('director.eat_menu.delete');

    Route::match(['get', 'post'], 'dyrektor/dane-przedszkola', [BasicFieldsController::class, 'kindergartenDataEdit'])->name('director.kindergarten_data.edit');

    Route::get('dyrektor/aktualnosci', [NewsController::class, 'directorIndex'])->name('director.news.index');
    Route::match(['get', 'post'], 'dyrektor/aktualnosci/edytuj/{id?}', [NewsController::class, 'directorEdit'])->name('director.news.edit');
    Route::get('dyrektor/aktualnosci/usun/{id?}', [NewsController::class, 'delete'])->name('director.news.delete');

    Route::get('dyrektor/galeria', [GalleryController::class, 'directorIndex'])->name('director.gallery.index');
    Route::match(['get', 'post'],'dyrektor/galeria/edytuj/{id?}', [GalleryController::class, 'directorEdit'])->name('director.gallery.edit');
    Route::get('dyrektor/galeria/usun/{id?}', [GalleryController::class, 'delete'])->name('director.gallery.delete');


    Route::post( 'dyrektor/galeria/dodaj-zdjecia/{id_gallery}', [GalleryController::class, 'addImages'])->name('director.gallery.item.upload');
    Route::get('dyrektor/galeria/zdjecie/usun/{id?}', [GalleryController::class, 'deleteItem'])->name('director.gallery.item.delete');
    Route::post('dyrektor/galeria/zdjecie/setType', [GalleryController::class, 'setCoverGalleryItem'])->name('director.gallery.item.setCover');


});
Route::middleware('is_teacher')->group(function(){
    Route::get('nauczyciel', [HomeController::class, 'teacherHome'])->name('teacher_home.show');
    Route::get('nauczyciel/grupy', [GroupsController::class, 'teacherIndex'])->name('teacher.groups.index');

});

Route::get('rodzic', [HomeController::class, 'parentHome'])->name('parent_home.show')->middleware('is_parent');

Route::get('/home', [HomeController::class, 'index'])->name('home');

require_once('web_news.php');
require_once('web_gallery.php');

