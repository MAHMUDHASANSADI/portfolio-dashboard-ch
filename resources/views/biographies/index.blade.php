{{-- resources/views/biographies/index.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Biography List</h1>
    <a href="{{ route('biography.create') }}" class="btn btn-primary mb-3 float-end">Add New Biography</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($biographies as $biography)
                <tr>
                    <td>{{ $biography->id }}</td>
                    <td>{{ $biography->description }}</td>
                    <td>
                        <a href="{{ route('biography.show', $biography->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('biography.edit', $biography->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('biography.destroy', $biography->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this business?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
