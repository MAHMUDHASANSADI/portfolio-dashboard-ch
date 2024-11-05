@extends('app')

@section('content')
<div class="container">
    <h1>Award List</h1>
    <a href="{{ route('award.create') }}" class="btn btn-primary mb-3">Add New Award</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($awards as $award)
                <tr>
                    <td>{{ $award->id }}</td>
                    <td>{{ $award->awardCategory->category_name }}</td>
                    <td>{{ $award->name }}</td>
                    <td>{{ $award->description }}</td>
                    <td>
                        <a href="{{ route('award.show', $award->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('award.edit', $award->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('award.destroy', $award->id) }}" method="POST" style="display:inline-block;">
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
