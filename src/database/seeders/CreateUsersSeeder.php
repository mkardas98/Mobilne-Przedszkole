<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
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
                'login'=> 'DyrDyr031977',
                'first_name'=>'Dyrektor',
                'last_name'=>'Dyrektor',
                'email'=>'dyrektor@dyrektor.pl',
                'date_of_birth' => '1977-03-03',
                'role'=>'0',
                'password'=> bcrypt('dyrektor')
            ],
            [
                'login'=> 'NauNau031988',
                'first_name'=>'Nauczyciel',
                'last_name'=>'Nauczyciel',
                'email'=>'nauczyciel@nauczyciel.pl',
                'date_of_birth' => '1988-04-04',
                'role'=>'1',
                'password'=> bcrypt('nauczyciel'),
            ],
            [
                'login'=> 'RodRod051993',
                'first_name'=>'Rodzic',
                'last_name'=>'Rodzic',
                'email'=>'rodzic@rodzic.pl',
                'date_of_birth' => '1993-05-05',
                'role'=>'2',
                'password'=> bcrypt('rodzic'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
