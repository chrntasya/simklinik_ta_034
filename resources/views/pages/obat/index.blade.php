@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Obat</h1>
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
                    <a href="{{route('obat.create')}}"><button type="button" id="buttonTambahKategoriObat" class="btn btn-block btn-primary">Tambah
                        Obat</button></a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kategori Obat</th>
                            <th>Nama</th>
                            <th>Satuan</th>
                            <th>Dosis</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obat as $item)
                        <tr>
                            <td>{{$item->kode}}</td>
                            <td>{{$item->kategori_obat->nama}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->satuan}}</td>
                            <td>{{$item->dosis}}</td>
                            <td>{{$item->harga}}</td>
                            <td>{{$item->stok}}</td>
                            <td>{{$item->lokasi}}</td>
                            <td>{{$item->keterangan}}</td>
                            <td>
                                <a href="{{route('obat.edit', $item->id)}}">
                                    <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                                <form style="margin-top: 5px;display:inline-block;" action="{{route('obat.destroy', $item->id)}}"
                                    method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                     <!-- Modal Delete -->
                                    <div class="modal fade" id="delete_modal">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            Yakin akan dihapus ?
                                            <form method="post" id="delete_form" />
                                            <input type="hidden" name="delete_id" id="delete_id_p" />
                                            
                                            </div>
                                            <div class="modal-footer">
                                            <input type="submit" name="delete" id="delete" value="Delete" class="btn btn-success" /> 
                                            </form>  
                                            <button type="button" data-dismiss="modal" class="btn">Cancel</button>          
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- Modal Delete Sukses -->
                                    <div class="modal fade" id="sukses_hapus">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            Data telah dihapus       
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn">Tutup</button>           
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
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
