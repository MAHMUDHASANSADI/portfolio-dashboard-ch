{{-- resources/views/biographies/create.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Add New Biography</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('biography.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('biography.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection
