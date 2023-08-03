@extends('layouts/header_apoteker')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List Transaksi</h1>
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
            <div class="row card-header">
                <div class="col-sm-2 col-12">
                    <a href="{{route('transaksi.listrekammedis')}}"><button type="button" id="buttonTambahKategoriObat" class="btn btn-block btn-primary">Tambah
                        Transaksi</button></a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Registrasi</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Periksa</th>
                            <th>Tanggal Bayar</th>
                            <th>Grand Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($transaksi as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->kode}}</td>
                            <td>{{$item->pasien->nama}}</td>
                            <td>{{\Carbon\Carbon::parse($item->tanggal_periksa)->format('d F Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($item->tanggal_bayar)->format('d F Y')}}</td>
                            <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('transaksi.invoice', ['transaksi'=>$item->id]) }}">
                                    <button type="button" class="btn btn-info btn-sm">Invoice</button>
                                </a>
                                <a href="{{ route('transaksi.edit', ['transaksi'=>$item->id]) }}">
                                    <button type="button" class="btn btn-success btn-sm">Edit</button>
                                </a>
                                <form style="margin-top: 5px;display:inline-block;" action="{{ route('transaksi.destroy', ['transaksi'=>$item->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
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
