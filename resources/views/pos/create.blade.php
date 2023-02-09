@extends('layouts.app')
@section('menu-pos', 'active')
@section('page-name', 'POS')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">POS</li>
@endsection()
@section('content')
    <div class="col-md-8">
        <div class="card">
            <h3 class="card-header">Create Data</h3>
            <div class="card-body">
                <form action="{{ route('pos.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">User POS</label>
                        <select name="pos_id" class="form-control pos_id" id="">
                            <option value="" selected disabled>-Pilih data-</option>
                            @foreach ($pos as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Regional</label>
                        <input type="text" readonly name="regional" class="form-control regional">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Witel</label>
                        <input type="text" placeholder="Witel" id="witel" readonly class="form-control witel"
                            name="witel" required autofocus>
                        <!-- @if ($errors->has('witel'))
    <span class="text-danger">{{ $errors->first('witel') }}</span>
    @endif -->
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Datel</label>
                        <input type="text" placeholder="Datel" id="datel" readonly class="form-control datel"
                            name="datel" required autofocus>
                        <!-- @if ($errors->has('datel'))
    <span class="text-danger">{{ $errors->first('datel') }}</span>
    @endif -->
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Order Name</label>
                        <input type="text" placeholder="Order Name" id="order_name" class="form-control"
                            name="order_name" required autofocus>
                        @if ($errors->has('order_name'))
                            <span class="text-danger">{{ $errors->first('order_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Order Email</label>
                        <input type="email" placeholder="Order Email" id="order_email" class="form-control"
                            name="order_email" required autofocus>
                        @if ($errors->has('order_email'))
                            <span class="text-danger">{{ $errors->first('order_email') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Nomor Telepon</label>
                        <input type="number" placeholder="Nomor Telepon" id="notel" class="form-control" name="notel"
                            required autofocus>
                        @if ($errors->has('notel'))
                            <span class="text-danger">{{ $errors->first('notel') }}</span>
                        @endif
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
                        <label for="">Alamat Instalasi</label>
                        <textarea name="alamat" class="form-control" id="" cols="30" rows="10"></textarea>
                        @if ($errors->has('alamat'))
                            <span class="text-danger">{{ $errors->first('alamat') }}</span>
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

<?php header('Access-Control-Allow-Origin: *'); ?>
@push('js')
    <script>
        $('.select2').select2();

        $('.pos_id').change(function() {

            var pos_id = $(this).val();

            $.ajax({
                url: "/pos/get_regional/" + pos_id,
                type: "GET",
                success: function(res) {
                    $('.regional').val("DIVRE 5");
                    $('.witel').val(res.witel);
                    $('.datel').val(res.datel);
                }
            });
        });


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
