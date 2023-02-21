@extends('layouts.app')
@section('menu-materi-promosi', 'active')
@section('page-name', 'Materi Promosi')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active">Materi Promosi</li>
@endsection()

@section('content')
<?php
    if (!empty(Auth::guard('user_regionals')->user()->username)) {
        $username = Auth::guard('user_regionals')->user()->username;
        $email = Auth::guard('user_regionals')->user()->email;
    }

    if (!empty(Auth::guard('user_pos')->user()->nama)) {
        $username = Auth::guard('user_pos')->user()->nama;
        $email = Auth::guard('user_pos')->user()->email;
    }

    if (!empty(Auth::guard('user_pic')->user()->name)) {
        $username = Auth::guard('user_pic')->user()->name;
        $email = Auth::guard('user_pic')->user()->email;
    }

?>
<div class="col-md-12">
    @if($errors->any())
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{$errors->first()}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Data Materi Promosi</h2>
            @if ($role != 0)
                <div class="pull-right" style="float:right">
                    <a class="btn btn-success" href="{{ route('materi-promosi.create') }}"> Create New User</a>
                </div>
            @endif
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Link</th>
                        <th>Periode Rilis</th>
                        <th>Tahun</th>
                        <th>Berlaku Hingga</th>
                        <th>Dibuat Oleh</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $items)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $items->nama_program }}</td>
                        <td>{{ $items->link }}</td>
                        <td>{{ $items->periode_rilis }}</td>
                        <td>{{ $items->tahun }}</td>
                        <td>{{ $items->berlaku_hingga }}</td>
                        <td>{{ $items->createdby }}</td>
                        <td>
                                <div class="btn-group" role="group">
                                    <a class="mx-1 btn btn-info" href="{{ route('materi-promosi.show', $items->id) }}">Show</a>
                                    <a class="mx-1 btn btn-primary" href="{{ route('materi-promosi.edit', $items->id) }}">Edit</a>
                                    <form action="{{ route('materi-promosi.destroy', $items->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="DELETE" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{!! $data->links() !!}
@endsection