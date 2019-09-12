@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Kategori Buku
    </div>

    <div class="card-body">
        <form method="POST" action="{{route('admin.kategoribuku.store')}}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="id">Id Kategori</label>
                <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id" value="{{ old('id') }}" required autofocus>

                @if ($errors->has('id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('id') }}</strong>
                    </span>
                @endif
                
            </div>


            <div class="form-group">
                <label for="nama">Nama</label>
                <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required>

                @if ($errors->has('nama'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                @endif
                
            </div>

            
            <div class="form-group row mb-0">
                <div class="col-md-6  text-left">
                    <button type="submit" class="btn btn-primary">{{ __('add') }}
                    </button>
                                
                        <a href="{{ route('admin.kategoribuku.index') }}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection