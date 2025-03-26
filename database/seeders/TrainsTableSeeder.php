<?php

namespace Database\Seeders;

use App\Models\Train;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Carbon\Carbon;

class TrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        
        // imposto le variabili che mi serviranno per settare correttamente i campi della mia tabella

        // setto la data di partenza

        
        for ($i = 0;$i < 50 ;$i++){

             $newTrain = new Train;

             $departureDate = $faker->date("2025/m/d");
        $newTrain->departure_date = $departureDate;

        // setto l'orario di partenza

       
        $newTrain->departure_time = $faker->time("H:i");

        // setto la data di arrivo incrementando i giorni casualmente da 1 a 3 rispetto alla data di partenza

        
        $newTrain->arrival_date = Carbon::parse($departureDate)->addDays(rand(1,3));

        // imposto se il treno è in orario, in ritardo o cancellato. Se è in orario non sarà mai cancellato, se è in ritardo decido casualmente se è cancellato o no

        $onTime = $faker->boolean();
        $newTrain->on_time = $onTime;
        $newTrain->deleted = $onTime ? 0 : $faker->boolean();

        // setto il prefisso che deve avere il codice del treno

        $prefixes = ['IC', 'EC', 'FA', 'RV', 'ES', 'TH'];
        $prefix = $faker->randomElement($prefixes);


             $newTrain->agency = $faker->company();
             $newTrain->departure_station = $faker->city();  
             $newTrain->arrival_station = $faker->city(); 
             $newTrain->arrival_time = $faker->time("H:i:00");  
             $newTrain->train_code = $prefix . $faker->unique()->numberBetween(1000, 9999);  
             $newTrain->total_carriages = $faker->numberBetween(3, 15);  
           
             $newTrain->save();
        }
        
    }
}
