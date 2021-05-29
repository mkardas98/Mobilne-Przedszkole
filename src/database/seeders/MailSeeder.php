<?php

namespace Database\Seeders;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'from_name'=> 'Mobilne Przedszkole',
                'from_address'=>'tomsolution_noreply@rescodev.pl',
                'host'=>'serwer2000157.home.pl',
                'port'=>'465',
                'user_name' => 'tomsolution_noreply@rescodev.pl',
                'password'=>'',
                'encryption'=>'SSL'
            ],
        ];

        foreach ($user as $key => $value) {
            Mail::create($value);
        }
    }
}
