@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Rujukan</h1>
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
                    <div class="card-body row">
                        <div class="col-6 row">
                            <div class="col-4">Diagnosa</div>
                            <div class="mr-2">:</div>
                            <div class="">{{ $val->rekamedis->diagnosa }}</div>
                        </div>
                        <div class="col-6 row">
                            <div class="col-4">Tindakan</div>
                            <div class="mr-2">:</div>
                            <div class="">{{ $val->rekamedis->tindakan }}</div>
                        </div>
                        <div class="col-6 row">
                            <div class="col-4">Nama Pasien</div>
                            <div class="mr-2">:</div>
                            <div class="">{{ $val->rekamedis->pasien->nama }}</div>
                        </div>
                    </div>
                </div>
        <div class="card">
            {{-- <div class="row card-header">
                <div class="col-sm-2 col-12">
                    <a href="{{route('rujukan.create')}}"><button type="button" id="buttonTambahUserAdmin" class="btn btn-block btn-primary">Tambah
                        Admin</button></a>
                </div>
            </div> --}}
            <div class="card-body">
                <form role="form" action="{{ route('rujukan.update',$val->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input name="kode" type="text" class="form-control" id="kode"
                            placeholder="Masukkan Kode Rujukan" required value="{{$val->kode}}{{ old('kode') }}">
                        </div>
                        <div class="form-group">
                            <label for="jenis_pemeriksaan">Jenis Pemeriksaan</label>
                            <input name="jenis_pemeriksaan" type="text" class="form-control" id="jenis_pemeriksaan"
                            placeholder="Masukkan Jenis Pemeriksaan" required value="{{$val->jenis_pemeriksaan}}{{ old('jenis_pemeriksaan') }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_berkunjung">Tanggal Berkunjung</label>
                            <input name="tgl_berkunjung" type="date" class="form-control" id="tgl_berkunjung"
                            placeholder="" required value="{{$val->tglberkunjung}}{{ old('jenis_pemeriksaan') }}">
                        </div>
                        <div class="form-group">
                            <label for="tempat_rujukan_id">Tempat Rujukan</label>
                            <select name="tempat_rujukan_id" class="form-control">
                                <option value="-" selected disabled>Pilih Tempat Rujukan</option>
                                @foreach($tempat as $tempat_rujukan)
                                    @if($tempat_rujukan->id == $val->tempat_rujukan_id)
                                        <option value="{{ $tempat_rujukan->id }}" selected>{{ $tempat_rujukan->nama }}</option>
                                    @else
                                        <option value="{{ $tempat_rujukan->id }}">{{ $tempat_rujukan->nama }}</option>       
                                    @endif
                                @endforeach 
                            </select>
                        </div>
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