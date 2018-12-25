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
        $this->call(DefaultAdminSeeder::class);
        $this->call(DefaultLocationsSeeder::class);
        $this->call(ModulesSeeder::class);
        $this->call(DefaultRolesSeeder::class);
    }
}
