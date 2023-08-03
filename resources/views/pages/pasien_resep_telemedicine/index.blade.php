@extends('layouts/header_pasien')
@section('content')

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
        {{-- <div class="row"> --}}
            <div class="card">
                <div class="card-body">
                    <span>(*) Jika dokter sudah memasukan resep untuk anda , silahkan menginput jenis pengambilan resep agar resep segera diproses oleh admin.</span>
                </div>
            </div>
        {{-- </div> --}}
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
                            <th>Jenis Pengantaran</th>
                            <th>Alamat Pengantaran</th>   
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($transaksi as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d F Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_akhir)->format('H:i')}}</td>
                            <td>{{$item->dokter->nama}}</td>                                                        
                            <td>Rp.{{number_format($item->nominal,0,',','.') }}</td>
                            <td>
                                @if ($item->resepobattelemedicine_id == null)
                                   <span class="badge badge-warning">Belum Ada Resep</span>
                                @else
                                <span class="badge badge-info">Sudah Ada Resep</span> 
                                @endif
                            </td>      
                            <td>
                                @if ($item->jenis_pengambilan == 'rumah')
                                    <span> Antar Ke Rumah</span>
                                @elseif ($item->jenis_pengambilan == 'klinik')
                                    <span>Ambil di Klinik</span>
                                @endif
                            </td> 
                            <td>
                                @if ($item->alamat_pengambilan)
                                    {{$item->alamat_pengambilan}}
                                @else
                                    -
                                @endif
                            </td>                                                
                            <td>       
                                @if ($item->status_pengambilan_resep == 'sudah')
                                    <span class="badge badge-success ">Resep Sudah Diterima</span>
                                @else
                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i> Input Pengambilan</button>    
                                @endif
                                
                                
                            </td>
                        </tr>        
                        
                        {{-- modal pengambilan --}}                        
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pengambilan Resep</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('pasien.reseptelemedicine.pengantaran') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Jenis Pengambilan</label>
                                            <select name="jenis_pengambilan" id="id_pengambilan" class="form-control" onchange="jenispengambilan()">
                                                   <option value="rumah">Antar Kerumah</option>
                                                    <option value="klinik">Diambil di Klinik</option>                                                    
                                            </select>                                      
                                        </div>

                                           <input type="hidden" name="id" value="{{$item->id}}">

                                            <div id="alamat_pengambilan" class="form-group">
                                                <label for="">Alamat Pengantaran</label>
                                                <textarea  name="alamat_pengambilan" class="form-control" id="" cols="5" rows="10"></textarea>
                                                <span>(*) Jika jenis pengambilan pilih ambil di klinik tidak perlu mengisi alamat</span>
                                            </div>

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                     </form>
                                </div>
                              
                            </div>
                            </div>
                        </div>
                        {{-- end of modal pengambilan --}}
                        @endforeach
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection

@section('js')
    <script>
    //      const alamat = document.getElementById('alamat_pengambilan');
    // function jenispengambilan() {
    //         let e = document.getElementById("id_pengambilan");
    //         pengambilan = e.options[e.selectedIndex].value; 

    //         if (pengambilan == 'rumah') {
    //             alamat.innerHTML = `
    //                                            <label for="">Alamat Pengantaran</label>
    //                                             <textarea  name="alamat_pengambilan" class="form-control" id="" cols="5" rows="10"></textarea>
    //                 `;
    //         }else{
    //             alamat.innerHTML ="";
    //         }


    // }


  
    </script>
@endsection
