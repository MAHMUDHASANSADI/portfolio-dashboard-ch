{{-- resources/views/businesses/create.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Add New Video</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('video.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">Url</label>
            <input type="text" name="url" class="form-control" id="url" value="{{ old('url') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('video.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection
