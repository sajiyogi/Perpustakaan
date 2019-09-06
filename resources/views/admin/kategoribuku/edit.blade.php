@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">Edit Kategori
    </div>

    <div class="card-body">
        <form action="{{ route('admin.kategoribuku.update', $data['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id">Id Kategori</label>
                <div class="col-md-6">
                    <input id="id" type="text" name="id" value="{{$data['id']}}" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" value="{{ old('id') }}" required autofocus>

                    @if ($errors->has('id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('id') }}</strong>
                        </span>
                    @endif
                </div>
                
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <div class="col-md-6">
                    <input id="nama" type="text" name="nama" value="{{$data['nama']}}" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" value="{{ old('nama') }}" required autofocus>

                    @if ($errors->has('nama'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
                </div>
                
            </div>
            <div>
                <input class="btn btn-danger" name="edit" type="submit" value="edit">

                <a href="{{route('admin.kategoribuku.index') }}" class="btn btn-info">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
