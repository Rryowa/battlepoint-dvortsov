<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MaintenanceController;

Route::get('/', fn() => redirect()->route('dealerships.index'));

Route::middleware('throttle:60,1')->group(function () {
    Route::resource('dealerships', DealershipController::class);
    Route::resource('dealerships.cars', CarController::class)->shallow();
    Route::get('cars', [CarController::class, 'index'])->name('cars.index');
    Route::resource('cars.maintenances', MaintenanceController::class)->shallow();
});
