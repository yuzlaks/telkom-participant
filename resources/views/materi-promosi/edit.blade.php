@extends('layouts.app')
@section('menu-materi-promosi', 'active')
@section('page-name', 'Materi Promosi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Materi Promosi</li>
@endsection()
@section('content')
<div class="col-md-8">
    <div class="card">
        <h3 class="card-header">Update Data
            <div class="pull-right" style="float:right">
                <a class="btn btn-default" href="{{ route('materi-promosi.index') }}"> Kembali</a>
            </div>
        </h3>
        <div class="card-body">
            <form action="{{ route('materi-promosi.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                @csrf
                <div class="form-group mb-3">
                    <label for="">Nama Program</label>
                    <input value="{{ $data->nama_program }}" type="text" placeholder="Nama Program" id="nama_program" class="form-control" name="nama_program" required autofocus>
                    @if ($errors->has('nama_program'))
                    <span class="text-danger">{{ $errors->first('nama_program') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Berkas</label>
                    <input value="{{ $data->link }}" type="file" placeholder="Link" id="link" class="form-control" name="link" autofocus>
                    @if ($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Periode Rilis</label>
                    <input value="{{ $data->periode_rilis }}" type="text" placeholder="Periode Rilis" id="periode_rilis" class="form-control" name="periode_rilis" required autofocus>
                    @if ($errors->has('periode_rilis'))
                    <span class="text-danger">{{ $errors->first('periode_rilis') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Tahun</label>
                    <input value="{{ $data->tahun }}" type="text" placeholder="Tahun" id="tahun" class="form-control" name="tahun" required autofocus>
                    @if ($errors->has('tahun'))
                    <span class="text-danger">{{ $errors->first('tahun') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Berlaku Hingga</label>
                    <input value="{{ $data->berlaku_hingga }}" type="text" placeholder="Berlaku Hingga" id="berlaku_hingga" class="form-control" name="berlaku_hingga" required autofocus>
                    @if ($errors->has('berlaku_hingga'))
                    <span class="text-danger">{{ $errors->first('berlaku_hingga') }}</span>
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