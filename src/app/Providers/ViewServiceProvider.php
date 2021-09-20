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
        View::composer('navigation.show', 'App\Http\Controllers\HelperController@navApp');
        View::composer('chats.messages_icon', 'App\Http\Controllers\ChatsController@infoNewMessage');
    }




}
