<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::forceCreate([
            'name' => 'Admin',
            'sites' => '1',
        ]);

        Permission::forceCreate([
            'name' => 'Leader',
            'sites' => '1',
        ]);

        Permission::forceCreate([
            'name' => 'Leader',
            'sites' => '0',
        ]);

        Permission::forceCreate([
            'name' => 'Incomes handler',
            'sites' => '1',
        ]);

        Permission::forceCreate([
            'name' => 'Incomes handler',
            'sites' => '0',
        ]);

        Permission::forceCreate([
            'name' => 'Costs handler',
            'sites' => '1',
        ]);

        Permission::forceCreate([
            'name' => 'Costs handler',
            'sites' => '0',
        ]);
    }
}
