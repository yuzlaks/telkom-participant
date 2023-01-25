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
                    <input type="text" placeholder="Witel" id="witel" class="form-control"
                        name="witel" required autofocus>
                    @if ($errors->has('witel'))
                    <span class="text-danger">{{ $errors->first('witel') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Datel</label>
                    <input type="text" placeholder="Datel" id="datel" class="form-control"
                        name="datel" required autofocus>
                    @if ($errors->has('datel'))
                    <span class="text-danger">{{ $errors->first('datel') }}</span>
                    @endif
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
                    <input type="number" placeholder="Nomor Telepon" id="notel" class="form-control"
                        name="notel" required autofocus>
                    @if ($errors->has('notel'))
                    <span class="text-danger">{{ $errors->first('notel') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Alamat</label>
                    <textarea name="alamat" class="form-control" id="" cols="30" rows="10"></textarea>
                    @if ($errors->has('alamat'))
                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Kecamatan</label>
                    <input type="text" placeholder="Kecamatan" id="kecamatan" class="form-control"
                        name="kecamatan" required autofocus>
                    @if ($errors->has('kecamatan'))
                    <span class="text-danger">{{ $errors->first('kecamatan') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Kabupaten</label>
                    <input type="text" placeholder="Kabupaten" id="kabupaten" class="form-control"
                        name="kabupaten" required autofocus>
                    @if ($errors->has('kabupaten'))
                    <span class="text-danger">{{ $errors->first('kabupaten') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Tanggal Order</label>
                    <input type="date" placeholder="Tanggal Order" id="tgl_order" class="form-control"
                        name="tgl_order" required autofocus>
                    @if ($errors->has('tgl_order'))
                    <span class="text-danger">{{ $errors->first('tgl_order') }}</span>
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
        $('.pos_id').change(function(){

            var pos_id = $(this).val();

            $.ajax({
                url : "/pos/get_regional/" + pos_id,
                type : "GET",
                success:function(res){
                    $('.regional').val(res);
                }
            });
        });
    </script>
@endpush