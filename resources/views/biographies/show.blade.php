{{-- resources/views/biographies/show.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Biography Details</h1>

    <div class="card">
        <div class="card-body">
            <p class="card-text">Description: {{ $biography->description }}</p>
        </div>
    </div>

    <a href="{{ route('biography.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
