<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CompostController;
use App\Http\Controllers\CompostEntryController;
use App\Http\Controllers\CompostProducerController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PriceListCompostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WasteLogController;
use Illuminate\Support\Facades\Route;


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

require __DIR__ . '/auth.php';

Route::prefix('restaurant-owner')->group(function () {
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

Route::prefix("compost-producer")->middleware(['auth', 'verified'])->group(function () {
    Route::get("/", [CompostController::class, 'index'])->name('compost.home');
    Route::post("/schedule", [CompostController::class, 'schedule'])->name('addSchedule');
    Route::get('/create-compost', [CompostEntryController::class, 'create'])->name('compost.create');
    Route::post('/create-compost', [CompostEntryController::class, 'store'])->name('compost.store');
    Route::post("/sub-manage-resume", [CompostController::class, "subsManagementResume"])->name('compost.subsManageResume');
    Route::post("/sub-manage-pause", [CompostController::class, "subsManagementPause"])->name('compost.subsManagePause');

    Route::resource('composts', CompostEntryController::class);
    Route::get('composts', [CompostEntryController::class, 'index'])->name('compost.index');
    Route::get('composts/{id}/details', [CompostEntryController::class, 'show'])->name('compost.show');
    Route::get('composts/{id}/edit', [CompostEntryController::class, 'edit'])->name('compost.edit');
    Route::put('composts/{id}', [CompostEntryController::class, 'update'])->name('compost.update');

    Route::post('/prices', [PriceListCompostController::class, 'store'])->name('price.store');
});


Route::prefix("farmer")->middleware(['auth', 'verified'])->group(function () {
    Route::get("/", [FarmerController::class, 'index']);

    Route::get('/create-corp', [CropController::class, 'create'])->name('crop.create');
    Route::post('/create-corp', [CropController::class, 'store'])->name('crop.store');

    Route::resource('crops', CropController::class);
    Route::get('crops/{crop}/details', [CropController::class, 'show'])->name('crops.show');
    Route::get('crops/{id}/edit', [CropController::class, 'edit'])->name('crops.edit');
    Route::put('crops/{id}', [CropController::class, 'update'])->name('crops.update');

    Route::resource('orders', OrderController::class)->except(['create', 'store']);

    Route::get('orders/{crop}/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

    Route::post('/prices', [PriceController::class, 'store'])->name('prices.store');

    Route::post('/subscribe-to-producers', [FarmerController::class, 'subscribeToProducers'])->name('subscribe.to.producers');

    Route::prefix('composters')->name('composters.')->group(function () {
        Route::get('/', [CompostProducerController::class, 'index'])->name('index');
        Route::get('/composterId={composterId}', [CompostProducerController::class, 'show'])->name('show');
        Route::get('/composterId={composterId}/compostId={compostId}/details', [CompostProducerController::class, 'details'])->name('show-detail');
    });
    Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('/points', [FarmerController::class, 'showPoints'])->name('farmer.points');

    Route::post("/sub-manage-resume", [FarmerController::class, "subsManagementResume"])->name('farmer.subsManageResume');
    Route::post("/sub-manage-pause", [FarmerController::class, "subsManagementPause"])->name('farmer.subsManagePause');
});

