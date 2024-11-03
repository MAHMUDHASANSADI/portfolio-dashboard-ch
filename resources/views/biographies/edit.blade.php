{{-- resources/views/biographies/edit.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Edit Biography</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('biography.update', $business->id) }}" method="POST">
        @csrf
        @method('PUT')
       
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ $business->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('biography.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection
