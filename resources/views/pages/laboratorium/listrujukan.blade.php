@extends('layouts/header_laboratorium')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List Rujukan</h1>
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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Dokter</th>
                            <th>Pasien</th>
                            <th>Jenis Pemeriksaan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>                           
                            <th>Tempat Rujukan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($rujukan as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{\Carbon\Carbon::parse($item->rekamedis->tanggal_pendaftaran)->format('d F Y')}}</td>
                            <td>{{$item->rekamedis->dokter->nama}}</td>
                            <td>{{$item->rekamedis->pasien->nama}}</td> 
                            <td>{{$item->jenis_pemeriksaan}}</td>         
                            <td>{{$item->rekamedis->diagnosa}}</td>
                            <td>{{$item->rekamedis->tindakan}}</td>                                                                          
                            <td>{{$item->tempatRujukan->nama}}</td>
                            <td>
                                <span class="badge badge-info">{{$item->status}}</span>
                            </td>
                            <td>
                                <a href="{{ route('lab.listrujukan.create', ['id'=>$item->id]) }}">
                                    <button type="button" class="btn btn-info btn-rounded"><i class="fas fa-check-circle"></i> Pilih</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
