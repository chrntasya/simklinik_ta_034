@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Jadwal Telemedicine</h1>
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
                    <a href="{{route('dokter.jadwaltelemedicine.create')}}"><button type="button" id="buttonTambahUserDokter" class="btn btn-block btn-primary"><i class="fas fa-plus"></i> Jadwal
                        Telemedicine</button></a>
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
                                    <button class="btn btn-danger btn-sm" onclick="deleteTelemedicine({{$item->id}})"><i class="fas fa-trash"></i></button>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalSelasa as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTelemedicine({{$item->id}})"><i class="fas fa-trash"></i></button>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalRabu as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTelemedicine({{$item->id}})"><i class="fas fa-trash"></i></button>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalKamis as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTelemedicine({{$item->id}})"><i class="fas fa-trash"></i></button>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalJumat as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTelemedicine({{$item->id}})"><i class="fas fa-trash"></i></button>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalSabtu as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTelemedicine({{$item->id}})"><i class="fas fa-trash"></i></button>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($jadwalMinggu as $item)
                                    <span>
                                        {{$item->dokter->nama}} | {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                    </span>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTelemedicine({{$item->id}})"><i class="fas fa-trash"></i></button>
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

@section('js')
    <script>
        function deleteTelemedicine(id) {
    
        if (status == 'Telah Diperiksa') {   
            console.log('tes');
            swal("Terima Kasih!", "Pemeriksaan Telah Selesai!", "info");
        }else{
            swal({
                // title: "Apakah Anda Yakin Menghapus Pendaftaran Anda ?",
                text: "Apakah Anda Yakin Menghapus Pendaftaran Anda ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                            type: 'POST',
                            url: "{{ route('dokter.jadwaltelemedicine.delete') }}",
                            dataType: 'html',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "id": id,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                res = JSON.parse("[" + data + "]");
                                let status = res[0].status;
                                let message = res[0].message;

                                swal("Good job!", message, status , {
                                        timer: 3000,
                                    }); 
                                
                                
                                location.reload();
                            },
                            error: function(data) {
                                swal("Error!", data, "error");
                            }
                        });
                } else {
                    
                }
            });
        }
    }
    </script>
@endsection
