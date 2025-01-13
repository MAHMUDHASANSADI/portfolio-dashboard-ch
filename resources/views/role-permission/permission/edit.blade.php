<form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="crud-form">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="module" class="form-label">Module Name</label>
        <input type="text" name="module" class="form-control" id="module" value="{{$permission->module}}" >
    </div>
    
    <div class="mb-3">
        <label for="name" class="form-label">Permission Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $permission->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary crud-button">Update</button>
</form>
@include('crud-js')