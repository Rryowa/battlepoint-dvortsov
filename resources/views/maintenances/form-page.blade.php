@extends('layouts.app')

@section('content')
<h1>{{ $maintenance->exists ? 'Edit Maintenance' : 'Add Maintenance' }}</h1>
@include('maintenances._form', [
    'action' => $maintenance->exists ? route('maintenances.update', $maintenance) : route('cars.maintenances.store', $car),
    'method' => $maintenance->exists ? 'PUT' : null,
    'maintenance' => $maintenance,
])
@endsection
