@extends('layouts.app')
@section('menu-dashboard', 'active')
@section('page-name', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection()

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $userregional  }}</h3>
                        <p>User Regional</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ url('/user-regional') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53</h3>
                        <p>User PIC</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ url('/user-pic') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>
                        <p>User POS</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ url('/user-pos') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Customer</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ url('/pos') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Data Saya</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $dataUser->name ?? $dataUser->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $dataUser->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Telepon</th>
                                            <td>{{ $dataUser->notel }}</td>
                                        </tr>
                                        <tr>
                                            @if (!empty($dataUser->regional))
                                                <th>Regional</th>
                                                <td>{{ $dataUser->regional }}</td>
                                                @else
                                                <th>PIC</th>
                                                <td>{{ $dataUser->pic_name }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if (!empty($dataUser->datel))
                                            <th>Datel</th>
                                            <td>{{ $dataUser->datel }}</td>
                                            @else
                                            <th>Alamat</th>
                                            <td>{{ $dataUser->alamat }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if (!empty($dataUser->witel))
                                            <th>Witel</th>
                                            <td>{{ $dataUser->witel }}</td>
                                            @else
                                            <th>Kecamatan</th>
                                            <td>{{ $dataUser->kecamatan }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if (!empty($dataUser->kabupaten))
                                            <th>Kabupaten</th>
                                            <td>{{ $dataUser->kabupaten }}</td>
                                            @endif
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <center>
                                        {!! QrCode::size(300)->generate(url($dataUser->url)) !!}
                                        {{ $dataUser->url }}
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
