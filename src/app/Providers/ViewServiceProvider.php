<?php


namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {

    }


    public function boot() {
        View::composer('director.nav', 'App\Http\Controllers\HelperController@navDirector');
        View::composer('teacher.nav', 'App\Http\Controllers\HelperController@navTeacher');
        View::composer('parent.nav', 'App\Http\Controllers\HelperController@navParent');
    }



}
