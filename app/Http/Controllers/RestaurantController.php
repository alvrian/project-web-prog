<?php

namespace App\Http\Controllers;

use App\Models\PickupSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    public function index()
    {
        return view("restaurantMain");
    }
}
