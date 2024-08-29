<?php

// database/factories/FlightFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

class FlightFactory extends Factory
{
    protected $model = \App\Models\Flight::class;

    public function definition()
    {
        return [
            'number' => $this->faker->unique()->bothify('FL##-###'),
            'departure_city' => $this->faker->city,
            'arrival_city' => $this->faker->city,
            'departure_time' => $this->faker->dateTimeBetween('+0 days', '+1 year'),
            'arrival_time' => $this->faker->dateTimeBetween('+1 hours', '+1 year'),
        ];
    }
}

