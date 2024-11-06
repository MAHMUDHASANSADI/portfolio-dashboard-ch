<!-- resources/views/heros/edit.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>Edit Blog</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $hero->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $hero->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            <small>Current Image:</small>
            <br>
            <img src="{{ asset('storage/' . $hero->image) }}" alt="Image" width="100">
        </div>
        <button type="submit" class="btn btn-success">Update Blog</button>
    </form>
</div>
@endsection
