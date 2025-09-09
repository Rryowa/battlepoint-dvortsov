@extends('layouts.app')

@section('content')
<h1>Cars</h1>
@if($cars->isEmpty())
    <p class="text-muted">No cars</p>
@else
<table class="table table-striped">
    <thead>
    <tr>
        <th>Make</th><th>Model</th><th>Year</th><th>Price</th><th>Dealership</th><th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($cars as $car)
        <tr>
            <td>{{ $car->make }}</td>
            <td>{{ $car->model }}</td>
            <td>{{ $car->year }}</td>
            <td>{{ number_format($car->price,2) }}</td>
            <td>{{ $car->dealership->name ?? '—' }}</td>
            <td><a href="{{ route('cars.edit',$car) }}" class="btn btn-sm btn-primary">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $cars->links() }}
@endif
@endsection
