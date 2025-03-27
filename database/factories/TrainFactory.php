<?php

namespace Database\Factories;

use App\Models\Train;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Train>
 */
class TrainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        // $prefixes = ['IC', 'EC', 'FA', 'RV', 'ES', 'TH'];
        // $prefix = $this->faker->randomElement($prefixes);

        //  return [
        //      "agency" => $this->faker->company,
        //      'departure_station' => $this->faker->city,  
        //      'arrival_station' => $this->faker->city, 
        //      'departure_time' => $this->faker->time('H:i:00'),
        //      'arrival_time' => $this->faker->time('H:i:00'),  
        //      'train_code' => $prefix . $this->faker->unique()->numberBetween(1000, 9999),  
        //      'total_carriages' => $this->faker->numberBetween(3, 15),  
        //      'on_time' => $this->faker->boolean(),  
        //      'deleted' => $this->faker->boolean(),  
        //  ];
    }
}
