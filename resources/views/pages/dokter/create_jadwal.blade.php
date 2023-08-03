@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dokter</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
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
        <div class="card">
            <div class="card-body">
                <form role="form" action="{{route('buat_jadwal_dokter')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Dokter">Pilih Dokter</label>
                            <select name="dokter_id" class="form-control">
                                @foreach ($dokter as $item)
                                    <option value="{{$item->users->id}}">{{$item->users->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dokterspesialis">Pilih Hari</label>
                            <select name="hari" class="form-control">
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jumat</option>
                                    <option value="sabtu">Sabtu</option>
                                    <option value="minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Waktu">Waktu Mulai</label>
                            <input name="waktu_mulai" type="time" class="form-control" id="Waktu"
                                placeholder="Waktu Mulai">
                        </div>
                        <div class="form-group">
                            <label for="Waktu">Waktu Selesai</label>
                            <input name="waktu_selesai" type="time" class="form-control" id="Waktu"
                                placeholder="Waktu Selesai">
                        </div>
                        <div class="form-group">
                            <label for="Ruangan">Ruangan</label>
                            <input name="ruangan" type="text" class="form-control" id="Ruangan"
                                placeholder="Ruangan">
                        </div>
                        <div class="form-group">
                            <label for="Ruangan">Kuota</label>
                            <input name="stok" type="text" class="form-control" id="stok"
                                placeholder="Masukan Kuota">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('jadwal_dokter') }}"><button id="buttonCancel" type="button"
                            class="btn btn-default">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.content-header -->
</div>
@endsection
