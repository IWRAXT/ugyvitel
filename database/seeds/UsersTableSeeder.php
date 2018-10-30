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
        User::forceCreate([
            'name'=>'Harangozó Dóra',
            'email' =>'doraharangozo1994@gmail.com',
            'password' => '$2y$10$pF7r8UiQZXgil4DqALWraO6Rtf95KVHTIObkpEV2g8i6HNvBVpN/G',
            'permission_id'=>1,
        ]);
        User::forceCreate([
            'name'=> 'Nagy Péter',
            'email' =>'nagy.peter@gmail.com',
            'password' => '$2y$10$Zqb8rj707ImeRf5hrb2hReqOoa0W9Jxpn4NaM09SheKQQRc92ohnu', //nagy.peter
            'permission_id'=>2, //Kft főnök
        ]);
//        User::forceCreate([
//            'name'=> 'Nagy Lili',
//            'email' =>'nagy.lili@gmail.com',
//            'password' => '$2y$10$Zqb8rj707ImeRf5hrb2hReqOoa0W9Jxpn4NaM09SheKQQRc92ohnu', //nagy.peter
//            'permission_id'=>2,
//        ]);
    }
}
