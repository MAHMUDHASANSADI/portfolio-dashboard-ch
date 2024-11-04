{{-- resources/views/businesses/index.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1>Business List</h1>
    <a href="{{ route('business_category.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($business_categories as $business_category)
                <tr>
                    <td>{{$business_category->id}}</td>
                    <td>{{ $business_category->category_name }}</td>
                    <td>
                        <a href="{{ route('business_category.show', $business_category->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('business_category.edit', $business_category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('business_category.destroy', $business_category->id) }}" method="POST" style="display:inline-block;">
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
