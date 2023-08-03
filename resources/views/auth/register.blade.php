@extends('layouts.app2')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>SIM KLINIK</b></a>
      </div>
      <div class="card-body">
        <form role="form" action="{{ route('user_pasien.register') }}" method="POST">
          @csrf        
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
          
          <div class="card-footer">
              <button type="submit" class="btn btn-primary">Register</button>
              <a href="/login"><button id="buttonCancel" type="button"
                      class="btn btn-default">Login</button></a>
          </div>
      </form>
      
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  </div>
</div>
@endsection
