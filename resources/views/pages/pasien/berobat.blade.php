@extends('layouts/header_pasien')
@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pendaftaran Pasien</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="{{ route('pasien.pilihdokter') }}" method="POST">
                        @csrf
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
                                <h4>Pendaftaran Pasien</h4>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Spesialis</label>
                                <select name="spesialis_id" class="form-control" id="" required>
                                    <option value="" selected disabled>-- Pilih Spesialis --</option>\
                                    @foreach ($spesialis as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" required>
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
                        <div class="media">
                            <span>( * )</span>
                            <div class="media-body">
                              <p>Pendaftaran dibuka mulai H-1 sampai satu jam sebelum prakter dimulai. <br>                                 
                            </p>
                            </div>
                        </div>

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
                    <div class="card-header">
                        <h4>History Pendaftaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        @if (count($daftarUser) > 0)
                        @foreach ($daftarUser as $item)
                           
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">                                            
                                                    <div class="text-center">
                                                        <h4><i>Nomor Antrian</i></h4>
                                                        <h1>{{$item->nomor_antrian}}</h1>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" >
                                                    <h4 style="font-size:98%"><i><i class="fas fa-bookmark text-blue"></i> {{$item->spesialis->nama}}</i></h4>
                                                    <h4 style="font-size:98%"><i class="fas fa-clock text-blue"></i> {{\Carbon\Carbon::parse($item->tanggal)->format('l , d F Y')}}</h4>                                                     
                                                    <h4 style="font-size:98%"><i>{{$item->jadwal->waktu_mulai}} - {{$item->jadwal->waktu_selesai}}</i></h4>

                                                    <h4 style="font-size:100%" class="badge badge-primary badge-lg">{{$item->status}}</h4>

                                                </div>
                                            </div>                                         
                                            <div class="row">
                                                <div class="col-md-12">
                                                <hr style="color:rgb(28, 5, 5)">
                                                </div>  
                                            </div> 

                                            <div class="row align-items-center">                     
                                                @if ($item->status_mulai == 'Belum')
                                                    <div class="col-md-6">         
                                                        <h5  class="text-center"><i>Antrian Belum Dimulai</i></h5>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-rounded btn-info btn-lg" >0</button>
                                                    </div>
                                                @else
                                                    <div class="col-md-6">         
                                                        <h5  class="text-center"><i>No Antrian Sekarang</i></h5>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-rounded btn-info btn-lg" >{{$item->nomor_antrian_sekarang ? $item->nomor_antrian_sekarang : 'Selesai' }}</button>
                                                    </div>
                                                @endif             

                                                {{-- <div class="col-md-6">         
                                                    <h5  class="text-center"><i>No Antrian Sekarang</i></h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-rounded btn-info btn-lg" >{{$item->nomor_antrian_sekarang ? $item->nomor_antrian_sekarang : 'Selesai' }}</button>
                                                </div> --}}

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                <hr style="color:rgb(28, 5, 5)">
                                                </div>  
                                            </div> 

                                            <div class="row" style="display: flex;z-index:auto;">                                               
                                                <div class="col-md-4 pl-4">
                                                    @if ($item->dokter->jenis_kelamin=="P")
                                                        <img src="{{ asset('/icon/dokterwanita.png') }}" class="img-fluid" width="50px" height="50px">
                                                    @else
                                                        <img src="{{ asset('/icon/doktercowo.png') }}" class="img-fluid" width="50px" height="50px">
                                                    @endif
                                                </div>
                                                <div class="col-md-8">
                                                    <h4 class="text-blue"> {{ucfirst($item->dokter->nama)}}</h4>
                                                    <h4 style="font-size:98%"><i>{{$item->jadwal->waktu_mulai}} - {{$item->jadwal->waktu_selesai}}</i></h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                <hr style="color:rgb(28, 5, 5)">
                                                </div>  
                                            </div> 

                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <h4 style="font-size:98%">Jenis Pembayaran</h4> 
                                                <h4 class="text-blue"><u>{{ucfirst($item->tipe_pembayaran)}}</u></h4>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <a href="{{ route('berobat.print', ['id'=>$item->id]) }}" class="btn btn-block  btn-warning "><i class="fas fa-file-pdf"></i> Download PDF</a>
                                                </div>                                                
                                            </div>
                                        
                                        </div>
                                        @if ($item->status == 'Antri')
                                            <div class="card-footer">
                                                <button class="btn  btn-outline-danger btn-block" onclick="deleteDaftar('{{$item->status}}',{{$item->id}})"><i class="fas fa-times-circle" ></i> Batalkan Pendaftaran</button>
                                            </div>
                                        @else
                                            <div class="card-footer">
                                                <button class="btn  btn-info btn-block"><i class="fas fa-check-circle"></i> Pemeriksaan Telah Selesai</button>
                                            
                                            </div>
                                        @endif
                                    
                                    </div>
                                </div>
                            
                             @endforeach
                        @else
                            <div class="col-12">
                                <div class="bg-grey text-center">
                                    <h6><i>Belum Ada Pendaftaran</i></h6>
                                </div>
                            </div>    
                        @endif
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

@endsection

@section('js')
<script>
function deleteDaftar(status,id) {
    console.log('tes');
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
                        url: "{{ route('pasien.cancel') }}",
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