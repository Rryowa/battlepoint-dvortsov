@extends('layouts.app')

@section('content')
    <h1>Car Details: {{ $car->make }} {{ $car->model }}</h1>
    <p>Year: {{ $car->year }}</p>
    <p>Price: {{ number_format($car->price, 2) }}</p>
    <p>Status: {{ $car->status }}</p>
    <p>Dealership: {{ $car->dealership->name ?? '—' }}</p>

    <h2>Maintenance History</h2>
    <a href="{{ route('cars.maintenances.create', $car) }}" class="btn btn-sm btn-success mb-2">Add Maintenance Record</a>

    @if($car->maintenances->isEmpty())
        <p class="text-muted">No maintenance records for this car.</p>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Date</th>
                <th>Mileage</th>
                <th>Cost</th>
                <th>Description</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($car->maintenances as $maintenance)
                <tr>
                    <td>{{ $maintenance->mileage }}</td>
                    <td>{{ $maintenance->performed_at?->format('Y-m-d') }}</td>
                    <td>{{ $maintenance->cost }}</td>
                    <td>{{ $maintenance->description }}</td>
                    <td>
                        <a href="{{ route('maintenances.edit', $maintenance) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('maintenances.destroy', $maintenance) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this maintenance record?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection