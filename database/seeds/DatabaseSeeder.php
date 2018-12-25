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
        $this->call(DefaultLocationsSeeder::class);
        $this->call(ModulesSeeder::class);
        $this->call(ModuleTrackingNumbersSeeder::class);
        $this->call(DefaultRolesSeeder::class);

        $this->call(DefaultAdminSeeder::class);
        
        $this->call(DummySuppliersSeeder::class);
        $this->call(DummyItemsSeeder::class);

        $this->call(ClientsSeeder::class);
    }
}
