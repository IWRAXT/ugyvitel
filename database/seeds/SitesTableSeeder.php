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
            'leader_id'=>2,

        ]);
    }
}
