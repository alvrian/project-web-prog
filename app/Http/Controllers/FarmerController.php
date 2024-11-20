<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class farmerController extends Controller
{
    public function index (){
        return view("farmerMain");
    }
}
