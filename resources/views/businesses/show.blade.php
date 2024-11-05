{{-- resources/views/businesses/show.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Business Details</h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Name: {{ $business->businessCategory->category_name }}</h4>
            <h5 class="card-title">Name: {{ $business->name }}</h5>
            <p class="card-text">Description: {{ $business->description }}</p>
        </div>
    </div>

    <a href="{{ route('business.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
