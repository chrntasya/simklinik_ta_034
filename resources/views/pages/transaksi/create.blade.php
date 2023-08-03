@extends('layouts/header_apoteker')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Transaksi</h1>
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
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>List Resep Obat : </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Satuan</th>
                                    <th>Kategori Obat</th>
                                    <th>Jumlah Obat</th>
                                    <th>Keterangan Obat</th>                            
                                    <th>Harga Obat (Rp.)</th>
                                    <th>Subtotal (Rp.)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($resepObat as $item)
                                
                                
                                <tr>
                                    <td>{{$item->obat->nama}}</td>
                                    <td class="flex">{{$item->obat->satuan}}</td>
                                    <td>{{$item->obat->kategori_obat->nama}}</td>
                                    <td>{{$item->jumlah_obat}}
                                         <a href="#"><span class="badge badge-success" data-toggle="modal" data-target="#jumlahobat{{$item->id}}">Edit</span></a>    
                                    </td>
                                    <td>{{$item->obat->keterangan}}</td>                                  
                                    <td> {{ number_format($item->obat->harga, 0, ',', '.') }}</td>
                                    <td>{{ number_format((int)$item->obat->harga * (int)$item->jumlah_obat, 0, ',', '.') }} </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="deleteObat({{$item->id}})"><i class="fas fa-trash"></i></button>
                                    </td>

                                </tr>

                                {{-- modal edit jumlah obat --}}                                
                                <div class="modal fade" id="jumlahobat{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Stok</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('resep_obat_detail.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="">Obat</label>
                                                    <select name="obat_id" id="" class="form-control">
                                                        @foreach ($obat as $value)                                                           
                                                            @if ($value->id == $item->id_obat)
                                                               <option value="{{$value->id}}" selected>{{$value->nama}}</option>
                                                            @else
                                                               <option value="{{$value->id}}">{{$value->nama}}</option>                                                              
                                                            @endif                                                                                                                     
                                                        @endforeach
                                                    </select>
                                                </div>   
                                                <div class="form-group">
                                                    <label for="Judul Berita">Keterangan</label>
                                                    <input name="keterangan_obat" type="text"
                                                        class="form-control" id="resepObat"
                                                        placeholder="Masukkan Keterangan Obat"
                                                        value="{{ $item->keterangan_obat }}">
                                                </div>                                     
                                                <div class="form-group">
                                                    <label for="">Stok</label>
                                                    <input type="number" class="form-control" value="{{$item->obat->stok}}" readonly>                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Jumlah</label>
                                                    <input type="number" name="jumlah_obat" class="form-control">
                                                    <span class="text-danger">(*) Obat tidak boleh melebihi stok</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                           </form>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                {{-- end of edit --}}
                                @endforeach
                                <tr>
                                    <th colspan="6" class="text-right">Total (Rp.)</th>
                                    <td colspan="1">{{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                             
                               <h5>Resep Baru</h5>   
                                @if (!$rekammedis->resep_obat_baru_id)
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#resepbaru"><i class="fas fa-plus"></i> Tambah Resep</button>                                                     
                                @else
                                    <a href="{{ route('resepbaru.download', ['rekammedis'=>$rekammedis->id]) }}" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Download PDF</a>
                                @endif                                                                                                
                        </div>                        
                    </div>
                    <div class="card-body">
                        @if ($rekammedis->resep_obat_baru_id)
                            <span>Kode Resep Obat :  {{$rekammedis->resepobatbaru->kode}}</span> <br>
                            <span>Tanggal :  {{\Carbon\Carbon::parse($rekammedis->resepobatbaru->tanggal)->format('d-m-Y')}}</span>                          
                            <hr>
                        @endif 
                        <div class="d-flex justify-content-between">                            
                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#modal-default"><i class="fas fa-plus"></i>Tambah Obat</button>

                        </div>
                        <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Obat</th>
                                    <th>Keterangan Obat</th>
                                    <th>Jumlah Obat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = 1;
                                @endphp
                                @if ($rekammedis->resepobatbaru != null && !$rekammedis->resepobatbaru->resepobatdetails->isEmpty())
                                    @foreach ($rekammedis->resepobatbaru->resepobatdetails as $item)
                                        <tr>
                                            <td>{{ $n++ }}</td>
                                            <td>{{ $item->obat->nama }}</td>
                                            <td>{{ $item->obat->keterangan }}</td>
                                            <td>{{ $item->jumlah_obat }}</td>
                                            <td>
                                                <button type="button" id="buttonTambahresepObat"
                                                    class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#modal-edit-{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                                <form style="margin-top: 5px;display:inline-block;"
                                                    action="{{ route('resep_obat_detail.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-edit-{{ $item->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Obat</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form role="form"
                                                        action="{{ route('resep_obat_detail.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf @method('PUT')
                                                        <div class="modal-body">
                                                            <input type="hidden" id="id" name="id"
                                                                value="{{ $item->id_resep_obat }}">
                                                            <div class="form-group">
                                                                <input type="hidden" name="obat_id"
                                                                    value="{{ $item->id_obat }}">
                                                                <label for="Judul Berita">Pilih Obat</label>
                                                                {{-- <input class="form-control" type="text" name="obat_id"
                                                                        value="{{ $item->id_obat }}" disabled> --}}
                                                                <select name="obat_id" id="obat_id"
                                                                    class="form-control">
                                                                    @foreach ($obat as $items)
                                                                        @if ($items->id === $item->id_obat)
                                                                            <option value="{{ $items->id }}"
                                                                                selected disabled>
                                                                                {{ $items->nama }}</option>
                                                                            
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <small class="text-warning"><i
                                                                        class="fa fa-info-circle"></i>
                                                                    Obat tidak bisa di ganti, silahkan hapus data ini
                                                                    dan tambahkan
                                                                    data yang baru jika ingin mengganti obat</small>
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <label for="Judul Berita">Keterangan</label>
                                                                <input name="keterangan_obat" type="text"
                                                                    class="form-control" id="resepObat"
                                                                    placeholder="Masukkan Keterangan Obat"
                                                                    value="{{ $item->keterangan_obat }}">
                                                            </div> --}}
                                                            <div class="form-group">
                                                                <label for="Judul Berita">Jumlah Obat</label>
                                                                <input name="jumlah_obat" type="number"
                                                                    class="form-control" id="resepObat"
                                                                    placeholder="Masukkan Jumlah Obat"
                                                                    value="{{ $item->jumlah_obat }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Ubah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- obat baru --}}
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Obat</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="form"
                                action="{{ route('resep_obat_detail.store', $rekammedis->resep_obat_baru_id) }}"
                                method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" id="resep_obat_id" name="id"
                                        value="{{ $rekammedis->resep_obat_baru_id }}">
                                    <div class="form-group">
                                        <label for="id_obat">Pilih Obat</label>
                                        <select name="obat_id" id="id_obat" class="form-control" onchange="stokobat()">
                                            @foreach ($obat as $obat)
                                                <option value="{{ $obat->id }}">{{ $obat->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                  
                                    <div class="form-group" id="stok_obat">
                                      
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_obat">Jumlah Obat</label>
                                        <input name="jumlah_obat" type="number" class="form-control"
                                            id="resepObat" placeholder="Masukkan Jumlah Obat">
                                        <i>* Jumlah tidak boleh melebihi Stok</i>
                                    </div>

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- end of obat baru --}}

                {{-- modal resep baru --}}                
                <div class="modal fade" id="resepbaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Resep Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('resepobat.storebaru') }}" method="POST">  
                                @csrf
                                <input type="hidden" name="rekam_medis_id" value="{{ $rekammedis->id }}">                                                                
                                <div class="form-group">
                                    <label for="Judul Berita">Kode Resep Obat</label>
                                    <input name="kode" type="text" class="form-control" id="KoderesepObat"
                                        placeholder="Kode Akan Terbuat Otomatis" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Judul Berita">Tanggal Resep Obat</label>
                                    <input name="tanggal_resep" type="date" class="form-control" id="resepObat"
                                        placeholder="Nama resep"
                                        value="{{ date('Y-m-d') }}" readonly>
                                </div>                                                               
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>                       
                    </div>
                    </div>
                </div>
                {{-- end of modal resep baru --}}
                
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Transaksi : </h4>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{route('transaksi.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="rekammedis_id" value="{{$rekammedis->id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Kode">No Registrasi</label>
                                    <input name="no_regis" type="text" class="form-control" id="kode"
                                        placeholder="No Registrasi akan terbuat otomatis" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Periksa</label>
                                    <input name="tanggal_periksa" type="date" class="form-control" id="nama"  value="<?php echo date("Y-m-d"); ?>"
                                         readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Bayar</label>
                                    <input name="tanggal_bayar" type="date" class="form-control" id="nama"  value="<?php echo date("Y-m-d"); ?>"
                                         readonly >
                                </div>
                                <div class="form-group">
                                    <label for="nama">Total</label>
                                    <input name="total" type="text" class="form-control" id="total"
                                        value="{{number_format($total, 0, ',', '.')}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Jasa Dokter</label>
                                    <input name="jasa_dokter" type="number" class="form-control" id="jasadokter"
                                        placeholder="Jasa Dokter" value="{{$rekammedis->dokter->nominal}}" readonly >
                                </div>

                                <div class="form-group">
                                    <label for="nama">Grand Total</label>
                                    <input name="grandtotal" type="text" class="form-control" id="grandtotal"
                                        placeholder="Grand Total" value="{{$total + $rekammedis->dokter->nominal}}"  readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Jumlah Bayar</label>
                                    <input name="jumlah_bayar" type="number" class="form-control" id="jumlahbayar"
                                        placeholder="Jumlah Bayar" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Kembalian</label>
                                    <input name="kembalian" type="text" class="form-control" id="kembalian"
                                        placeholder="Kembalian" readonly>
                                </div>                             
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-rounded">Konfirmasi Pembayaran</button>
                                <a href="{{ route('transaksi.index') }}"><button id="buttonCancel" type="button"
                                    class="btn btn-default">Cancel</button></a>
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
     let total = {{$total}} + {{$rekammedis->dokter->nominal}}; 
     let kembalian = 0
     let i = 0;
     $(document).ready(function() {

        $("#jasadokter").change(function(params){

             jasadokter = $('#jasadokter').val();
             console.log(jasadokter);
             total = {{$total}} + parseInt(jasadokter);
             $('#grandtotal').val(total);

             jumlahbayar = $('#jumlahbayar').val();
             kembalian = parseInt(jumlahbayar) - total;
             $('#kembalian').val(kembalian);
        });

        $("#jumlahbayar").change(function(params){
             jumlahbayar = $('#jumlahbayar').val();
             if (jumlahbayar < total) {
                alert('Pembayaran kurang dari total pembayaran')
             }

             kembalian = parseInt(jumlahbayar) - total;
             $('#kembalian').val(kembalian);

             jasadokter = $('#jasadokter').val();
             total = {{$total}} + parseInt(jasadokter);
             $('#grandtotal').val(total);
        });    
     });


        function deleteObat(id) {
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
                        url: "{{ route('resepobat.deleteobat') }}",
                        dataType: 'html',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            "resep_id": id,
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

        const datastok = document.getElementById('stok_obat');
        let obat = '';

        function stokobat() {
            let e = document.getElementById("id_obat");
            obat = e.options[e.selectedIndex].value; 
            console.log(obat);
            datastok.innerHTML = "";

            $.ajax({
                type: 'POST',
                url: '{{ route('obat.cekobat') }}',
                dataType: 'html',
                headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
                data: {                       
                    "_token": "{{ csrf_token() }}",
                    'id_obat' : obat
                },                    
                success: function (data){

                    res = JSON.parse("[" + data + "]");
                    let stok_obat  = res[0].stok_obat;
                    datastok.innerHTML = `
                            <label for="">Stok Obat</label>
                            <input type="text" class="form-control" readonly value="${stok_obat}">
                    `;
                },
                error: function(data){
                    console.log(data);
                }
            });	
            
            
        }
</script>
@endsection
