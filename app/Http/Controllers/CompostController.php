<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompostController extends Controller
{
    public function index()
    {
        return view("compostMain");
    }
}
