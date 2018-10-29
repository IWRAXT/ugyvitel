<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::forceCreate([
            'last_name' => 'Harangozó',
            'first_name' => 'Dóra',
            'birth' =>'1994-04-20',
            'image' =>'default.jpg',
            'address' => 'Sopron, Baross út 20.',
            'phone_number' => '06306089097',
            'month_salary' => 123456789,
            'recruitment_date'=>'2018-10-10',
            'job'=>'mérnök',
            'comment'=> null,
            'user_id'=>1,
            'site_id'=>1,
        ]);
        Employee::forceCreate([
            'last_name' => 'Nagy',
            'first_name' => 'Péter',
            'birth' =>'1980-08-08',
            'image' =>'default.jpg',
            'address' => 'Sopron, Kossuth út 20.',
            'phone_number' => '06301234569',
            'month_salary' => 123456789,
            'recruitment_date'=>'2018-10-10',
            'job'=>'menedzser',
            'comment'=> null,
            'user_id'=>2,
            'site_id'=>1,
        ]);
    }
}
