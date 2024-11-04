<!-- resources/views/blogs/index.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>All Blogs</h1>
    <a href="{{ route('blog.create') }}" class="btn btn-primary mb-3">Add New Blog</a>

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
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td><img src="{{ asset('storage/' . $blog->image) }}" alt="Image" width="50"></td>
                <td>{{ $blog->title }}</td>
                <td>{{ Str::limit($blog->description, 50) }}</td>
                <td>{{ $blog->date }}</td>
                <td>
                    <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display: inline-block;">
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
