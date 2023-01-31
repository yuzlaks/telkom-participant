@extends('layouts.app')
@section('menu-dashboard', 'active')
@section('page-name', 'Dashboard')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active">Dashboard</li>
@endsection()
<style>
    tr,
    td {
        padding: 10px
    }
</style>
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
                @if($role=="regional")
                    <a href="{{ url('/user-regional') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $userpic }}</h3>
                    <p>User PIC</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                @if($role=="regional" || $role=="pic")
                    <a href="{{ url('/user-pic') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $userpos }}</h3>
                    <p>AGENT POS</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                @if($role=="regional" || $role=="pic" || $role=="pos")
                    <a href="{{ url('/user-pos') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $pos }}</h3>
                    <p>SALES POS</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ url('/pos') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>

    @if($role != "regional")
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Data Saya</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" style="border-right: 2px solid #e1e1e1">
                            <table style="border: none">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->name ?? $dataUser->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->notel }}</td>
                                    </tr>
                                    <tr>
                                        @if (!empty($dataUser->regional))
                                        <th>Regional</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->regional }}</td>
                                        @else
                                        <th>PIC</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->pic_name }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if (!empty($dataUser->datel))
                                        <th>Datel</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->datel }}</td>
                                        @else
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->alamat }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if (!empty($dataUser->witel))
                                        <th>Witel</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->witel }}</td>
                                        @else
                                        <th>Kecamatan</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->kecamatan }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if (!empty($dataUser->kabupaten))
                                        <th>Kabupaten</th>
                                        <td>:</td>
                                        <td>{{ $dataUser->kabupaten }}</td>
                                        @endif
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        @if (!empty($dataUser->url))
                        <div class="col-md-6">
                            <div>
                                <center>
                                    {!! QrCode::size(400)->generate(url($dataUser->url)) !!}
                                    <br><br>
                                    <i>{{ $dataUser->url }}</i>
                                </center>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection