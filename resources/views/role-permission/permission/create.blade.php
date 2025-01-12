<form action="{{ route('permissions.store') }}" method="POST" class="crud-form">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Permission Name</label>
        <input type="text" name="name" class="form-control" id="url" value="{{ old('name') }}">
    </div>
    <button type="submit" class="btn btn-primary crud-button">Save</button>
</form>
@include('crud-js')