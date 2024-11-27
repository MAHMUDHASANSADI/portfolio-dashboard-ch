@extends('business::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('business.name') !!}</p>
@endsection
