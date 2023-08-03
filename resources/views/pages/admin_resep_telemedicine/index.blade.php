@extends('layouts/header')
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
                            <th>Dokter</th>
                            <th>Biaya</th>                                                        
                            <th>Jenis Pengantaran</th>
                            <th>Alamat Pengantaran</th>  
                            <th>Penerimaan</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($telemedicine as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d F Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_akhir)->format('H:i')}}</td>
                            <td>{{$item->pasien->nama}}</td>  
                            <td>{{$item->dokter->nama}}</td>                                                        
                            <td>Rp.{{number_format($item->nominal,0,',','.') }}</td>                                
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
                                    <span class="badge badge-info">Sudah</span>
                                    
                                @else
                                    <span class="badge badge-warning">Belum</span>
                                @endif
                            </td>                                              
                            <td class="d-flex">       
                                @if ($item->resepobattelemedicine_id !== null)
                                <button class="btn btn-info btn-xs  mr-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-check"></i></button>                               
                                 <a href="{{ route('dokter.reseptelemedicine.print', ['id'=>$item->id]) }}" class="btn btn-success btn-xs" target="_blank"><i class="fas fa-download"></i> Resep</a>                           
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
                                    <form action="{{ route('admin.reseptelemedicine.penerimaan') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Status Penerimaan</label>
                                            <select name="status_pengambilan_resep" id="id_pengambilan" class="form-control" onchange="jenispengambilan()">
                                                   <option value="sudah">Sudah diterima</option>
                                                    <option value="belum">Belum Diterima</option>                                                    
                                            </select>                                      
                                        </div>

                                           <input type="hidden" name="id" value="{{$item->id}}">

                                            <div id="alamat_pengambilan" class="form-group">
                                                <label for="">Keterangan</label>
                                                <textarea  name="keterangan" class="form-control" id="" cols="5" rows="5"></textarea>
                                                <span>(*) Keterangan bisa di isi dengan dikirim melalui gosend atau keterangan lain</span>
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

    <!-- /.content-header -->
</div>



@endsection

@section('js')
    <script>



  
    </script>
@endsection
