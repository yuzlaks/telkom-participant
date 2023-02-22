@extends('layouts.app')
@section('menu-user-pic', 'active')
@section('page-name', 'User PIC')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">User PIC</li>
@endsection()

@section('content')
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Show User PIC</h2>
                <div class="pull-right" style="float:right">
                    <a class="btn btn-default" href="{{ route('user-pic.index') }}"> Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <img src="{{ asset('uploads/' . @$data->foto_profil) }}" width="200px"
                                            alt="Empty">
                                    </th>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Telepon</th>
                                    <td>{{ $data->notel }}</td>
                                </tr>
                                <tr>
                                    <th>Regional</th>
                                    <td>{{ $data->regional }}</td>
                                </tr>
                                <tr>
                                    <th>Datel</th>
                                    <td>{{ $data->datel }}</td>
                                </tr>
                                <tr>
                                    <th>Witel</th>
                                    <td>{{ $data->witel }}</td>
                                </tr>
                                <tr>
                                    <th>Url</th>
                                    <td>{{ $data->url }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <center>
                            <div>{!! QrCode::size(350)->generate(url($data->url)) !!}</div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
