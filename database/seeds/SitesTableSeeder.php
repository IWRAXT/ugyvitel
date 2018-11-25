<?php

use Illuminate\Database\Seeder;
use  App\Site;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::forceCreate([
            'name' => 'Igazgatóság',
            'image' =>'default-site.jpg',
            'address' => 'Fő tér 3.',
            'phone_number' => '1234567899',
            'leader_id'=>'2', //Nagy Péter

        ]);
        Site::forceCreate([
            'name' => 'Mozi',
            'image' =>'default-site.jpg',
            'address' => 'Fő tér 2.',
            'phone_number' => '1234567899',
            'leader_id'=>'3',//Nagy Luca
        ]);
        Site::forceCreate([
            'name' => 'Piac',
            'image' =>'default-site.jpg',
            'address' => 'Kossuth utca 31.',
            'phone_number' => '1234567899',
            'leader_id'=>'2', //Nagy Péter
        ]);
        Site::forceCreate([
            'name' => 'Uszoda',
            'image' =>'default-site.jpg',
            'address' => 'Uszoda út 3.',
            'phone_number' => '1234567899',
            'leader_id'=>'2', //Nagy Péter
        ]);
    }
}
