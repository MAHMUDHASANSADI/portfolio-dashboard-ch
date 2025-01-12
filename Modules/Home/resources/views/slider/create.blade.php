<form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data" class="crud-form">
    @csrf
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-success crud-button">Create Slider</button>
</form>
@include('crud-js')