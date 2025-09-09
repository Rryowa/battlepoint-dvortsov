<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MaintenanceController;

Route::middleware('throttle:60,1')->group(function () {
    Route::resource('dealerships', DealershipController::class);
    Route::resource('dealerships.cars', CarController::class)->shallow();
    Route::resource('cars.maintenances', MaintenanceController::class)->shallow();
});
