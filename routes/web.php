<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CompostController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\AccountController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [HomeController::class, 'index']);
Route::get("/restaurant", [RestaurantController::class, 'index']);

Route::get("/compost", [CompostController::class, 'index']);

Route::get("/farmer", [FarmerController::class, 'index']);

Route::get("/account", [AccountController::class, 'index']);

