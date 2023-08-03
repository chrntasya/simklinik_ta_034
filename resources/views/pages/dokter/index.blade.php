@extends('layouts/header')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Dokter</h1>
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
                        <a href="{{ route('user_dokter.create') }}"><button type="button" id="buttonTambahUserDokter"
                                class="btn btn-block btn-primary">Tambah
                                Dokter</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat Rumah</th>
                                <th>Nomor Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokterSpesialis as $item)
                                <tr>
                                    <td>{{ $item->users->username }}</td>
                                    <td>{{ $item->users->nama }}</td>
                                    <td>{{ $item->users->tempat_lahir }}</td>
                                    <td>{{ $item->users->tanggal_lahir }}</td>
                                    <td>{{ $item->users->jenis_kelamin }}</td>
                                    <td>{{ $item->users->alamat_rumah }}</td>
                                    <td>{{ $item->users->nomor_telepon }}</td>
                                    <td>
                                        <a href="{{ route('user_dokter.edit', $item->id) }}">
                                            <button type="button" class="btn btn-warning">Edit</button>
                                        </a>
                                        <form style="margin-top: 5px;display:inline-block;"
                                            action="{{ route('user_dokter.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
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
