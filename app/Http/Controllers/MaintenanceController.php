<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MaintenanceController extends Controller {
    public function index(Car $car) {
        $maintenances = $car->maintenances()->cursorPaginate(10);
        return view('maintenances.index', compact('car', 'maintenances'));
    }

    public function create(Car $car) {
        $maintenance = Maintenance::make();
        return view('maintenances.form-page', compact('car', 'maintenance'));
    }

    public function store(Request $request, Car $car) {
        $data = $request->validate([
            'mileage' => ['required', 'integer', 'min:0'],
            'performed_at' => ['required', 'date'],
            'cost' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        DB::transaction(fn () => $car->maintenances()->create($data));

        return redirect()->route('cars.show', $car)->with('success', 'Maintenance added');
    }

    public function edit(Maintenance $maintenance) {
        return view('maintenances.form-page', compact('maintenance'));
    }

    public function update(Request $request, Maintenance $maintenance) {
        $data = $request->validate([
            'mileage' => ['sometimes','integer','min:0'],
            'performed_at' => ['sometimes','date'],
            'cost' => ['sometimes','numeric','min:0'],
            'description' => ['nullable','string'],
        ]);

        DB::transaction(fn () => $maintenance->update($data));

        return redirect()->route('cars.show', $maintenance->car_id)->with('success', 'Maintenance updated');
    }

    public function destroy(Maintenance $maintenance) {
        $maintenance->delete();
        return redirect()->route('cars.show', $maintenance->car_id)->with('success', 'Maintenance deleted');
    }
}
