<!-- resources/views/heros/show.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>{{ $hero->title }}</h1>
    <p>{{ $hero->description }}</p>
    <img src="{{ asset('storage/' . $hero->image) }}" alt="Image" width="300">
    <br><br>
    <a href="{{ route('hero.index') }}" class="btn btn-secondary">Back to Blogs</a>
</div>
@endsection
