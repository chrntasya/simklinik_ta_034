@extends('layouts/header_pasien')
@section('content')

    <!-- Content Header (Page header) -->
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
        
    <div class="col-12">
        <div class="card">
            <div class="card-header">
               <div class="row">
                <div class="col-md-2"><strong>Spesialis</strong> </div>
                <div class="col-md-2">: {{ucfirst($doktertelemedicine->spesialis->nama)}}</div>
               </div>

               <div class="row">
                <div class="col-md-2"><strong>Tanggal</strong> </div>
                <div class="col-md-2">: {{\Carbon\Carbon::parse($data['tanggal'])->format('d F Y')}}</div>
               </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 pl-4">
                                        @if ($doktertelemedicine->dokter->jenis_kelamin=="P")
                                            <img src="{{ asset('/icon/dokterwanita.png') }}" width="100px" height="100px">
                                        @else
                                            <img src="{{ asset('/icon/doktercowo.png') }}" width="100px" height="100px">
                                        @endif
                                    </div>
                                    <div class="col-md-6" >
                                         <h4 style="font-size:98%"><i>{{$doktertelemedicine->spesialis->nama}}</i></h4>
                                         <h3 class="text-blue"><strong>{{ucfirst($doktertelemedicine->dokter->nama)}}</strong></h3>
                                         <h4 style="font-size:98%"><i>{{$doktertelemedicine->spesialis->nama}}</i></h4>
                                    </div>
                                </div>
                                 
                                <div class="row">
                                    <div class="col-md-12">
                                       <hr style="color:rgb(28, 5, 5)">
                                    </div>  
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <h5>{{$doktertelemedicine->waktu_mulai}} -  {{$doktertelemedicine->waktu_selesai}}</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <p> | </p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>{{$doktertelemedicine->stok==0 ? '<i>Tidak Ada Batasan Kuota</i>' : 'Kuota : ' . ($doktertelemedicine->stok - ($doktertelemedicine->nomor_antrian ? $data['nomor_antrian'] : 0))}}</h5>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-8">
                                        <h5>Biaya Perjam : Rp.{{number_format($doktertelemedicine->nominal,0,',','.') }}</h5>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>Jumlah Pasien Saat Ini : {{$data['nomor_antrian'] ? $data['nomor_antrian'] : 0}}</h5>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                       <hr style="color:rgb(28, 5, 5)">
                                    </div>  
                                </div>                                                                                                                                                                       
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ route('pasien.telemedicine.transaksi')}}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header">Transaksi Telemedicine <br>
                                <span>(*)Jangan masukan jam sebelum dan sesudah jam aktif pelayanan dokter</span></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Jam Mulai</label>
                                        <input type="time" name="jam_mulai" class="form-control" placeholder="Jam Mulai">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jam Selesai</label>
                                        <input type="time" name="jam_selesai" class="form-control" placeholder="Jam Mulai">
                                    </div>

                                
                                    <input type="hidden" name="nomor_antrian" value="{{$data['nomor_antrian']}}">
                                    <input type="hidden" name="hari" value="{{$data['hari']}}">
                                    <input type="hidden" name="dokter_id" value="{{$data['dokter_id']}}">
                                    <input type="hidden" name="spesialis_id" value="{{$data['spesialis_id']}}">
                                    <input type="hidden" name="tanggal" value="{{$data['tanggal']}}">
                                    <input type="hidden" name="jadwal_id" value="{{$data['jadwal_id']}}">

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                   
                  </div>
            </div>
        </div>
    </div>
    
    
@endsection

@section('js')
    <script>
        function hideModal(id) {
            console.log('tes');
            $('#noantrian' + id).modal('hide');
        }
    </script>
@endsection
