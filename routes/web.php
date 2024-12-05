<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CompostController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\WasteLogController;

Route::get("/", [HomeController::class, 'index']);
Route::get("/market", [HomeController::class, 'market']);
Route::get("/aboutUs", [HomeController::class, 'aboutUS']);

Route::prefix('restaurant')->group(function () {
    Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');

    Route::get('/create-waste-log', [WasteLogController::class, 'create'])->name('waste_log.create');
    Route::post('/create-waste-log', [WasteLogController::class, 'store'])->name('waste_log.store');

});

Route::get("/compost", [CompostController::class, 'index']);

Route::get("/farmer", [FarmerController::class, 'index']);

Route::prefix('account')->group(function () {
    Route::get("/", [AccountController::class, 'index']);
    Route::get("/point", [AccountController::class, 'point']);
});


Route::get('/waste-report', [WasteLogController::class, 'report'])->name('restaurantWasteReport');



