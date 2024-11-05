@extends('app')

@section('content')
<div class="container">
    <h1>Add New Award</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('award.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="award_category_id" class="form-label">Category</label>
            <select name="award_category_id" class="form-control" id="award_category_id" required>
                @if(isset($categories[0]))
                @foreach($categories as $key => $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
                @endif
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
        <a href="{{ route('award.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection
