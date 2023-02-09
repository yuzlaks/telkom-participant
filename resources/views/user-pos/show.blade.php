@extends('layouts.app')
@section('menu-user-pos', 'active')
@section('page-name', 'User POS')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">User POS</li>
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
                <h2 class="card-title">Show User POS</h2>
                <div class="pull-right" style="float:right">
                    <a class="btn btn-default" href="{{ route('user-pos.index') }}"> Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $data->nama }}</td>
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
                                    <th>PIC</th>
                                    <td>{{ $data->pic_name }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $data->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $data->provinsi }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten</th>
                                    <td>{{ $data->kabupaten }}</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>{{ $data->kecamatan }}</td>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td>{{ $data->kelurahan }}</td>
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
                            <div>{!! QrCode::size(400)->generate(url($data->url)) !!}</div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
