@extends('layouts.app')
@section('menu-user-pic', 'active')
@section('page-name', 'User PIC')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active">User PIC</li>
@endsection()
@section('content')
<div class="col-md-8">
    <div class="card">
        <h3 class="card-header">Create Data</h3>
        <div class="card-body">
            <form action="{{ route('user-pic.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input type="text" placeholder="Name" id="name" class="form-control" name="name" required autofocus>
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" placeholder="Password" id="password" class="form-control" name="password" required autofocus>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Nomor Telepon</label>
                    <input type="text" placeholder="Nomor Telepon" id="notel" class="form-control" name="notel" required autofocus>
                    @if ($errors->has('notel'))
                    <span class="text-danger">{{ $errors->first('notel') }}</span>
                    @endif
                </div>
                <!-- <div class="form-group mb-3">
                    <label for="">Regional</label>
                    <select name="regional" class="form-control" id="">
                        <option value="" selected disabled>-Pilih data-</option>
                        @foreach ($regional as $item)
                            <option value="{{ $item->username }}">{{ $item->username }}</option>
                        @endforeach
                    </select>
                </div> -->
                <div class="form-group mb-3">
                    <label for="">Regional</label>
                    <input type="text" placeholder="Regional" id="regional" class="form-control"
                        name="regional" value="DIVRE 5" required disabled >
                    @if ($errors->has('regional'))
                    <span class="text-danger">{{ $errors->first('regional') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Witel</label>
                    <select name="witel" class="form-control" id="">
                        <option value="" selected disabled>-Pilih data-</option>
                        <option>DENPASAR</option>
                        <option>JEMBER</option>
                        <option>KEDIRI</option>
                        <option>MADIUN</option>
                        <option>MADURA</option>
                        <option>MALANG</option>
                        <option>NTB</option>
                        <option>NTT</option>
                        <option>PASURUAN</option>
                        <option>SIDOARJO</option>
                        <option>SINGARAJA</option>
                        <option>SURABAYA SELATAN</option>
                        <option>SURABAYA UTARA</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Datel</label>
                    <input type="text" placeholder="Datel" id="datel" class="form-control" name="datel" required autofocus>
                    @if ($errors->has('datel'))
                    <span class="text-danger">{{ $errors->first('datel') }}</span>
                    @endif
                </div>
                <!-- <div class="form-group mb-3">
                    <label for="">Witel</label>
                    <input type="text" placeholder="Witel" id="witel" class="form-control"
                        name="witel" required autofocus>
                    @if ($errors->has('witel'))
                    <span class="text-danger">{{ $errors->first('witel') }}</span>
                    @endif
                </div> -->
                <div class="d-grid mx-auto mt-3">
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection