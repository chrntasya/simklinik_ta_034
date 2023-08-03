@extends('layouts/header_pasien')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pendaftaran Telemedicine</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="{{ route('pasien.telemedicine.listdokter') }}" method="POST">
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
                              <p>
                                Mohon untuk selalu melakukan pengecekan jam selesai konsultasi pada halaman pendaftaran.                                
                            </p>
                            </div>
                          </div>
                          <div class="media">
                            <span>( * )</span>
                            <div class="media-body">
                              <p>
                                Mohon untuk melakukan pembayaran sebelum masa konsultasi selesai.                                
                            </p>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>

    <!-- /.content-header -->

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

</script>
@endsection