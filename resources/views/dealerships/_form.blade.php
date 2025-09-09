<x-validation-errors />
<form method="post" action="{{ $action }}">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $dealership->name ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">City</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $dealership->city ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phoneNumber" class="form-control" value="{{ old('phoneNumber', $dealership->phoneNumber ?? '') }}" required>
    </div>
    <button class="btn btn-primary">Save</button>
</form>
