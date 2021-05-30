<?php


namespace App\Providers;


use App\Models\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {

        if (Schema::hasTable('mail')) {
            $smtp = DB::table('mail')->first();

            $config = Config::get('mail');
            $config['mailers']['smtp']['host'] = $smtp->host ?? '';
            $config['mailers']['smtp']['port'] = $smtp->port ?? '';
            $config['mailers']['smtp']['username'] = $smtp->user_name ?? '';
            $config['mailers']['smtp']['password'] = $smtp->password ?? '';
            $config['mailers']['smtp']['encryption'] = $smtp->encryption ?? '';
            $config['from']['address'] = $smtp->from_address ?? '';
            $config['from']['name'] = $smtp->from_name ?? '';

            Config::set('mail', $config);
        }
    }
}
