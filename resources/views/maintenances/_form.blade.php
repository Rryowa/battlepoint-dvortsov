<x-validation-errors />
<form method="post" action="{{ $action }}">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <div class="mb-3">
        <label class="form-label">Mileage</label>
        <input type="number" name="mileage" class="form-control" value="{{ old('mileage', $maintenance->mileage ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Performed at</label>
        <input type="date" name="performed_at" class="form-control" value="{{ old('performed_at', $maintenance->performed_at?->format('Y-m-d')) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Cost</label>
        <input type="number" step="0.01" name="cost" class="form-control" value="{{ old('cost', $maintenance->cost ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description', $maintenance->description ?? '') }}</textarea>
    </div>
    <button class="btn btn-primary">Save</button>
</form>
