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
            'name' => 'Directorate Leader',     //Kft Főnök, Igazgatóság vezető
            'sites' => '1',
        ]);

        Permission::forceCreate([
            'name' => 'Leader',
            'sites' => '0',
        ]);

        Permission::forceCreate([
            'name' => 'Directorate incomes handler', //Igazgatóság bevétel kezelő
            'sites' => '1',
        ]);

        Permission::forceCreate([
            'name' => 'Incomes handler',
            'sites' => '0',
        ]);

        Permission::forceCreate([
            'name' => 'Directorate costs handler', //Igazgatóság kiadás kezelő
            'sites' => '1',
        ]);

        Permission::forceCreate([
            'name' => 'Costs handler',
            'sites' => '0',
        ]);
    }
}
