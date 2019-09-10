@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Berita
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.berita.update' , $data['id']) }}"  enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul">Judul Berita</label>
                <div class="col-md-6">
                    <input id="judul" type="text" name="judul" value="{{$data['judul']}}" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}"  value="{{ old('judul') }}" required autofocus>

                    @if ($errors->has('judul'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('judul') }}</strong>
                    </span>
                    @endif
                </div>
             </div>
             <div class="form-group">
                <label for="image">Foto</label>
                <div class="col-md-6">
                    <input type="file" name="image" />
                    <img src="{{ URL::to('/') }}/uploadberita/{{ $data->image }}" class="img-thumbnail" width="100" />
                    <input type="hidden" name="hidden_image" value="{{ $data->image }}" />
                    @if ($errors->has('image'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="artikel">Artikel</label>
                <textarea id="konten" name="artikel" value="{{$data['artikel']}}" class="form-control{{ $errors->has('artikel') ? ' is-invalid' : '' }}"   value="{{ old('artikel') }}" required>{{ $data->artikel }} </textarea>
                @if($errors->has('artikel'))
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('artikel') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">{{ __('edit') }}
                    </button>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
  var konten = document.getElementById("konten");
    CKEDITOR.replace(konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;
</script>