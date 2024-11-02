{{-- resources/views/businesses/index.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Business List</h1>
    <a href="{{ route('business.create') }}" class="btn btn-primary mb-3">Add New Business</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($businesses as $business)
                <tr>
                    <td>{{ $business->id }}</td>
                    <td>{{ $business->name }}</td>
                    <td>{{ $business->description }}</td>
                    <td>
                        <a href="{{ route('business.show', $business->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('business.edit', $business->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('business.destroy', $business->id) }}" method="POST" style="display:inline-block;">
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
