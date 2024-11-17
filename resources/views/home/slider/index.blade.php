<!-- resources/views/sliders/index.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>All Gallerys</h1>
    <a href="{{ route('slider.create') }}" class="btn btn-primary mb-3">Add New Gallery</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered datatable">
        <thead>
            <tr>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
            <tr>
                <td><img src="{{ asset('storage/' . $slider->image) }}" alt="Image" width="50"></td>
                <td>
                    <a href="{{ route('slider.show', $slider->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('slider.destroy', $slider->id) }}" method="POST" style="display: inline-block;">
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
