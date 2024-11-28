

    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" class="crud-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            <small>Current Image:</small>
            <br>
            <img src="{{ asset('storage/' . $gallery->image) }}" alt="Image" width="100">
        </div>
        <button type="submit" class="btn btn-success crud-button">Update Gallery</button>
    </form>
@include('crud-js')
