<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Create User POS</title>
</head>

<body>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m-auto">
        <div class="card my-3">
            <h3 class="card-header">Tambah User POS</h3>
            @if($errors->any())
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{$errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card-body">
                <form action="{{ url('store-user-pos') }}" method="POST">
                    @csrf
                    <input type="hidden" name="from_frontend" value="1">
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" placeholder="Name" id="name" class="form-control" name="name" required autofocus>
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="email" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="password" placeholder="Password" id="password" class="form-control" name="password" required autofocus>
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Nomor Telepon</label>
                        <input type="text" placeholder="Nomor Telepon" id="notel" class="form-control" name="notel" required autofocus>
                        @if ($errors->has('notel'))
                        <span class="text-danger">{{ $errors->first('notel') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="">PIC</label>
                        <input type="hidden" name="pic_id" value="{{ $pic->id }}">
                        <input class="form-control" readonly type="text" name="pic_name" value="{{ $pic->name }}">
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
</body>
@include('sweetalert::alert')
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
</html>