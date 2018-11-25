<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Harangozó Dóra',
            'email' =>'doraharangozo1994@example.hu',
            'password' => bcrypt('asdf'),
            'permission_id'=>1,
        ]);
        User::create([
            'name'=> 'Nagy Péter',
            'email' =>'nagy.peter@example.hu',
            'password' => bcrypt('nagy.peter'),
            'permission_id'=>2, //Kft főnök
        ]);
        User::create([
            'name'=> 'Nagy Lili',
            'email' =>'nagy.lili@example.hu',
            'password' => bcrypt('nagy.lili'),
            'permission_id'=>7,
        ]);
        User::create([
            'name'=> 'Nagy Luca',
            'email' =>'nagy.luca@example.hu',
            'password' => bcrypt('nagy.luca'),
            'permission_id'=>3,
        ]);

    }
}
