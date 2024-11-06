<!-- resources/views/programs/index.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>All Programs</h1>
    <a href="{{ route('program.create') }}" class="btn btn-primary mb-3">Add New Program</a>

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
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
            <tr>
                <td><img src="{{ asset('storage/' . $program->image) }}" alt="Image" width="50"></td>
                <td>{{ $program->title }}</td>
                <td>{{ Str::limit($program->description, 50) }}</td>
                <td>{{ $program->price }}</td>
                <td>
                    <a href="{{ route('program.show', $program->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('program.edit', $program->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('program.destroy', $program->id) }}" method="POST" style="display: inline-block;">
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
