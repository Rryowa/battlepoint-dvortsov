@extends('layouts.app')

@section('content')
    <h1>Dealership: {{ $dealership->name }}</h1>
    <p>City: {{ $dealership->city }}</p>
    <p>Phone: {{ $dealership->phoneNumber }}</p>

    <h2>Cars at this Dealership</h2>
    <a href="{{ route('dealerships.cars.create', $dealership) }}" class="btn btn-sm btn-success mb-2">Add Car to {{ $dealership->name }}</a>

    @if($dealership->cars->isEmpty())
        <p class="text-muted">No cars found for this dealership.</p>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($dealership->cars as $car)
                <tr>
                    <td>{{ $car->make }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ number_format($car->price,2) }}</td>
                    <td>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-primary ms-1">Edit</a>
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to archive this car?')">Archive</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection