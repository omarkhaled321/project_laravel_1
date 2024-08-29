<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Passenger;

class PassengerSeeder extends Seeder
{
    public function run()
    {
        Passenger::factory()->count(100)->create();
    }
}

