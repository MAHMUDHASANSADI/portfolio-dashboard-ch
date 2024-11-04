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

    <form action="{{ route('business.store') }}" method="POST">
        @csrf
        <div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select name="category" class="form-control" id="category" required>
        <option value="">Select a category</option>
        <option value="category1" {{ old('category') == 'category1' ? 'selected' : '' }}>Category 1</option>
        <option value="category2" {{ old('category') == 'category2' ? 'selected' : '' }}>Category 2</option>
        <option value="category3" {{ old('category') == 'category3' ? 'selected' : '' }}>Category 3</option>
        <!-- Add more options as needed -->
    </select>
</div>


        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('business.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection
