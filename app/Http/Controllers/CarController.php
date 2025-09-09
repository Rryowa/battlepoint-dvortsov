<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Dealership;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

class CarController extends Controller {
    public function index() {
        $cars = Car::with('dealership')->cursorPaginate(10);
        return view('cars.index', compact('cars'));
    }

    public function create(Dealership $dealership) {
        $dealerships = Dealership::pluck('name', 'id');
        $car = Car::make();
        return view('cars.form-page', [
            'car' => $car,
            'dealerships' => $dealerships,
            'currentDealership' => $dealership,
        ]);
    }

    public function store(StoreCarRequest $request, Dealership $dealership) {
        DB::transaction(fn () => $dealership->cars()->create($request->validated()));
        return redirect()->route('dealerships.cars.index', $dealership)->with('success', 'Car added.');
    }

    public function show(Car $car) {
        $car->load('dealership', 'maintenances');
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car) {
        $dealerships = Dealership::pluck('name', 'id');
        return view('cars.form-page', [
            'car' => $car,
            'dealerships' => $dealerships,
        ]);
    }

    public function topExpensive() {
        $cars = cache()->remember('top10_cars', 3600, fn() => Car::with('dealership')->orderByDesc('price')->take(10)->get());
        return view('cars.index', compact('cars'));
    }

    /**
     * Защита от конфликтов:
     * 1. Pg-advisory-lock (`pg_try_advisory_xact_lock`) — исключает параллельную
     *    запись одной и той же строки в рамках открытой транзакции. Если уже лок - 423 Locked
     * 2. Optimistic-lock по `updated_at` — защита от устаревшей
     *    формы - если с момента загрузки страницы запись изменилась - 409 Conflict
     *
     * @param  UpdateCarRequest  $request
     * @param  Car               $car
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCarRequest $request, Car $car) {
        // postgres row-level lock
        $this->acquireLock('cars', $car->id);
        // старые данные
        abort_if($request->input('updated_at') !== $car->updated_at->toISOString(), 409, 'Record changed');
        
        DB::transaction(fn () => $car->update($request->validated()));
        
        return redirect()->route('cars.index')->with('success', 'Car updated.');
    }

    public function destroy(Car $car) {
        $car->delete();
        
        return redirect()->route('cars.index')->with('success', 'Car archived.');
    }

    private function acquireLock(string $table, int $id): void {
        $hash = crc32($table);
        $key  = ($hash << 32) | $id; // 64 bigint
        
        $locked = DB::selectOne('SELECT pg_try_advisory_xact_lock(?) AS ok', [$key])->ok ?? false;
        
        abort_unless($locked, 423, 'Record is being edited');
    }
}
