@extends('layouts.app')

@section('content')
<h1>Cars</h1>
<div class="mb-3">
    <a href="{{ route('cars.top_expensive') }}" class="btn btn-info">Top 10 Expensive Cars</a>
</div>
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
            <td>
                <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('cars.edit',$car) }}" class="btn btn-sm btn-primary ms-1">Edit</a>
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
@if ($cars instanceof \Illuminate\Pagination\LengthAwarePaginator || $cars instanceof \Illuminate\Pagination\CursorPaginator)
    {{ $cars->links() }}
@endif
@endif
@endsection
