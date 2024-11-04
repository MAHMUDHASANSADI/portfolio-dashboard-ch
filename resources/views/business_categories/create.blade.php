{{-- resources/views/businesses/create.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Add New Business</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('business_category.store') }}" method="POST">
        @csrf


        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" name="category_name" class="form-control" id="category_name" value="{{ old('category_name') }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('business_category.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection
