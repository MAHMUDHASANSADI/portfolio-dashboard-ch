<form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="crud-form">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" class="form-control">
        <small>Current Image:</small>
        <br>
        <img src="{{ asset('storage/' . $slider->image) }}" alt="Image" width="100">
    </div>
    <button type="submit" class="btn btn-success crud-button">Update Gallery</button>
</form>
@include('crud-js')