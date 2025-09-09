@extends('layouts.app')

@section('content')
<h1>{{ $car->exists ? 'Edit Car' : 'Add Car' }}</h1>
@include('cars._form', [
    'action'  => $car->exists ? route('cars.update', $car) : route('dealerships.cars.store', $currentDealership),
    'method'  => $car->exists ? 'PUT' : null,
    'car'     => $car,
    'dealerships' => $dealerships,
])
@endsection
