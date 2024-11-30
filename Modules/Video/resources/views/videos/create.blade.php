<form action="{{ route('video.store') }}" method="POST" class="crud-form">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
    </div>
    <div class="mb-3">
        <label for="url" class="form-label">Url</label>
        <input type="text" name="url" class="form-control" id="url" value="{{ old('url') }}">
    </div>
    <button type="submit" class="btn btn-primary crud-button">Save</button>
</form>
@include('crud-js')