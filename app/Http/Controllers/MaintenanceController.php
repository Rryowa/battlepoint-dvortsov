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
        return view('maintenances.create', compact('car'));
    }

    public function store(Request $request, Car $car) {
        $data = $request->validate([
            'mileage' => ['required', 'integer', 'min:0'],
            'performed_at' => ['required', 'date'],
            'cost' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        DB::transaction(fn () => $car->maintenances()->create($data));

        return redirect()->route('cars.maintenances.index', $car)->with('success', 'Maintenance added');
    }

    public function destroy(Car $car, Maintenance $maintenance) {
        $maintenance->delete();
        return redirect()->route('cars.maintenances.index', $car)->with('success', 'Maintenance deleted');
    }
}
