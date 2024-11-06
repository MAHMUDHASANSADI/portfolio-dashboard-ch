<!-- resources/views/programs/show.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>{{ $program->title }}</h1>
    <p>{{ $program->description }}</p>
    <p><strong>Date:</strong> {{ $program->price }}</p>
    <img src="{{ asset('storage/' . $program->image) }}" alt="Image" width="300">
    <br><br>
    <a href="{{ route('program.index') }}" class="btn btn-secondary">Back to Programs</a>
</div>
@endsection
