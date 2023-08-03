@extends('layouts/header')
@section('content')
{{-- <div class="content-wrapper">
    <!-- Content Header (Page header) --> --}}
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List Transaction</h1>
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
                            <th>Dokter</th>
                            <th>Spesialis</th>
                            <th>Biaya</th>
                            <th>Bukti Pembayaran</th>
                            <th>Status</th>
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
                            <td>{{$item->dokter->nama}}</td>
                            <td>{{$item->spesialis->nama}}</td>
                            <td>Rp.{{number_format($item->nominal,0,',','.') }}</td>
                            <td>
                                @if ($item->bukti_pembayaran == null)
                                    <a href="#" data-toggle="modal" data-target="#upload{{$item->id}}">
                                        <span class="badge badge-info"><i class="fas fa-upload"></i> Upload Bukti Pembayaran</span>
                                    </a>
                                @else
                                    <a href="#">
                                        <img src="{{ asset('storage/bukti_pembayaran/' . $item->bukti_pembayaran) }}" width="55" height="55" data-toggle="modal" data-target="#bukti{{$item->id}}" >
                                    </a>
                                    
                                    @if ($item->status == 'Telah Dibayar')
                                       <button class="ml-2 btn btn-outline-danger btn-sm" onclick="hapusfoto({{$item->id}})"><i class="fas fa-trash"></i></button>    
                                    @endif
                                    
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 'Belum Terbayar')
                                    <span class="badge badge-warning">Belum Terbayar</span>
                                @elseif($item->status == 'Telah Dibayar')
                                    <span class="badge badge-info">Menunggu Diverifikasi</span>
                                @elseif($item->status == 'Terverifikasi')
                                    <span class="badge badge-primary">Terverifikasi</span>
                                @elseif($item->status == 'Telah Selesai')
                                    <span class="badge badge-success">Telah Selesai</span>
                                @else
                                    <span class="badge badge-danger">Batal</span>
                                @endif    
                            </td>                        
                            <td>
                                                            
                                <a href="#"" data-toggle="modal" data-target="#status{{$item->id}}">
                                    <button type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-user-edit"></i> </button>
                                </a>

                                @if ($item->status == 'Belum Dibayar')
                                    <a href="#"" class="btn btn-outline-danger btn-sm" onclick="hapustransaksi({{$item->id}})">
                                        <i class="fas fa-trash"></i> 
                                    </a>    
                                @endif
                                        
                                                      
                            </td>
                        </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="upload{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('pasien.transactiontelemedicine.upload') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="bg-info py-4 pl-2 pr-2">
                                                    <p>Silahkan melakukan pembayaran dengan transfer ke alamat rekening berikut : </p><br>
                                                    <p>BCA : 0231234454545 (A.n) Tasya Kamila</p>
                                                    <p>Dengan nominal : <b>Rp.{{number_format($item->nominal,0,',','.') }}</b></p>
                                                    <p>Setelah melakukan pembayaran silahkan upload bukti pembayaran untuk diverifikasi oleh admin</p>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="">Bukti Pembayaran</label>
                                                    <input type="file" name="bukti_pembayaran" class="form-control">
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                   </form>
                                </div>
                            </div>
                            {{-- end of modal --}}


                            {{-- modal gambar --}}
                            <div class="modal fade" id="bukti{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                               
                                               <img src="{{ asset('storage/bukti_pembayaran/' . $item->bukti_pembayaran) }}" alt="" width="460" height="460">
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                                
                                            </div>
                                        </div>
                                   
                                </div>
                            </div>
                            {{-- end of modal gambar --}}


                            
                            {{-- MODAL STATUS --}}

                            {{-- modal gambar --}}
                            <div class="modal fade" id="status{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('admin.admintransaksitelemedicine.update') }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">                                               
                                                <div class="form-group">
                                                    <label for="">Status Pendaftaran</label>
                                                    <select name="status" class="form-control" id="">
                                                        <option value="Telah Dibayar">Telah Dibayar</option>
                                                        <option value="Belum Dibayar">Belum Dibayar</option>
                                                        <option value="Terverifikasi">Terverifikasi</option>
                                                        <option value="Telah Selesai">Telah Selesai</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="id" value="{{$item->id}}">                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>       
                                                <button type="submit" class="btn btn-primary">Save changes</button>                                         
                                            </div>
                                        </div>
                                    </form>
                                   
                                </div>
                            </div>
                            {{-- end of modal gambar --}}

                        @endforeach
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <!-- /.content-header -->
</div> --}}



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
