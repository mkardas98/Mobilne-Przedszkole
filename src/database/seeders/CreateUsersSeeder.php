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
                'name'=>'dyrektor',
                'email'=>'dyrektor@dyrektor.pl',
                'role'=>'0',
                'password'=> bcrypt('dyrektor'),
            ],
            [
                'name'=>'nauczyciel',
                'email'=>'nauczyciel@nauczyciel.pl',
                'role'=>'1',
                'password'=> bcrypt('nauczyciel'),
            ],
            [
                'name'=>'rodzic',
                'email'=>'rodzic@rodzic.pl',
                'role'=>'2',
                'password'=> bcrypt('rodzic'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
