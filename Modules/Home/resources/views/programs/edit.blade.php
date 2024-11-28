<form action="{{ route('program.update', $program->id) }}" method="POST" class="crud-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ $program->title }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4" required>{{ $program->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" name="price" class="form-control" value="{{ $program->price }}" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" class="form-control">
        <small>Current Image:</small>
        <br>
        <img src="{{ asset('storage/' . $program->image) }}" alt="Image" width="100">
    </div>
    <button type="submit" class="btn btn-success crud-button">Update Blog</button>
</form>

@include('crud-js')
