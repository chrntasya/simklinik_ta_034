@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rujukan</h1>
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
            {{-- <div class="row card-header">
                <div class="col-sm-2 col-12">
                    <a href="{{route('rujukan.create')}}"><button type="button" id="buttonTambahUserAdmin" class="btn btn-block btn-primary">Tambah Rujukan</button></a>
                </div>
            </div> --}}
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode</th>
                            <th>Jenis pemeriksaan</th>
                            <th>Tempat rujukan</th>
                            {{-- <th>Rekamedis</th> --}}
                            <th>Nama Pasien</th>
                            <th>Diagnosa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody><?php $no=1?>
                        @foreach($data as $datas)
                        <tr>
                            <th>{{$no++}}</th>
                            <th>{{$datas->kode}}</th>
                            <th>{{$datas->jenis_pemeriksaan}}</th>
                            <th>{{$datas->tempatRujukan->nama}}</th>
                            {{-- <th>{{$datas->rekamedis_id}}</th> --}}
                            <th>{{$datas->rekamedis->pasien->nama}}</th>
                            <th>{{$datas->rekamedis->diagnosa}}</th>
                            <th>
                                <a href="{{route('rujukan.edit', $datas->id)}}">
                                    <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                                <form style="margin-top: 5px;display:inline-block;" action="{{route('rujukan.destroy', $datas->id)}}"
                                    method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- /.content-header -->
</div>

@endsection