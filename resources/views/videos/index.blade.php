{{-- resources/views/vidoes/index.blade.php --}}
@extends('app')

@section('content')
<div class="container">
    <h1 class="container">Video List</h1>
    <a href="{{ route('video.create') }}" class="btn btn-primary mb-3 float-end">Add New video</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered container">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Url</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($videos as $video)
                <tr>
                    <td>{{ $video->id }}</td>
                    <td>{{ $video->name }}</td>
                    <td>{{ $video->description }}</td>
                    <td>{{ $video->url }}</td>
                    <td>
                        <a href="{{ route('video.show', $video->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('video.destroy', $video->id) }}" method="POST" style="display:inline-block;">
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
