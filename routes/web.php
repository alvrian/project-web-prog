<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CompostController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\AccountController;

Route::get("/", [HomeController::class, 'index']);
Route::get("/market", [HomeController::class, 'market']);

Route::get("/restaurant", [RestaurantController::class, 'index']);

Route::get("/compost", [CompostController::class, 'index']);

Route::get("/farmer", [FarmerController::class, 'index']);

Route::get("/account", [AccountController::class, 'index']);

