<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MaintenanceController;

Route::get('/', fn() => redirect()->route('cars.index'));

Route::middleware('throttle:60,1')->group(function () {
    Route::get('cars/top-expensive', [CarController::class, 'topExpensive'])->name('cars.top_expensive');
    Route::get('cars', [CarController::class, 'index'])->name('cars.index');
    Route::resource('dealerships', DealershipController::class);
    Route::resource('dealerships.cars', CarController::class)->shallow();
    Route::resource('cars.maintenances', MaintenanceController::class)->shallow();
});
