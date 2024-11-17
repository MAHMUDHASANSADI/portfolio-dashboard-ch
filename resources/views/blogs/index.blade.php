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

    <table class="table table-bordered datatable">
        <thead>
            <tr>
                <th>SL</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
