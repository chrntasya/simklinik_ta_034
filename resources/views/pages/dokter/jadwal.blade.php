@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dokter</h1>
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
                    <a href="{{route('form_jadwal_dokter')}}"><button type="button" id="buttonTambahUserDokter" class="btn btn-block btn-primary">Atur Jadwal
                        Dokter</button></a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Senin</th>
                            <th>Selasa</th>
                            <th>Rabu</th>
                            <th>Kamis</th>
                            <th>Jum'at</th>
                            <th>Sabtu</th>
                            <th>Minggu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @foreach ($jadwalSenin as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <form style="margin-top: 5px;display:inline-block;" action="{{route('delete_jadwal_dokter', $item->id)}}"
                                        method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button style="height: 25px;padding: 0px 11px;font-size: 15px;" type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalSelasa as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <form style="margin-top: 5px;display:inline-block;" action="{{route('delete_jadwal_dokter', $item->id)}}"
                                        method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button style="height: 25px;padding: 0px 11px;font-size: 15px;" type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalRabu as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <form style="margin-top: 5px;display:inline-block;" action="{{route('delete_jadwal_dokter', $item->id)}}"
                                        method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button style="height: 25px;padding: 0px 11px;font-size: 15px;" type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalKamis as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <form style="margin-top: 5px;display:inline-block;" action="{{route('delete_jadwal_dokter', $item->id)}}"
                                        method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button style="height: 25px;padding: 0px 11px;font-size: 15px;" type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalJumat as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <form style="margin-top: 5px;display:inline-block;" action="{{route('delete_jadwal_dokter', $item->id)}}"
                                        method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button style="height: 25px;padding: 0px 11px;font-size: 15px;" type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalSabtu as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <form style="margin-top: 5px;display:inline-block;" action="{{route('delete_jadwal_dokter', $item->id)}}"
                                        method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button style="height: 25px;padding: 0px 11px;font-size: 15px;" type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalMinggu as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <form style="margin-top: 5px;display:inline-block;" action="{{route('delete_jadwal_dokter', $item->id)}}"
                                        method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button style="height: 25px;padding: 0px 11px;font-size: 15px;" type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <br>
                                @endforeach
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- /.content-header -->
</div>
@endsection
