
<div class="container">
    <h1>{{ $news->title }}</h1>
    <p>{{ $news->description }}</p>
    <p><strong>Date:</strong> {{ $news->date }}</p>
    <img src="{{ asset('storage/' . $news->image) }}" alt="Image" width="300">
    <br><br>
</div>
@include('crud-js')