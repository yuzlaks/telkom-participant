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
        <h3 class="card-header">Update Data
            <div class="pull-right" style="float:right">
                <a class="btn btn-default" href="{{ route('user-pic.index') }}"> Kembali</a>
            </div>
        </h3>
        <div class="card-body">
            <form action="{{ route('user-pic.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input value="{{ $data->name }}" type="text" placeholder="Name" id="name" class="form-control" name="name"
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
                    <img src="{{ asset('uploads/'.@$data->foto_profil) }}" alt="
                    Empty" width="200px"> <br>
                    <label for="">Foto Profil</label>
                    <input type="file" placeholder="Foto Profil" id="foto_profil" class="form-control" name="foto_profil" autofocus>
                    @if ($errors->has('foto_profil'))
                    <span class="text-danger">{{ $errors->first('foto_profil') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="">Regional</label>
                    <input value="{{ $data->regional }}" type="text" class="form-control" name="regional" readonly required autofocus>
                    <!-- <select name="regional" class="form-control" id="">
                        @foreach ($regional as $item)
                            <option {{ ($item->regional == $data->regional) ? "selected" : "" }} value="{{ $item->username }}">{{ $item->username }}</option>
                        @endforeach
                    </select> -->
                </div>

                <div class="form-group mb-3">
                    <label for="">Witel</label>
                    <select name="witel" class="form-control" id="witel">
                        <option value="" selected disabled>-Pilih data-</option>
                        @foreach ($witel as $item)
                            <option {{ ($item->witel == $data->witel) ? "selected" : "" }} value="{{ $item->witel }}">{{ $item->witel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Datel</label>
                    <select name="datel" id="datel" class="form-control"></select>
                    @if ($errors->has('datel'))
                    <span class="text-danger">{{ $errors->first('datel') }}</span>
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
        $(document).ready(function(){

            getDatel();

            $('#witel').change(function(){
                $('#datel').html('');
                var id_witel = $('#witel').val();
                $.ajax({
                    url : "{{ url('get-datel') }}"+"/"+id_witel,
                    type : "GET",
                    success:function(res){

                        var option;
                        $.each(res, function(k,v){
                            option += `<option>${v.datel}</option>`;
                        })

                        $('#datel').append(option);
                        console.log(res);
                    }
                })
            }) 
        });

        function getDatel() {
            $('#datel').html('');
                var id_witel = $('#witel').val();
                $.ajax({
                    url : "{{ url('get-datel') }}"+"/"+id_witel,
                    type : "GET",
                    success:function(res){

                        var option;
                        $.each(res, function(k,v){
                            option += `<option>${v.datel}</option>`;
                        })

                        $('#datel').append(option);
                        console.log(res);
                    }
            })
        }
    </script>
@endpush