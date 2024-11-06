<!-- resources/views/gallerys/show.blade.php -->

@extends('app')

@section('content')
<div class="container">
   
    <img src="{{ asset('storage/'.$gallery->image) }}" alt="Image" width="300">
    <br><br>
    <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Back to Blogs</a>
</div>
@endsection
