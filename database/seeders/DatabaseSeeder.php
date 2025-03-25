<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Train;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        
        Train::factory(10)->create();

  
    }
}
