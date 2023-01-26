<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Create User POS</title>
</head>
<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
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
                        <form action="{{ route('user-pos.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="from_frontend" value="1">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="email" placeholder="Email" id="email" class="form-control" name="email"
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
                                <input type="text" placeholder="Nomor Telepon" id="notel" class="form-control"
                                    name="notel" required autofocus>
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
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control" id="" cols="30" rows="10"></textarea>
                                @if ($errors->has('alamat'))
                                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Kecamatan</label>
                                <input type="text" placeholder="kecamatan" id="kecamatan" class="form-control"
                                    name="kecamatan" required autofocus>
                                @if ($errors->has('kecamatan'))
                                <span class="text-danger">{{ $errors->first('kecamatan') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Kabupaten</label>
                                <input type="text" placeholder="kabupaten" id="kabupaten" class="form-control"
                                    name="kabupaten" required autofocus>
                                @if ($errors->has('kabupaten'))
                                <span class="text-danger">{{ $errors->first('kabupaten') }}</span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto mt-3">
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>