@extends('app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="text-white mb-0">
                        {{ $title }}
                        <a onclick="Show('Add New Slider', '{{ route('slider.create') }}')" class="btn btn-primary" style="float: right;cursor: pointer;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Slider</a>
                    </h4>
                </div>
                <div class="card-body">
                    @include('yajra.datatable')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
