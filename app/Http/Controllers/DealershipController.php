<?php

namespace App\Http\Controllers;

use App\Models\Dealership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreDealershipRequest;
use App\Http\Requests\UpdateDealershipRequest;

class DealershipController extends Controller {
    public function index() {
        $dealerships = Dealership::cursorPaginate(10);
        return view('dealerships.index', compact('dealerships'));
    }

    public function create() {
        return view('dealerships.create');
    }

    public function store(StoreDealershipRequest $request) {
        DB::transaction(fn () => Dealership::create($request->validated()));
        return redirect()->route('dealerships.index')->with('success', 'Dealership created.');
    }

    public function show(Dealership $dealership) {
        return view('dealerships.show', compact('dealership'));
    }

    public function edit(Dealership $dealership) {
        return view('dealerships.edit', compact('dealership'));
    }

    public function update(UpdateDealershipRequest $request, Dealership $dealership) {
        DB::transaction(fn () => $dealership->update($request->validated()));
        return redirect()->route('dealerships.index')->with('success', 'Dealership updated.');
    }

    public function destroy(Dealership $dealership) {
        $dealership->delete();
        return redirect()->route('dealerships.index')->with('success', 'Dealership deleted.');
    }
}
