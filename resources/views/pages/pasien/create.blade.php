@extends('layouts/header')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Pasien</h1>
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
                    <form role="form" action="{{ route('user_pasien.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input name="username" type="text" class="form-control" id="Username"
                                    placeholder="Masukkan username pasien" required value="{{ old('username') }}">
                            </div>
                            <div class="form-group">
                                <label for="no_rm">Nomor RM</label>
                                <input name="kode" type="text" class="form-control" id="no_rm"
                                    placeholder="Nomor RM akan terisi otomatis" required value="{{ old('no_rm') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control" id="password"
                                    placeholder="Masukkan password min. 8 karakter" required value="{{ old('password') }}">
                            </div>
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input name="nama" type="text" class="form-control" id="Nama"
                                    placeholder="Masukkan nama pasien" required value="{{ old('nama') }}">
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input name="pekerjaan" type="text" class="form-control" id="pekerjaan"
                                    placeholder="Masukkan pekerjaan pasien" required value="{{ old('pekerjaan') }}">
                            </div>
                            <div class="form-group">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input name="nomor_telepon" type="number" class="form-control" id="nomor_telepon"
                                    placeholder="Masukkan nomor telepon" required value="{{ old('nomor_telepon') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email"
                                    placeholder="Masukkan alamat email"  value="{{ old('email') }}">                              
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input name="nik" type="text" class="form-control" id="nik"
                                    placeholder="Masukkan NIK" required value="{{ old('nik') }}">
                            </div>
                            <div class="form-group">
                                <label for="Tempat Lahir">Tempat Lahir</label>
                                <input name="tempat_lahir" type="text" class="form-control" id="TempatLahir"
                                    placeholder="Masukkan tempat lahir" required value="{{ old('tempat_lahir') }}">
                            </div>
                            <div class="form-group">
                                <label for="Tanggal Lahir">Tanggal Lahir</label>
                                <input name="tanggal_lahir" type="date" class="form-control" id="TanggalLahir"
                                    placeholder="Masukkan Tanggal Lahir" required value="{{ old('tanggal_lahir') }}">
                            </div>
                            <div class="form-group">
                                <label for="Judul Berita">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="-" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="P">Perempuan</option>
                                    <option value="L">Laki-laki</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Alamat Rumah">Alamat Rumah</label>
                                <textarea name="alamat_rumah" type="text" class="form-control" id="alamat_rumah"
                                    placeholder="Masukkan alamat lengkap" required value="">{{ old('alamat_rumah') }}</textarea>
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
