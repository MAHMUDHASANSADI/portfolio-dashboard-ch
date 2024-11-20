@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="text-white mb-0">
                        {{ $title }}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('change-password.store') }}" method="POST" class="crud-form">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" id="current_password">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary crud-button">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
