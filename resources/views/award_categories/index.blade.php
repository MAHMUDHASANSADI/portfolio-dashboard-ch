{{-- resources/views/businesses/index.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Award List</h1>
    <a href="{{ route('award_category.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Awards</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($categories[0]))
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->awards->pluck('name')->implode(', ') }}</td>
                    <td>
                        <a href="{{ route('award_category.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('award_category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('award_category.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this business?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
