@extends('layouts.app')
@section('menu-user-pos', 'active')
@section('page-name', 'User POS')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">User POS</li>
@endsection()

@section('content')
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
                <h2 class="card-title">Data User POS</h2>
                <div class="pull-right" style="float:right">
                    <a class="btn btn-success" href="{{ route('user-pos.create') }}"> Create New User</a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>PIC</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->notel }}</td>
                                <td>{{ $user->pic_name }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="mx-1 btn btn-info" href="{{ route('user-pos.show', $user->id) }}">Show</a>
                                        <a class="mx-1 btn btn-primary" href="{{ route('user-pos.edit', $user->id) }}">Edit</a>
                                        <form action="{{ route('user-pos.destroy', $user->id) }}" method="POST">
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
