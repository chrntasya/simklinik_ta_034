@extends('layouts/header_apoteker')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List Rekam Medis</h1>
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
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Diagnosa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($rekammedis as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{\Carbon\Carbon::parse($item->tanggal_pendaftaran)->format('d F Y')}}</td>
                            <td>{{$item->pasien->nama}}</td>
                            <td>{{$item->dokter->nama}}</td>
                            <td>{{$item->diagnosa}}</td>
                            <td>
                                <a href="{{ route('transaksi.createTransaksi', ['transaksi'=>$item->id]) }}">
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
