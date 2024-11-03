{{-- resources/views/videos/show.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Video Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $video->title }}</h5>
            <p class="card-text">Description: {{ $video->description }}</p>
            <p class="card-text">URL: {{ $video->url }}</p>
        </div>
    </div>

    <a href="{{ route('video.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
