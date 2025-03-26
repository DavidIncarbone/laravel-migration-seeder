<?php

namespace Database\Seeders;

use App\Models\Train;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;


class UpdateTrainsTableSeeder extends Seeder
{



    public function run(Faker $faker): void
    {

         Train::all()->each(function ($train) use ($faker){
            
        $train->agency = $faker->company();
        $train->departure_station = $faker->city();  
        $train->arrival_station = $faker->city(); 

             // setto la data di partenza

        $departureDate = Carbon::parse($faker->date("2025/m/d"));
        $train->departure_date = $departureDate;

        // setto la data di arrivo incrementando i giorni casualmente da 1 a 3 rispetto alla data di partenza

        $arrivalDate = $departureDate->copy()->addDays(rand(0,1));
        $train->arrival_date = $arrivalDate;


        $departureTime = Carbon::parse($faker->time("H:i"));
        $train->departure_time = $departureTime;
        $arrivalTime = $departureTime->copy()->addMinutes(rand(0,60));

         if($departureDate->eq($arrivalDate)){

      if ($arrivalTime->greaterThan("23:59")) {
            $arrivalTime = Carbon::parse("23:59");
                         }}


        $train->arrival_time = $arrivalTime;
         // setto il prefisso che deve avere il codice del treno

         $prefixes = ['IC', 'EC', 'FA', 'RV', 'ES', 'TH'];
        $prefix = $faker->randomElement($prefixes);

        $train->train_code = $prefix . $faker->unique()->numberBetween(1000, 9999); 
             
        $train->total_carriages = $faker->numberBetween(3, 15);  

         // imposto se il treno è in orario, in ritardo o cancellato. Se è in orario non sarà mai cancellato, se è in ritardo decido casualmente se è cancellato o no

        $onTime = $faker->boolean();
        $train->on_time = $onTime;
        $train->deleted = $onTime ? 0 : $faker->boolean();

        
           
        $train->save();
        });
        
    }


    
}
