<?php

namespace App\Http\Controllers;

use App\Models\Train;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainsController extends Controller
{
    public function index(){
$today = Carbon::today();
        $trains = Train::where("departure_date",">=",$today)->orderBy("departure_date","asc")->get();
        // dd($trains);
        return view("index", compact("trains"));
    }
}
