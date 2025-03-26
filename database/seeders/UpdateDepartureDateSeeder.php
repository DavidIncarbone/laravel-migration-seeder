<?php

namespace Database\Seeders;

use App\Models\Train;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UpdateDepartureDateSeeder extends Seeder
{
    
    public function run(Faker $faker): void
    {
        
        Train::all()->each(function ($train) use ($faker){
            $train->departure_date = $faker->date("2025-m-d");
            $train->save();
        });
    }
}
