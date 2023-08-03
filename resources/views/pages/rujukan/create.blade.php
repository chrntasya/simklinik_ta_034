@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tamabah Rujukan</h1>
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
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            {{-- <div class="row card-header">
                <div class="col-sm-2 col-12">
                    <a href="{{route('rujukan.create')}}"><button type="button" id="buttonTambahUserAdmin" class="btn btn-block btn-primary">Tambah
                        Admin</button></a>
                </div>
            </div> --}}
            <div class="card-body">
                <form role="form" action="{{ route('rujukan.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kode">kode</label>
                            <input name="kode" type="text" class="form-control" id="kode"
                            placeholder="Masukkan kode pasien" required value="{{ old('kode') }}">
                        </div>
                        <div class="form-group">
                            <label for="jenis_pemeriksaan">jenis pemeriksaan</label>
                            <input name="jenis_pemeriksaan" type="text" class="form-control" id="jenis_pemeriksaan"
                            placeholder="Masukkan jenis pemeriksaan" required value="{{ old('jenis_pemeriksaan') }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_berkunjung">Tanggal Berkunjung</label>
                            <input name="tgl_berkunjung" type="date" class="form-control" id="tgl_berkunjung"
                            placeholder="Masukkan jenis pemeriksaan" required value="{{ old('tgl_berkunjung') }}">
                        </div>
                        <div class="form-group">
                            <label for="rekamedis">Rekamedis</label>
                            <select name="rekamedis" class="form-control">
                                <option value="-" selected disabled>Pilih Rekamedis</option>
                                @foreach($rekamedis as $rekamedis)
                                    <option value="{{ $rekamedis->id }}">{{ $rekamedis->pasien_id}} - {{ $rekamedis->tanggal_pendaftaran}}</option>
                                @endforeach
                                {{-- <option value="P">Perempuan</option>
                                <option value="L">Laki-laki</option> --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_rujukan_id">tempat rujukan</label>
                            <select name="tempat_rujukan_id" class="form-control">
                                <option value="-" selected disabled>Pilih tempat rujukan</option>
                                @foreach($tempat as $tempat_rujukan)
                                    <option value="{{ $tempat_rujukan->id }}">{{ $tempat_rujukan->nama }}</option>
                                @endforeach
                                {{-- <option value="L">Laki-laki</option> --}}
                            </select>
                        </div>

                     {{-- <div class="card-footer"> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('rujukan.index') }}"><button id="buttonCancel" type="button"
                                class="btn btn-default">Cancel</button></a>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>

    <!-- /.content-header -->
</div>
@endsection