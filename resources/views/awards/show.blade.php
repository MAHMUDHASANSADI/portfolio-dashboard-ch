@extends('app')

@section('content')
<div class="container">
    <h1>Award Details</h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Name: {{ $award->awardCategory->category_name }}</h4>
            <h5 class="card-title">Name: {{ $award->name }}</h5>
            <p class="card-text">Description: {{ $award->description }}</p>
        </div>
    </div>

    <a href="{{ route('award.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
