@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="text-white mb-0">
                        {{ $title }}
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