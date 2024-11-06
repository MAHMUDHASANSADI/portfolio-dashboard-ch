<!-- resources/views/heros/index.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>All Blogs</h1>
    <a href="{{ route('hero.create') }}" class="btn btn-primary mb-3">Add New Blog</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($heros as $hero)
            <tr>
                <td><img src="{{ asset('storage/' . $hero->image) }}" alt="Image" width="50"></td>
                <td>{{ $hero->title }}</td>
                <td>{{ Str::limit($hero->description, 50) }}</td>
                
                <td>
                    <a href="{{ route('hero.show', $hero->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('hero.edit', $hero->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('hero.destroy', $hero->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
