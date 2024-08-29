<?php

namespace Database\Seeders;

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
        $this->call(PassengerSeeder::class);
        $this->call(FlightPassengerSeeder::class);
        $this->call(RolePermissionSeeder::class);


    }
}
