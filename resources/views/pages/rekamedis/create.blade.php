@extends('layouts/header_dokter')
@section('content')
<div class="content-wrapper">
    <form role="form" action="{{route('rekamedis.store')}}" method="POST" id="formRekamMedis">
        @csrf
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-12 d-inline-flex justify-content-between">
                <h1 class="m-0">Rekam Medis</h1>
                <button type="button" onclick="toggleResepObat()" id="btnTambahResep" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-square" id="iconTambahResepObat"></i>
                    Tambah Resep Obat
                </button>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>

        <div class="container-fluid">
            <div class="card">
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
                @if(session('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <strong>Opps!</strong> {{ session('error_message') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <div class="card-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Judul Berita">Tanggal Pendaftaran</label>
                            <input name="tanggal_pendaftaran" type="date" class="form-control" id="tanggal_pendaftaran"
                                placeholder="Tanggal Pendaftaran" value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Diagnosa</label>
                            <input name="diagnosa" type="text" class="form-control" id="diagnosa"
                                placeholder="Diagnosa" value="{{ @old('diagnosa') ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="tindakan">Tindakan</label>
                            <textarea name="tindakan" type="text" rows="2" class="form-control" id="tindakan"
                                placeholder="Tindakan">{{ @old('tindakan') ?? '' }}</textarea>
                        </div>
                        <input type="hidden" name="pasien_id" value="{{ $pasien->user_id }}">
                        <input type="hidden" name="appointment_id" value="{{ $antrian->id }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="resepObatForm" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Resep Obat</h3>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Judul Berita">Kode Resep Obat</label>
                            <input name="kode" type="text" class="form-control" id="KoderesepObat" placeholder="Kode resep Obat akan terisi otomatis" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Tanggal Resep Obat</label>
                            <input name="tanggal_resep" type="date" class="form-control" id="resepObat" placeholder="Nama resep">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid pb-5 pl-4">
            <a href="{{ route('rekamedis.index') }}"><button id="buttonCancel" type="button" class="btn btn-default">Cancel</button></a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function toggleResepObat() {
            if (document.getElementById('resepObatForm').style.display === 'none') {
                document.getElementById('btnTambahResep').classList.remove("btn-primary");
                document.getElementById('btnTambahResep').classList.add("btn-secondary");
                document.getElementById('iconTambahResepObat').classList.remove("fa-plus-square");
                document.getElementById('iconTambahResepObat').classList.add("fa-minus-square");
                document.getElementById('resepObatForm').style.display = 'block';
            } else {
                document.getElementById('btnTambahResep').classList.remove("btn-secondary");
                document.getElementById('btnTambahResep').classList.add("btn-primary");
                document.getElementById('iconTambahResepObat').classList.remove("fa-minus-square");
                document.getElementById('iconTambahResepObat').classList.add("fa-plus-square");
                document.getElementById('resepObatForm').style.display = 'none';
            }
        }
    </script>
@endsection
