@extends('layouts.app')

@section('content')
<h1>{{ $dealership->exists ? 'Edit Dealership' : 'Add Dealership' }}</h1>
@include('dealerships._form', [
    'action' => $dealership->exists ? route('dealerships.update', $dealership) : route('dealerships.store'),
    'method' => $dealership->exists ? 'PUT' : null,
    'dealership' => $dealership,
])
@endsection
