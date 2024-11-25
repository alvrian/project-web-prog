<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index (){
        return view ("accountMain");
    }

    public function point(){
        return view('accountPoints');
    }

}
