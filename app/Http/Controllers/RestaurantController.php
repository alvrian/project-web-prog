<?php

namespace App\Http\Controllers;

class RestaurantController extends Controller
{
    public function index()
    {
        return view("restaurantMain");
    }
}
