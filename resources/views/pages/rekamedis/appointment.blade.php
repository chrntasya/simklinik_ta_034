@extends('layouts/header_dokter')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Antrian Pasien</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="container-fluid">
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>{{ $message['status'] }}</strong> {{ $message['content'] }}
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <strong>{{ $message['status'] }}</strong> {{ $message['content'] }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pasien Dalam Antrian</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Antrian</th>
                                <th>Pasien</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($appointments as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nomor_antrian }}</td>
                                    <td>{{ $item->users->nama }}</td>
                                    <td>
                                        {{-- TODO: Iterasi menggunakan kolom pasien_id --}}
                                        <a href="{{ route('rekamedis.create', ['id' => $item->users->id]) }}">
                                            <button type="submit" class="btn btn-sm btn-success">Pilih Pasien
                                            </button>
                                        </a>
                                        <div class="d-inline-block">
                                            <form action="{{ route('pasien.batal', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Batalkan Antrian</button>
                                            </form>
                                        </div>
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
