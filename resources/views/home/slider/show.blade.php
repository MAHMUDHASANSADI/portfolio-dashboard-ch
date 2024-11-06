<!-- resources/views/sliders/show.blade.php -->

@extends('app')

@section('content')
<div class="container">
   
    <img src="{{ asset('storage/'.$slider->image) }}" alt="Image" width="300">
    <br><br>
    <a href="{{ route('slider.index') }}" class="btn btn-secondary">Back to Blogs</a>
</div>
@endsection
