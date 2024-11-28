

    <form action="{{ route('gallery.store') }}" method="POST" class="crud-form" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success crud-button">Create Blog</button>
    </form>
@include('crud-js')
