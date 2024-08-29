<?php

// database/seeders/FlightSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;

class FlightSeeder extends Seeder
{
    public function run()
    {
        Flight::factory()->count(50)->create();
    }
}
