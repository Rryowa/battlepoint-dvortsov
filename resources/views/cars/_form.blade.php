<x-validation-errors />
<form method="post" action="{{ $action }}">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="mb-3">
        <label class="form-label">Make</label>
        <input type="text" name="make" class="form-control" value="{{ old('make', $car->make ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" value="{{ old('model', $car->model ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Year</label>
        <input type="number" name="year" class="form-control" value="{{ old('year', $car->year ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $car->price ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Dealership</label>
        <select name="dealership_id" class="form-select">
            <option value="">—</option>
            @foreach($dealerships as $id => $name)
                <option value="{{ $id }}" @selected(old('dealership_id', $car->dealership_id ?? '') == $id)>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    @isset($car)
        <input type="hidden" name="updated_at" value="{{ $car->updated_at->toISOString() }}">
    @endisset
    <button class="btn btn-primary">Save</button>
</form>
