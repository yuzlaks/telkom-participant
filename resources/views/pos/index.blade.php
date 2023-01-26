@extends('layouts.app')
@section('menu-pos', 'active')
@section('page-name', 'POS')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active">POS</li>
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
            <h2 class="card-title">Data POS</h2>
            <div class="pull-right" style="float:right">
                <a class="btn btn-success" href="{{ route('pos.create') }}"> Create POS</a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Regional</th>
                        <th>Witel</th>
                        <th>Datel</th>
                        <th>Order Name</th>
                        <th>Order Email</th>
                        <th>Notel</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->regional }}</td>
                        <td>{{ $user->witel }}</td>
                        <td>{{ $user->datel }}</td>
                        <td>{{ $user->order_name }}</td>
                        <td>{{ $user->order_email }}</td>
                        <td>{{ $user->notel }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a class="mx-1 btn btn-info" href="{{ route('pos.show', $user->id) }}">Show</a>
                                <a class="mx-1 btn btn-primary" href="{{ route('pos.edit', $user->id) }}">Edit</a>
                                <form action="{{ route('pos.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
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