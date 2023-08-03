@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Reschedule Pasien</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="{{ route('reschedule.update',$data->id) }}" method="post">
                        @csrf
                        @method('PUT')
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

                        @if ($message = Session::get('informasi'))
                        <div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>Mohon Maaf !</strong> {{ $message }}
                        </div>
                        @endif
                        <div class="card-header  bg-primary">
                            <span>
                                <h4>Reschedule Pasien</h4>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Spesialis</label>
                                <select name="spesialis_id" class="form-control" id="" required>
                                    {{-- <option value="" selected disabled>-- Pilih Spesialis --</option>\ --}}
                                    @foreach ($spesialis as $item)
                                    @if($item->id==$data->spesialis_id)
                                        <option value="{{$item->id}}"selected="selected">{{$item->nama}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" value="{{$data->tanggal}}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ">Simpan</button>
                                <button type="reset" class="btn btn-default ">Reset</button>
                            </div>
                        </div>

                   </form>
                </div>
            </div>
            <div class="col-md-6">
              
                <div class="card">
                    <div class="card-header bg-info">
                        <span>
                            <h4>Informasi</h4>
                        </span>                        
                    </div>
                    <div class="card-body">
                        {{-- <div class="media">
                            <span>( * )</span>
                            <div class="media-body">
                              <p>Pendaftaran dibuka mulai H-1 sampai satu jam sebelum prakter dimulai. <br>                                 
                            </p>
                            </div>
                        </div> --}}

                        <div class="media">
                            <span>( * )</span>
                            <div class="media-body">
                              <p>
                                NB : Mohon untuk selalu melakukan pengecekan nomor antrian pada halaman sebelum berangkat ke tempat pemeriksaan.
                                dengan cara menuju ke halaman dashboard pasien karena akan ada informasi disana.
                            </p>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <span>
                            <h4>Jadwal Dokter</h4>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dokter</th>
                                        <th>Spesialis</th>
                                        <th>Hari</th>
                                        <th>Sesi</th>
                                        <th>Ruang</th>
                                        <th>Kuota</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                    @endphp
                                <tbody>
                                    @foreach ($jadwaldokter as $item)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$item->nama_dokter}}</td>
                                        <td>{{$item->nama_spesialis}}</td>
                                        <td>{{$item->hari}}</td>
                                        <td>{{$item->waktu_mulai}} - {{$item->waktu_selesai}}</td>
                                        <td>{{$item->ruangan}}</td>
                                        <td>{{$item->stok}}</td>
                                    </tr>
                                    @php $no++ @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- 
    + modal
    + fild dokter
    + tampilkan jadwal dokter
    -- mail
    + berikut untuk perubahan jadwal pemeriksaan +
    + nama dokter
    + no antrian
    
    --}}