@extends('layouts/header_laboratorium')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List Lab</h1>
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
                    <a href="{{route('lab.listrujukan')}}"><button type="button" id="buttonTambahKategoriObat" class="btn btn-block btn-primary">Tambah
                        Lab</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Pemeriksaan</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($lab as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->rujukan->jenis_pemeriksaan}}</td>                            
                            <td>
                                <img src="{{ asset('storage/file_lab/' . $item->file) }}" width="100px" height="100px" alt="">
                            </td>
                            <td>{{$item->deskripsi}}</td>                           
                            <td>                               
                                <a href="{{ route('lab.edit', ['id'=>$item->id]) }}">
                                    <button type="button" class="btn btn-success btn-sm">Edit</button>
                                </a>
                                <form style="margin-top: 5px;display:inline-block;" action="{{ route('lab.destroy', ['id'=>$item->id]) }}"
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
