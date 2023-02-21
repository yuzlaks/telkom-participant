@extends('layouts.app')
@section('menu-materi-promosi', 'active')
@section('page-name', 'Materi Promosi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Materi Promosi</li>
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
                <h2 class="card-title">Show Materi Promosi</h2>
                <div class="pull-right" style="float:right">
                    <a class="btn btn-default" href="{{ route('materi-promosi.index') }}"> Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Program</th>
                                    <td>{{ $data->nama_program }}</td>
                                </tr>
                                <tr>
                                    <th>Link</th>
                                    <td>{{ $data->link }}</td>
                                </tr>
                                <tr>
                                    <th>Periode Rilis</th>
                                    <td>{{ $data->periode_rilis }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    <td>{{ $data->tahun }}</td>
                                </tr>
                                <tr>
                                    <th>Berlaku Hingga</th>
                                    <td>{{ $data->berlaku_hingga }}</td>
                                </tr>
                                <tr>
                                    <th>Dibuat Oleh</th>
                                    <td>{{ $data->createdby }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
