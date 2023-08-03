@extends('layouts/header')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Resep Obat</h1>
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
                    <form role="form" action="{{ route('resep_obat.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Judul Berita">Kode Resep Obat</label>
                                <input name="kode" type="text" class="form-control" id="KoderesepObat"
                                    placeholder="Kode resep Obat akan terisi otomatis" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Judul Berita">Tanggal Resep Obat</label>
                                <input name="tanggal_resep" type="date" class="form-control" id="resepObat"
                                    placeholder="Nama resep">
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('resep_obat.index') }}"><button id="buttonCancel" type="button"
                                    class="btn btn-default">Batal</button></a>
                        </div>
                    </form>
                    <div class="row card-header">
                        <div class="col-sm-2">
                            <button type="button" id="buttonTambahresepObat" class="btn btn-block btn-primary"
                                data-toggle="modal" data-target="#modal-default" style="float:right" disabled>Tambah
                                Obat</button>
                        </div>
                        <div class="col-md-12"> <small class="text-warning"><i class="fa fa-info-circle"></i>Silahkan
                                masukkan data di atas
                                sebelum menambahkan
                                obat</small>
                        </div>
                    </div>

                    <div class="card-body">
                        <table  class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Obat</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Judul Berita">Kode Resep Obat</label>
                                        <select name="obat_id" id="" class="form-control">
                                            @foreach ($obat as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Judul Berita">Keterangan</label>
                                        <input name="keterangan_obat" type="text" class="form-control" id="resepObat"
                                            placeholder="Masukkan Keterangan Obat">
                                    </div>
                                    <div class="form-group">
                                        <label for="Judul Berita">Jumlah Obat</label>
                                        <input name="jumlah_obat" type="text" class="form-control" id="resepObat"
                                            placeholder="Masukkan Jumlah Obat">
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>

        <!-- /.content-header -->
    </div>
@endsection
