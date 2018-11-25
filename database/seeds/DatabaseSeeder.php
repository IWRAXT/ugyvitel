<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(SitesTableSeeder::class);

        $this->call(Cost_TypesTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(CostsTableSeeder::class);
//        $this->call(IncomesTableSeeder::class);
    }
}
