<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\Passenger;
use Faker\Factory as Faker;

class FlightPassengerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $flights = Flight::all();
        $passengers = Passenger::all();

        foreach ($flights as $flight) {
            $assignedPassengers = $passengers->random(rand(1, 10)); 

            foreach ($assignedPassengers as $passenger) {
                $flight->passengers()->attach($passenger->id);
            }
        }
    }
}
