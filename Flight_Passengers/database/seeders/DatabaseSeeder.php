<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Create a new user
        $user = User::create([
            'name' => 'Omar',
            'email' => 'Omar.Khaled@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user = User::create([
            'name' => 'Omarr',
            'email' => 'Omar.Khaled22@gmail.com',
            'password' => bcrypt('passwordd'),
        ]);
    }
}

