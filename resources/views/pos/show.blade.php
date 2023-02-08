@extends('layouts.app')
@section('menu-pos', 'active')
@section('page-name', 'POS')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">POS</li>
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
                <h2 class="card-title">Show POS</h2>
                <div class="pull-right" style="float:right">
                    <a class="btn btn-default" href="{{ route('pos.index') }}"> Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Regional</th>
                                    <td>{{ @$data->regional }}</td>
                                </tr>
                                <tr>
                                    <th>Nama POS</th>
                                    <td>{{ $data->pos_name }}</td>
                                </tr>
                                <tr>
                                    <th>Witel</th>
                                    <td>{{ $data->witel }}</td>
                                </tr>
                                <tr>
                                    <th>Datel</th>
                                    <td>{{ $data->datel }}</td>
                                </tr>
                                <tr>
                                    <th>Order Name</th>
                                    <td>{{ $data->order_name }}</td>
                                </tr>
                                <tr>
                                    <th>Order Email</th>
                                    <td>{{ $data->order_email }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Telepon</th>
                                    <td>{{ $data->notel }}</td>
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
                                    <th>Tanggal Order</th>
                                    <td>{{ $data->tgl_order }}</td>
                                </tr>
                                
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
