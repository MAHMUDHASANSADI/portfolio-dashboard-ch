<!-- resources/views/news/index.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>All news</h1>
    <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Add New news</a>

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
            @foreach($news as $news)
            <tr>
                <td><img src="{{ asset('storage/' . $news->image) }}" alt="Image" width="50"></td>
                <td>{{ $news->title }}</td>
                <td>{{ Str::limit($news->description, 50) }}</td>
                <td>{{ $news->date }}</td>
                <td>
                    <a href="{{ route('news.show', $news->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('news.destroy', $news->id) }}" method="POST" style="display: inline-block;">
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
