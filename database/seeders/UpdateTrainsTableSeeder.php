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
    $arrivalDate = $departureDate->copy()->addDays(rand(0, 3));
    $train->arrival_date = $arrivalDate;

    // setto l'orario di partenza
    $departureTime = Carbon::parse($faker->time("H:i"));
    $train->departure_time = $departureTime;

    if ($departureDate->eq($arrivalDate)) {
        // Se il viaggio è lo stesso giorno, l'orario di arrivo non può superare le 23:59

        // aggiungo almeno 1 minuto di differenza tra la partenza e l'arrivo
        $arrivalTemp = $departureTime->copy()->addMinute();

        // calcolo la differenza in minuti tra arrivalTemp e le 23:59 (endOfDay)
        $minutesToEndOfDay = $arrivalTemp->endOfDay()->diffInMinutes();

        // creo un range di minuti random che vanno da 1 minuto dopo la partenza alle 23:59 (endOfDay)
        $randomMinutes = rand(1, $minutesToEndOfDay);

        // imposta l'orario di arrivo
        $arrivalTime = $arrivalTemp->addMinutes($randomMinutes);
    } else {
        // Se i giorni sono diversi, può essere qualsiasi orario di arrivo
        $arrivalTime = Carbon::parse($faker->time("H:i"));
    }

    // Impostiamo l'orario di arrivo nel treno
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
