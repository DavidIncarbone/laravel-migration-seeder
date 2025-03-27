<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->string("agency",50);
            $table->string("departure_station",255);
            $table->string("arrival_station",255);
            $table->time("departure_time");
            $table->time("arrival_time");
            $table->string("train_code",50)->unique();
            $table->smallInteger("total_carriages")->unsigned()->nullable();
            $table->boolean("on_time",50)->nullable();
            $table->boolean("deleted",50);
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('trains');
    }
};
