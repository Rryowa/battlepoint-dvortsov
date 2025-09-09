@extends('layouts.app')

@section('content')
<h1>Dealerships</h1>
<a href="{{ route('dealerships.create') }}" class="btn btn-sm btn-success mb-2">Add Dealership</a>
@if($dealerships->isEmpty())
    <p class="text-muted">No dealerships</p>
@else
<table class="table table-striped">
    <thead><tr><th>Name</th><th>City</th><th>Phone</th><th></th></tr></thead>
    <tbody>
    @foreach($dealerships as $d)
        <tr>
            <td>{{ $d->name }}</td>
            <td>{{ $d->city }}</td>
            <td>{{ $d->phoneNumber }}</td>
            <td><a href="{{ route('dealerships.edit',$d) }}" class="btn btn-sm btn-primary">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $dealerships->links() }}
@endif
@endsection
