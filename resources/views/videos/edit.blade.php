<form action="{{ route('video.update', $video->id) }}" method="POST" class="crud-form">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" value="{{ $video->title }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description">{{ $video->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="url" class="form-label">Url</label>
        <input type="text" name="url" class="form-control" id="url" value="{{ $video->url }}" required>
    </div>
    <button type="submit" class="btn btn-primary crud-button">Update</button>
</form>
@include('crud-js')