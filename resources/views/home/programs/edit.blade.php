{{-- resources/views/businesses/edit.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Edit Business</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('business.update', $business->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="business_category_id" class="form-label">Category</label>
            <select name="business_category_id" class="form-control" id="business_category_id" required>
                @if(isset($categories[0]))
                @foreach($categories as $key => $category)
                <option value="{{ $category->id }}" {{ $business->business_category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $business->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ $business->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('business.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection
