@extends('layouts.app')
@section('menu-pos', 'active')
@section('page-name', 'POS')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">POS</li>
@endsection()

@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $errors->first() }}
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
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten</th>
                            <th>Provinsi</th>
                            <th>Status FU</th>
                            <th>Status Offering</th>
                            <th>No SC</th>
                            <th>Progres</th>
                            <th>Status Bayar</th>
                            {{-- <th width="280px">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr @if ($user->status_offering == 'cancel') class="table-danger" @endif>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->regional }}</td>
                                <td>{{ $user->witel }}</td>
                                <td>{{ $user->datel }}</td>
                                <td>{{ $user->order_name }}</td>
                                <td>{{ $user->order_email }}</td>
                                <td>
                                    {{ $user->notel }}
                                    <hr>
                                    <a data-id="{{ $user->id }}" target="_blank" href="https://wa.me/<?= str_replace('08','628', $user->notel) ?>" class="btn btn-success btn-sm hubungi">
                                        Hubungi
                                    </a>
                                </td>
                                <td>{{ $user->kelurahan }}</td>
                                <td>{{ $user->kecamatan }}</td>
                                <td>{{ $user->kabupaten }}</td>
                                <td>{{ $user->provinsi }}</td>
                                <td>{{ $user->status_fu }}</td>
                                <td>
                                    @if ($user->status_fu == 'sudah dihubungi')
                                        <center>
                                            @if ($user->status_offering != 'accept')
                                                @if ($user->status_offering == 'pending')
                                                    <div class="badge badge-warning mb-1 text-uppercase">Pending</div>
                                                @endif
                                                @if ($user->status_offering == 'cancel')
                                                    <div class="badge badge-danger mb-1 text-uppercase">Cancel</div>
                                                @endif
                                                @if ($user->status_offering != 'cancel')
                                                    <select name="" data-id="{{ $user->id }}" id="status_offering"
                                                        class="form-control">
                                                        <option selected value="null">- Pilih Status -</option>
                                                        <option value="accept">accept</option>
                                                        @if ($user->status_offering != 'pending') 
                                                            <option value="pending">pending</option>
                                                        @endif
                                                        <option value="cancel">cancel</option>
                                                    </select>
                                                @endif
                                            @else
                                                <div class="badge badge-success text-uppercase">Accept</div>
                                            @endif
                                        </center>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->status_offering == 'accept')
                                        @if (!empty($user->no_sc))
                                            {{ $user->no_sc }}
                                            @else
                                            <center>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#exampleModal{{ $key }}">
                                                    +
                                                </button>
                                            </center>
                                        @endif
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan No SC Untuk {{ $user->order_name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" class="no-sc form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="button" data-id="{{ $user->id }}" class="btn btn-primary btn-save-sc">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->progres }}</td>
                                <td>
                                    @if (!empty($user->status_bayar))
                                        @if ($user->status_bayar == 'Belum bayar')
                                            <select name="" data-id="{{ $user->id }}" id="status_bayar"
                                                class="form-control">
                                                <option disabled selected>- Pilih Status -</option>
                                                <option {{ ($user->status_bayar == 'Belum bayar') ? 'selected' : '' }} value="Belum bayar">Belum bayar</option>
                                                <option {{ ($user->status_bayar == 'Sudah dibayar') ? 'selected' : '' }} value="Sudah dibayar">Sudah dibayar</option>
                                            </select>
                                            @else
                                            <div class="badge badge-success mb-1 text-uppercase">Sudah dibayar</div>
                                        @endif  
                                    @endif
                                </td>
                                {{-- <td>
                                    <div class="btn-group" role="group">

                                    </div>
                                </td> --}}
                                <!-- All action -->
                                {{-- <td>
                            <div class="btn-group" role="group">
                                <a class="mx-1 btn btn-info" href="{{ route('pos.show', $user->id) }}">Show</a>
                                <a class="mx-1 btn btn-primary" href="{{ route('pos.edit', $user->id) }}">Edit</a>
                                <form action="{{ route('pos.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {!! $data->links() !!}
@endsection

@push('js')
    <script>
        $('body').on('change', '#status_offering', function() {
            var id = $(this).data('id');
            var status = $(this).val();

            if (status != "null") {
                $.ajax({
                    url: "{{ url('update-status-pos') }}" + '/' + id,
                    type: "POST",
                    data: {
                        status: status
                    },
                    success: function(res) {
                        Swal.fire(
                            'Berhasil!',
                            'Data berhasil diupdate',
                            'success'
                        );

                        location.reload();
                    }
                })                
            }

        });

        $('body').on('change', '#status_bayar', function() {
            var id = $(this).data('id');
            var status = $(this).val();

            $.ajax({
                url: "{{ url('update-status-bayar') }}" + '/' + id,
                type: "POST",
                data: {
                    status: status
                },
                success: function(res) {
                    Swal.fire(
                        'Berhasil!',
                        'Data berhasil diupdate',
                        'success'
                    );

                    location.reload();
                }
            })
        });

        $('body').on('click', '.btn-save-sc', function() {
            var no_sc = $(this).closest('.modal-content').find('.no-sc').val();
            var id = $(this).data('id');
            
            $.ajax({
                url: "{{ url('update-no-sc') }}" + '/' + id,
                type: "POST",
                data: {
                    no_sc: no_sc
                },
                success: function(res) {
                    Swal.fire(
                        'Berhasil!',
                        'Data berhasil diupdate',
                        'success'
                    );

                    location.reload();
                }
            })
        });

        $('body').on('click', '.hubungi', function() {
            var id = $(this).data('id');
            
            $.ajax({
                url: "{{ url('update-status-hubungi') }}" + '/' + id,
                type: "POST",
                success: function(res) {
                    Swal.fire(
                        'Berhasil!',
                        'Data berhasil diupdate',
                        'success'
                    );

                    location.reload();
                }
            })
        });
    </script>
@endpush
