<form action="{{ route('roles.update', $role->id) }}" method="POST" class="crud-form">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="name" class="form-label">Role Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $role->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary crud-button">Update</button>
</form>
@include('crud-js')