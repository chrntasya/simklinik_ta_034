@extends('layouts/header_dokter')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Rekam Medis</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-12 mb-3">
                    <a href="{{ route('pasien.index') }}">
                        <button type="button" id="buttonTambahKategoriObat" class="btn btn-block btn-primary">
                            <i class="fas fa-user-friends"></i>
                            Lihat Antrian Pasien
                        </button>
                    </a>
                </div>
            </div>
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
                <div class="card-header">
                    <h3 class="card-title">Pasien Selesai Diperiksa</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>Diagnosa</th>
                                <th>Tindakan</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($rekamedis as $item)
                                @if (is_null($item->resepobat))
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ date('d F Y', strtotime($item->tanggal_pendaftaran)) }}</td>
                                        <td>{{ $item->diagnosa }}</td>
                                        <td>{{ $item->tindakan }}</td>
                                        <td>{{ $item->pasien->nama }}</td>
                                        <td>{{ $item->dokter->nama }}</td>
                                        <td>
                                            <a href="{{ route('rekamedis.edit', $item->id) }}">
                                                <button type="button" class="btn btn-sm btn-success">Beri Resep
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pasien Mendapat Resep Obat</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>Diagnosa</th>
                                <th>Tindakan</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($rekamedis as $item)
                                @if (!is_null($item->resepobat))
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ date('d F Y', strtotime($item->tanggal_pendaftaran)) }}</td>
                                        <td>{{ $item->diagnosa }}</td>
                                        <td>{{ $item->tindakan }}</td>
                                        <td>{{ $item->pasien->nama }}</td>
                                        <td>{{ $item->dokter->nama }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                                data-target="#detail{{ $item->id }}">Detail</button>
                                            <a href="{{ route('rekamedis.edit', $item->id) }}">
                                                <button type="button" class="btn btn-sm btn-warning">Edit</button>
                                            </a>
                                            <form style="margin-top: 5px;display:inline-block;"
                                                action="{{ route('rekamedis.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- /.content-header -->
    </div>
    @foreach ($rekamedis as $data)
        @if (!is_null($data->resepobat))
            <div class="modal fade" id="detail{{ $data->id }}">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail Rekam Medis</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-2">Tanggal Periksa</div>
                                <div class="mr-2">:</div>
                                <div class="">{{ date('d F Y', strtotime($data->tanggal_pendaftaran)) }}</div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Pasien</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 row">
                                            <div class="col-4">Nama Pasien</div>
                                            <div class="mr-2">:</div>
                                            <div class="">{{ $data->pasien->nama }}</div>
                                        </div>
                                        <div class="col-6 row">
                                            <div class="col-4">Tgl. Lahir</div>
                                            <div class="mr-2">:</div>
                                            <div class="">
                                                {{ $data->pasien->tanggal_lahir ? date('d F Y', strtotime($data->pasien->tanggal_lahir)) : '-' }}
                                            </div>
                                        </div>
                                        <div class="col-6 row">
                                            <div class="col-4">No. RM</div>
                                            <div class="mr-2">:</div>
                                            <div class="">{{ $data->pasien->no_rm ?: '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Hasil Pemeriksaan</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 row">
                                            <div class="col-4">Diagnosa</div>
                                            <div class="mr-2">:</div>
                                            <div class="">{{ $data->diagnosa }}</div>
                                        </div>
                                        <div class="col-6 row">
                                            <div class="col-4">Surat Keterangan</div>
                                            <div class="mr-2">:</div>
                                            <div class="">{{ $data->suratketerangan }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Rujukan</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if (!$data->rujukans->isEmpty())
                                        <div class="row">
                                            <div class="col-6 row">
                                                <div class="col-4">Kode Rujukan</div>
                                                <div class="mr-2">:</div>
                                                <div class="">{{ $data->rujukans->last()->kode }}</div>
                                            </div>
                                            <div class="col-6 row">
                                                <div class="col-4">Jenis Pemeriksaan</div>
                                                <div class="mr-2">:</div>
                                                <div class="">{{ $data->rujukans->last()->jenis_pemeriksaan }}</div>
                                            </div>
                                            <div class="col-6 row">
                                                <div class="col-4">Tempat Rujukan</div>
                                                <div class="mr-2">:</div>
                                                <div class="">{{ $data->rujukans->last()->tempatrujukan->nama }}
                                                </div>
                                            </div>
                                            <div class="col-6 row">
                                                <div class="col-4">Tgl. Berkunjung</div>
                                                <div class="mr-2">:</div>
                                                <div class="">
                                                    {{ date('d F Y', strtotime($data->rujukans->last()->tglberkunjung)) }}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="btn btn-primary" data-toggle="modal"
                                            data-target="#rujuk{{ $data->id }}">Tambahkan Rujukan</div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="rujuk{{ $data->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Tambahkan Rujukan</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form role="form" action="{{ route('dokterrujukan.store') }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('post')
                                                        <div class="modal-body">
                                                            {{-- <div class="card-body"> --}}
                                                            {{ Form::hidden('rekamedis', $data->id) }}
                                                            <div class="form-group">
                                                                <label for="kode">Kode</label>
                                                                <input name="kode" type="text" class="form-control"
                                                                    id="kode" placeholder="Masukkan kode pasien"
                                                                    required value="{{ old('kode') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jenis_pemeriksaan">Jenis Pemeriksaan</label>
                                                                <input name="jenis_pemeriksaan" type="text"
                                                                    class="form-control" id="jenis_pemeriksaan"
                                                                    placeholder="Masukkan jenis pemeriksaan" required
                                                                    value="{{ old('jenis_pemeriksaan') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tgl_berkunjung">Tanggal Berkunjung</label>
                                                                <input name="tgl_berkunjung" type="date"
                                                                    class="form-control" id="tgl_berkunjung"
                                                                    placeholder="Masukkan jenis pemeriksaan" required
                                                                    value="{{ old('tgl_berkunjung') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tempat_rujukan_id">Tempat Rujukan</label>
                                                                <select name="tempat_rujukan_id" class="form-control">
                                                                    <option value="-" selected disabled>Pilih tempat
                                                                        rujukan</option>
                                                                    @foreach ($tempat as $tempat_rujukan)
                                                                        <option value="{{ $tempat_rujukan->id }}">
                                                                            {{ $tempat_rujukan->nama }}</option>
                                                                    @endforeach
                                                                    {{-- <option value="L">Laki-laki</option> --}}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Resep Obat</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                @php
                                    $no_resep = 1;
                                @endphp
                                @if (!$data->resepobat->resepobatdetails->isEmpty())
                                    <div class="card-body">
                                        @foreach ($data->resepobat->resepobatdetails as $resep)
                                            <div class="row">
                                                <div class="col-12 row">
                                                    <div class="col-2">{{ $no_resep . '. Obat' . $no_resep }}</div>
                                                    <div class="mr-2">:</div>
                                                    <div class="">
                                                        {{ $resep->obat->nama }} ({{ $resep->jumlah_obat }})
                                                        {{ $resep->obat->dosis }} - {{ $resep->keterangan_obat }}
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $no_resep++;
                                            @endphp
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endif
    @endforeach
@endsection
