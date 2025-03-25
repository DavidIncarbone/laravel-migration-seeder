<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainsController;

Route::get('/', [TrainsController::class, "index"]);

