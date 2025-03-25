<?php

namespace Database\Seeders;

use App\Models\Train;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UpdateDepartureDateSeeder extends Seeder
{
    
    public function run(): void
    {
        $faker = app(Faker::class);

        Train::all()->each(function ($train) use ($faker) {
            $train->update([
                "departure_date" => $faker->date("2025-m-d")
            ]);
        });
    }
}
