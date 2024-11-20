<div class="container">
    <h1>{{ $blog->title }}</h1>
    <p>{{ $blog->description }}</p>
    <p><strong>Date:</strong> {{ $blog->date }}</p>
    <img src="{{ asset('storage/' . $blog->image) }}" alt="Image" width="300">
    <br><br>
</div>
@include('crud-js')