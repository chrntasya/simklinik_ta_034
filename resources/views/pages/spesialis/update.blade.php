@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update Spesialis</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
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
                <form role="form" action="{{route('spesialis.update', $spesialis->id)}}" method="POST">
                    @csrf @method("PUT")
                    <div class="card-body">
                        <div class="form-group">
                            <label for="KodeSpesialis">Kode Spesialis</label>
                            <input name="kode" type="text" class="form-control" id="KodKodeSpesialiseObat"
                                placeholder="Kode Spesialis" value="{{$spesialis->kode}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="NamaSpesialis">Nama Spesialis</label>
                            <input name="nama" type="text" class="form-control" id="NamaSpesialis"
                                placeholder="Nama Spesialis" value="{{$spesialis->nama}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('spesialis.index')}}"></a><button id="buttonCancel" type="button"
                            class="btn btn-default">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.content-header -->
</div>
@endsection
