<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CompostController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\WasteLogController;
use App\Http\Controllers\CompostEntryController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('restaurant')->group(function () {
    Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');

    Route::get('/create-waste-log', [WasteLogController::class, 'create'])->name('waste_log.create');
    Route::post('/create-waste-log', [WasteLogController::class, 'store'])->name('waste_log.store');

});

Route::prefix('account')->middleware(['auth', 'verified'])->group(function () {
    Route::get("/", [AccountController::class, 'index'])->name('account');
    Route::get("/point", [AccountController::class, 'point']);
    Route::post("/complete", [AccountController::class, 'complete'])->name('complete');
});

Route::get("/", [HomeController::class, 'index'])->name('home');

Route::get("/market", [HomeController::class, 'market']);
Route::get("/aboutUs", [HomeController::class, 'aboutUS']);

Route::prefix("compost")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/", [CompostController::class, 'index']);

    Route::get('/create-compost', [CompostEntryController::class, 'create'])->name('compost.create');
    Route::post('/create-compost', [CompostEntryController::class, 'store'])->name('compost.store');

});

Route::get("/farmer", [FarmerController::class, 'index']);