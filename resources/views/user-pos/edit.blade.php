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
                    <label for="">Provinsi</label>
                    <select class="provinsi select2 form-control p-1" name="provinsi">
                        <option value="" disabled selected> Pilih Provinsi </option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Kabupaten</label>
                    <select class="kabupaten select2 form-control p-1" name="kabupaten">
                        <option value="" disabled selected> Pilih Kabupaten </option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Kecamatan</label>
                    <select class="kecamatan select2 form-control p-1" name="kecamatan">
                        <option value="" disabled selected> Pilih Kecamatan </option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Kelurahan</label>
                    <select class="kelurahan select2 form-control p-1" name="kelurahan">
                        <option value="" disabled selected> Pilih Kelurahan </option>
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
@push('js')
    <script>
        $('.select2').select2();

        $.ajax({
            type: "GET",
            url: "{{ url('provinces') }}",
            dataType: "json",
            success: function(res) {

                $.each(res, function(k, v) {
                    var newOption = new Option(v.name, v.id, false, false);
                    $('.provinsi').append(newOption);
                });

            }
        });

        $('.provinsi').change(function() {

            $('.kabupaten').html('');

            $.ajax({
                type: "GET",
                url: "{{ url('regencies') }}" + '/' + $(this).val(),
                dataType: "json",
                success: function(res) {

                    $.each(res, function(k, v) {
                        var newOption = new Option(v.name, v.id, false, false);
                        $('.kabupaten').append(newOption);
                    });

                }
            });
        });

        $('.kabupaten').change(function() {

            $('.kecamatan').html('');

            $.ajax({
                type: "GET",
                url: "{{ url('districts') }}" + '/' + $(this).val(),
                dataType: "json",
                success: function(res) {

                    $.each(res, function(k, v) {
                        var newOption = new Option(v.name, v.id, false, false);
                        $('.kecamatan').append(newOption);
                    });

                }
            });
        });
        $('.kecamatan').change(function() {
            $.ajax({
                type: "GET",
                url: "{{ url('villages') }}" + '/' + $(this).val(),
                dataType: "json",
                success: function(res) {
                    
                    $('.kelurahan').html('');
                    $.each(res, function(k, v) {
                        $('.kelurahan').append(new Option(v.name, v.id, true, true));
                    });

                }
            });
        });
    </script>
@endpush