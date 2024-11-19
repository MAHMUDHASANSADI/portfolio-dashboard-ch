<div class="container">
    <h1>{{ $program->title }}</h1>
    <p>{{ $program->description }}</p>
    <p><strong>Date:</strong> {{ $program->price }}</p>
    <img src="{{ asset('storage/'.$program->image) }}" alt="Image" width="300">
    <br><br>
</div>

