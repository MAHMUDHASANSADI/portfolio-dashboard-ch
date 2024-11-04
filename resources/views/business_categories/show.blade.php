{{-- resources/views/businesses/show.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Business Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Id: {{ $business_category->id }}</h5>
            <p class="card-text">Category Name: {{ $business_category->category_name }}</p>
        </div>
    </div>

    <a href="{{ route('business_category.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
