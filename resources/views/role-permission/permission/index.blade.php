@extends('app')
@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="text-white mb-0">
                        {{ $title }}
                        <a onclick="Show('Add New Permission' , '{{ route('permissions.create') }}')" class="btn btn-primary" style="float: right;cursor: pointer;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Permission</a>
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
