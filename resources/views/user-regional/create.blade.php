@extends('layouts.app')
@section('menu-user-regional', 'active')
@section('page-name', 'User Regional')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">User Regional</li>
@endsection()
@section('content')
<div class="col-md-8">
    <div class="card">
        <h3 class="card-header">Create Data</h3>
        <div class="card-body">
            <form action="{{ route('user-regional.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                        required autofocus>
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Job Title</label>
                    <input type="text" placeholder="Job Title" id="job_title" class="form-control" name="job_title"
                        required autofocus>
                    @if ($errors->has('job_title'))
                    <span class="text-danger">{{ $errors->first('job_title') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" placeholder="Email" id="email_address" class="form-control"
                        name="email" required autofocus>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Role</label>
                    <select name="role" class="form-control" id="">
                        <option value="Manager">Manager</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" placeholder="Password" id="password" class="form-control"
                        name="password" required>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="d-grid mx-auto mt-3">
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection