<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
                'phone'=>'123123123',
                'avatar'=>'',
                'date_of_birth' => '1977-03-03',
                'email'=>'dyrektor@dyrektor1.pl',
                'role'=>'0',
                'password'=> bcrypt('dyrektor')
            ],
            [
                'login'=> 'Paulina',
                'first_name'=>'Paulina',
                'last_name'=>'Lautenszleger',
                'phone'=>'123123123',
                'avatar'=>'',
                'date_of_birth' => '1977-03-03',
                'email'=>'dyrektor@dyrektor2.pl',
                'role'=>'0',
                'password'=> bcrypt('123456')
            ],
            [
                'login'=> 'RodRod0519932',
                'first_name'=>'Ania',
                'last_name'=>'Kowalska',
                'email'=>'rodzic@rodzic1.pl',
                'date_of_birth' => '1993-05-05',
                'role'=>'2',
                'password'=> bcrypt('rodzic'),
            ],
            [
                'login'=> 'RodRod05199312',
                'first_name'=>'Wojtek',
                'last_name'=>'Nowak',
                'email'=>'nauczyciel@nauczyciel2.pl',
                'date_of_birth' => '1992-05-05',
                'role'=>'1',
                'password'=> bcrypt('nauczyciel'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
