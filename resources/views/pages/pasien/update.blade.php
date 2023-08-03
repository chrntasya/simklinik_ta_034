@extends('layouts/header')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Pasien</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>Error!</strong> {{ $message }}
                        </div>
                    @endif
                    @if (session('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            <strong>Opps!</strong> {{ session('error_message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" action="{{ route('user_pasien.update', $pasien->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input name="username" type="text" class="form-control" id="Username"
                                    placeholder="Masukkan username pasien" value="{{ $pasien->users->username }}" required
                                    value="{{ old('username') }}">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input name="password" type="password" class="form-control" id="password"
                                    placeholder=" Masukkan password baru" value="{{ $pasien->users->password }}">
                            </div>
                            <div class="form-group">
                                <label for="no_rm">Nomor RM</label>
                                <input name="kode" type="text" class="form-control" id="no_rm"
                                    placeholder="Masukkan Nomor RM (cth : AAB10)" value="{{ $pasien->users->kode }}"
                                    required value="{{ old('no_rm') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input name="nama" type="text" class="form-control" id="Nama"
                                    placeholder="Masukkan nama pasien" value="{{ $pasien->users->nama }}" required
                                    value="{{ old('nama') }}">
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input name="pekerjaan" type="text" class="form-control" id="pekerjaan"
                                    placeholder="Masukkan pekerjaan pasien" value="{{ $pasien->users->pekerjaan }}"
                                    required value="{{ old('pekerjaan') }}">
                            </div>
                            <div class="form-group">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input name="nomor_telepon" type="number" class="form-control" id="nomor_telepon"
                                    placeholder="Masukkan nomor telepon pasien" value="{{ $pasien->users->nomor_telepon }}"
                                    required value="{{ old('nomor_telepon') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email"
                                    placeholder="Masukkan alamat email" value="{{ $pasien->users->email }}" 
                                    value="{{ old('email') }}">
                                <small class="text-warning"><i class="fa fa-info-circle"></i> Pastikan email belum pernah di
                                    daftarkan
                                    sebelumnya</small>
                            </div>
                           
                            <div class="form-group">
                                <label for="Tempat Lahir">Tempat Lahir</label>
                                <input name="tempat_lahir" type="text" class="form-control" id="TempatLahir"
                                    placeholder="Masukkan tempat lahir" value="{{ $pasien->users->tempat_lahir }}"
                                    required value="{{ old('tempat_lahir') }}">
                            </div>
                            <div class="form-group">
                                <label for="Tanggal Lahir">Tanggal Lahir</label>
                                <input name="tanggal_lahir" type="date" class="form-control" id="TanggalLahir"
                                    placeholder="TMasukkan tanggal lahir" value="{{ $pasien->users->tanggal_lahir }}"
                                    required value="{{ old('tanggal_lahir') }}">
                            </div>
                            <div class="form-group">
                                <label for="Judul Berita">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="-" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="P" {{ $pasien->users->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                    <option value="L" {{ $pasien->users->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input name="nik" type="text" class="form-control" id="nik"
                                    placeholder="Masukkan NIK" required value="{{ $pasien->users->nik }}">
                            </div>
                            <div class="form-group">
                                <label for="Alamat Rumah">Alamat Rumah</label>
                                <textarea name="alamat_rumah" type="text" class="form-control" id="alamat_rumah"
                                    placeholder="Masukkan alamat lengkap" value="{{ $pasien->users->alamat_rumah }}" required
                                    value="{{ old('alamat_rumah') }}">{{ $pasien->users->alamat_rumah }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('user_pasien.index') }}"><button id="buttonCancel" type="button"
                                    class="btn btn-default">Cancel</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- /.content-header -->
    </div>
@endsection
