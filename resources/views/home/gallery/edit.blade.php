<!-- resources/views/gallerys/edit.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>Edit Gallery</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            <small>Current Image:</small>
            <br>
            <img src="{{ asset('storage/' . $gallery->image) }}" alt="Image" width="100">
        </div>
        <button type="submit" class="btn btn-success">Update Gallery</button>
    </form>
</div>
@endsection
