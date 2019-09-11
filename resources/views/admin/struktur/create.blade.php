@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Struktur Organisasi
    </div>

    <div class="card-body">
        <form action="{{ route("admin.struktur.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', isset($struktur) ? $strukturs->nama : '') }}">
                @if($errors->has('nama'))
                    <p class="help-block">
                        {{ $errors->first('nama') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.buku.fields.judul_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('jabatan') ? 'has-error' : '' }}">
                <label for="penerbit">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="form-control" value="{{ old('jabatan', isset($struktur) ? $strukturs->jabatan : '') }}">
                @if($errors->has('jabatan'))
                    <p class="help-block">
                        {{ $errors->first('jabatan') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.buku.fields.penerbit_helper') }}
                </p>
            </div>
            
            
            <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }} ">
             <label for="file">Gambar</label>
               <input id="file" type="file" class="form-control" name="file" value="{{ old('file'), isset($struktur) ? $strukturs->file : '' }}">

                    @if ($errors->has('file'))
                         <p class="help-block">
                            {{ $errors->first('file') }}
                        </p>
                    @endif
                        <p class="helper-block">
                            {{ trans('global.buku.fields.image_helper')}}
                        </p>
                
             </div>

            <div>
                <input class="btn btn-danger" type="submit" value="{{ __('add') }}">
            </div>
        </form>
    </div>
</div>

@endsection