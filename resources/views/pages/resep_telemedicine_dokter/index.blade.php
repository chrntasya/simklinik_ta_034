@extends('layouts/header_dokter')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List Resep Telemedicine</h1>
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
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Pasien</th>                            
                            <th>Biaya</th>
                            <th>Status Resep</th>                                                        
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($history as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d F Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_akhir)->format('H:i')}}</td>
                            <td>{{$item->pasien->nama}}</td>                                                        
                            <td>Rp.{{number_format($item->nominal,0,',','.') }}</td>
                            <td>
                                @if ($item->resepobattelemedicine_id == null)
                                   <span class="badge badge-warning">Belum Ada Resep</span>
                                @else
                                <span class="badge badge-primary">Sudah Ada Resep</span> 
                                @endif
                            </td>                                                                
                            <td>       
                               
                                @if ($item->resepobattelemedicine_id !== null)
                                    <a href="{{ route('dokter.reseptelemedicine.create', ['id'=>$item->id]) }}" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i> Cek Resep</a>
                                     <a href="{{ route('dokter.reseptelemedicine.print', ['id'=>$item->id]) }}" class="btn btn-success btn-xs" target="_blank"><i class="fas fa-download"></i> Download Resep</a>
                                @else
                                <a href="{{ route('dokter.reseptelemedicine.create', ['id'=>$item->id]) }}" class="btn btn-primary btn-xs">Input Resep</a>                                                                                                                      
                                @endif
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

@section('js')
    <script>
    function hapusfoto(id) {
        console.log('tes');
        if (status == 'Telah Diperiksa') {   
            console.log('tes');
            swal("Terima Kasih!", "Pemeriksaan Telah Selesai!", "info");
        }else{
            swal({
                // title: "Apakah Anda Yakin Menghapus Pendaftaran Anda ?",
                text: "Apakah Anda Yakin Menghapus Foto Anda ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                            type: 'POST',
                            url: "{{ route('pasien.transactiontelemedicine.delete') }}",
                            dataType: 'html',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "id": id,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                swal("Good job!", "Data Berhasil ditambahkan!!", "success" , {
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

    function hapustransaksi(id) {
        console.log('tes');
        if (status == 'Telah Diperiksa') {   
            console.log('tes');
            swal("Terima Kasih!", "Pemeriksaan Telah Selesai!", "info");
        }else{
            swal({
                // title: "Apakah Anda Yakin Menghapus Pendaftaran Anda ?",
                text: "Apakah Anda Yakin Menghapus Foto Anda ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                            type: 'POST',
                            url: "{{ route('pasien.transactiontelemedicine.deletetransaksi') }}",
                            dataType: 'html',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "id": id,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                swal("Good job!", "Data Berhasil ditambahkan!!", "success" , {
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
