@extends('layouts.app')
@section('menu-user-regional', 'active')
@section('page-name', 'User Regional')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">User Regional</li>
@endsection()

@section('content')
    <div class="col-md-6">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Show User Regional</h2>
                <div class="pull-right" style="float:right">
                    <a class="btn btn-default" href="{{ route('user-regional.index') }}"> Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <h5><b>Name :</b></h5>
                <span>
                    <div class="badge badge-success">
                    <h5>{{ $data->username }}</h5>
                    </div>
                </span>
                <h5><b>Email :</b></h5>
                <span>
                    <div class="badge badge-success">
                    <h5>{{ $data->email }}</h5>
                    </div>
                </span>
                <h5><b>Job Title :</b></h5>
                <span>
                    <div class="badge badge-success">
                    <h5>{{ $data->job_title }}</h5>
                    </div>
                </span>
                <h5><b>Role :</b></h5>
                <span>
                    <div class="badge badge-success">
                    <h5>{{ $data->role }}</h5>
                    </div>
                </span>
            </div>
        </div>
    </div>
@endsection
