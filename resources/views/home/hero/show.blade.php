
<div class="container">
    <h1>{{ $hero->title }}</h1>
    <p>{{ $hero->description }}</p>
    <img src="{{ asset('storage/'.$hero->image) }}" alt="Image" width="300">
    <br><br>
</div>
