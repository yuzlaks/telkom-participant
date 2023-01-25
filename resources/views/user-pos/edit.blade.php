@extends('layouts.app')
@section('menu-user-pos', 'active')
@section('page-name', 'User POS')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">User POS</li>
@endsection()
@section('content')
<div class="col-md-8">
    <div class="card">
        <h3 class="card-header">Update Data
            <div class="pull-right" style="float:right">
                <a class="btn btn-default" href="{{ route('user-pos.index') }}"> Kembali</a>
            </div>
        </h3>
        <div class="card-body">
            <form action="{{ route('user-pos.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input value="{{ $data->nama }}" type="text" placeholder="Name" id="name" class="form-control" name="name"
                        required autofocus>
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input value="{{ $data->email }}" type="email" placeholder="Email" id="email" class="form-control" name="email"
                        required autofocus>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" placeholder="Password" id="password" class="form-control" name="password"
                        required autofocus>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Nomor Telepon</label>
                    <input value="{{ $data->notel }}" type="text" placeholder="Nomor Telepon" id="notel" class="form-control"
                        name="notel" required autofocus>
                    @if ($errors->has('notel'))
                    <span class="text-danger">{{ $errors->first('notel') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">PIC</label>
                    <select name="pic_id" class="form-control" id="">
                        @foreach ($pic as $item)
                            <option {{ ($item->id == $data->pic_id) ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Alamat</label>
                    <textarea name="alamat" class="form-control" id="" cols="30" rows="10">{{ $data->alamat }}</textarea>
                    @if ($errors->has('alamat'))
                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Kecamatan</label>
                    <input value="{{ $data->kecamatan }}" type="text" placeholder="kecamatan" id="kecamatan" class="form-control"
                        name="kecamatan" required autofocus>
                    @if ($errors->has('kecamatan'))
                    <span class="text-danger">{{ $errors->first('kecamatan') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Kabupaten</label>
                    <input value="{{ $data->kabupaten }}" type="text" placeholder="kabupaten" id="kabupaten" class="form-control"
                        name="kabupaten" required autofocus>
                    @if ($errors->has('kabupaten'))
                    <span class="text-danger">{{ $errors->first('kabupaten') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Url</label>
                    <input value="{{ $data->url }}" type="text" placeholder="url" id="url" class="form-control"
                        name="url" required autofocus>
                    @if ($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
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