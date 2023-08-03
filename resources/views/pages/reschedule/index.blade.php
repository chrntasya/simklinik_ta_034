@extends('layouts/header')
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
            <div class="card-header">
                <h3 class="card-title">Pasien Dalam Antrian</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Antrian</th>
                            <th>Pasien</th>
                            <th>No.Antrian</th>
                            <th>Dokter</th>
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
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->users->nama }}</td>
                                <td>{{ $item->nomor_antrian }}</td>
                                <td>{{ $item->dokter->nama }}</td>
                                <td>
                                    {{-- TODO: Iterasi menggunakan kolom pasien_id --}}
                                    {{-- <a href="{{ route('rekamedis.create', ['id' => $item->users->id]) }}">
                                        <button type="submit" class="btn btn-sm btn-success">Pilih Pasien
                                        </button>
                                    </a> --}}
                                    @if($item->users->nomor_telepon)
                                    <a href="https://wa.me/{{ $item->users->nomor_telepon }}" class="btn btn-sm btn-success">Chat WhatsApp</a>
                                    @else
                                        <button type="button" disabled class="btn btn-sm btn-secondary">Chat WhatsApp</button>
                                    @endif
                                    <div class="d-inline-block">
                                        <form action="{{ route('pasien.batal', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Batalkan Antrian</button>
                                        </form>
                                    </div>
                                    <button type="button" data-toggle="modal" data-target="#reschedule{{$item->id}}" class="btn btn-sm btn-warning">Reschedule</button>
                                    
                                    {{-- modal alert --}}
                                    <div class="modal fade" id="reschedule{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Reschedule Antrian Pasien</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">                                                                                                            
                                                    <p>Apakah Anda Yakin Reschedule Pasien Tersebut ?  
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Batal</button>
                                                    <a href="{{ route('reschedule.edit', $item->id) }}" class="btn btn-primary">Reschedule</a>
                                                </div>
                                            </div>
                                        </div>
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