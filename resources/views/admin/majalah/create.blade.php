@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Majalah
    </div>

    <div class="card-body">
        <form action="{{ route("admin.majalah.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group {{ $errors->has('judul') ? 'has-error' : '' }}">
                <label for="judul">Judul</label>
                <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul', isset($majalah) ? $majalah->judul : '') }}">
                @if($errors->has('judul'))
                    <p class="help-block">
                        {{ $errors->first('judul') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.buku.fields.judul_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('penyusun') ? 'has-error' : '' }}">
                <label for="penyusun">Penyusun</label>
                <input type="text" id="penyusun" name="penyusun" class="form-control" value="{{ old('penyusun', isset($majalah) ? $majalah->penyusun : '') }}">
                @if($errors->has('penyusun'))
                @endif
                
            </div>
            <div class="form-group {{ $errors->has('kategori') ? 'has-error' : '' }}">
                <label for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" class="form-control" value="{{ old('kategori', isset($majalah) ? $majalah->kategori : '') }}">
                @if($errors->has('kategori'))
                @endif
            </div>
            
            
            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }} ">
             <label for="file">File</label>
               <input id="file" type="file" class="form-control" name="file" value="{{ old('file'), isset($majalah)?$majalah->file : '' }}">

                    @if ($errors->has('image'))
                         <p class="help-block">
                            {{ $errors->first('image') }}
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