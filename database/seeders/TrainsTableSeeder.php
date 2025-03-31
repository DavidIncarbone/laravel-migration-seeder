<?php

namespace Database\Seeders;

use App\Models\Train;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Carbon\Carbon;

class TrainsTableSeeder extends Seeder
{
   
    public function run(Faker $faker): void

    {
     
        for ($i = 0;$i < 50 ;$i++){

             $newTrain = new Train;

              // assegno dati fittizi ad ogni colonna usando Faker
            
    $newTrain->agency = $faker->company;
    $newTrain->departure_station = $faker->city;  
    $newTrain->arrival_station = $faker->city; 

    // setto la data di partenza convertendo la stringa che mi torna faker in un oggetto Carbon, in modo da poterci lavorare meglio più avanti

    $departureDate = Carbon::parse($faker->date("2025/m/d"));

    $newTrain->departure_date = $departureDate;


    // faccio una copia altrimenti non posso usare i metodi di Carbon (assegnerebbe $departureDate senza modifiche)
    // setto la data di arrivo incrementando i giorni casualmente da 0 a 3 rispetto alla data di partenza
    
    $arrivalDate = $departureDate->copy()->addDays(rand(0, 3));
    $newTrain->arrival_date = $arrivalDate;

    // setto l'orario di partenza
    $departureTime = Carbon::parse($faker->time("H:i"));

    // Se l'orario di partenza è uguale a 23:59 (endOfDay()) lo setto a 23:58

    $departureTime = $departureTime->eq($departureTime->copy()->endOfDay()) 
      ? Carbon::parse($faker->time("23:58")) 
      : $departureTime;
      
    $newTrain->departure_time = $departureTime;

    // var_dump($departureTime);

    // uso il metodo "eq()" al posto di "===" per comparare $departureDate e $arrivalDate perchè ho precedentemente fatto una copia e "===" si riferisce all'oggetto originario

    if ($departureDate->eq($arrivalDate)) { // Se il viaggio è lo stesso giorno, l'orario di arrivo non può superare le 23:59
        

        // calcolo la differenza in minuti tra $departureTime e le 23:59 (endOfDay)
        $endOfDay = $departureTime->copy()->endOfDay();
        $minuteToDiff = $departureTime->copy()->diffInMinutes($endOfDay);

        // var_dump($minuteToDiff);

        // creo un range di minuti random che vanno da 1 minuto dopo la partenza alle 23:59 (endOfDay)
        $randomMinutes = rand(1, $minuteToDiff);

        // imposta l'orario di arrivo
        $arrivalTime = $departureTime->copy()->addMinutes($randomMinutes);
    } else {
        // Se i giorni sono diversi, può essere qualsiasi orario di arrivo
        $arrivalTime = Carbon::parse($faker->time("H:i"));
    }

    // assegno l'orario di arrivo del treno
    $newTrain->arrival_time = $arrivalTime;


    // setto il prefisso che deve avere il codice del treno

    
        $newTrain->train_code = $faker->unique()->bothify("??-####"); 
             
        $newTrain->total_carriages = $faker->numberBetween(3, 15);  

         // imposto se il treno è in orario, in ritardo o cancellato. Se è in orario non sarà mai cancellato, se è in ritardo decido casualmente se è cancellato o meno

        $onTime = $faker->boolean;
        $newTrain->on_time = $onTime;
        $newTrain->deleted = $onTime ? 0 : $faker->boolean;

        
             $newTrain->save();
        }
        
    }
}
