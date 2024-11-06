<!-- resources/views/news/show.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>{{ $news->title }}</h1>
    <p>{{ $news->description }}</p>
    <p><strong>Date:</strong> {{ $news->date }}</p>
    <img src="{{ asset('storage/' . $news->image) }}" alt="Image" width="300">
    <br><br>
    <a href="{{ route('news.index') }}" class="btn btn-secondary">Back to news</a>
</div>
@endsection
