@extends('layouts/header_laboratorium')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Data Lab</h1>
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
            <div class="card-header">
                <span><strong>Diagnosa</strong>  : {{$rujukan->rekamedis->diagnosa}}</span> <br>
                <span><strong>Tindakan</strong> : {{$rujukan->rekamedis->tindakan}}</span> <br>
                <span><strong>Dokter</strong> : {{$rujukan->rekamedis->dokter->nama}}</span> <br>
                <span><strong>Pasien</strong> : {{$rujukan->rekamedis->pasien->nama}}</span> <br>

            </div>
            <div class="card-body">
                <form action="{{ route('lab.listrujukan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="rujukan_id" value="{{$rujukan->id}}">
                    <div class="form-group">
                        <label for="">Foto Lab</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Deskripsi</label>
                       <textarea name="deskripsi" class="form-control" id="" cols="30" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        <button type="clear" class="btn btn-default btn-sm">Clear</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
@endsection
