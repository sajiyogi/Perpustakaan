@extends('layouts.admin')
@section('content')
<script src="{{asset ('js/jquery.js') }}"></script>
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.buku.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.buku.update',[$buku->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('judul') ? 'has-error' : '' }}">
                <label for="judul">{{ trans('global.buku.fields.judul') }}*</label>
                <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul', isset($buku) ? $buku->judul : '') }}">
                @if($errors->has('judul'))
                    <p class="help-block">
                        {{ $errors->first('judul') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.buku.fields.judul_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('penerbit') ? 'has-error' : '' }}">
                <label for="penerbit">{{ trans('global.buku.fields.penerbit') }}*</label>
                <input type="text" id="penerbit" name="penerbit" class="form-control" value="{{ old('penerbit', isset($buku) ? $buku->penerbit : '') }}">
                @if($errors->has('penerbit'))
                    <p class="help-block">
                        {{ $errors->first('penerbit') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.buku.fields.penerbit_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('pengarang') ? 'has-error' : '' }}">
                <label for="pengarang">{{ trans('global.buku.fields.pengarang') }}*</label>
                <input type="text" id="pengarang" name="pengarang" class="form-control" value="{{ old('pengarang', isset($buku) ? $buku->pengarang : '') }}">
                @if($errors->has('pengarang'))
                    <p class="help-block">
                        {{ $errors->first('pengarang') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.buku.fields.pengarang_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('jumlah') ? 'has-error' : '' }}">
                <label for="jumlah">{{ trans('global.buku.fields.jumlah') }}*</label>
                <input type="number" id="jumlah" name="jumlah" class="form-control" value="{{ old('jumlah', isset($buku) ? $buku->jumlah : '') }}">
                @if($errors->has('jumlah'))
                    <p class="help-block">
                        {{ $errors->first('jumlah') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.buku.fields.jumlah_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }} ">
             <label for="image">{{ trans('global.buku.fields.image') }}*</label>
               <input id="image" type="file" class="form-control" name="image" value="{{ old('image'), isset($buku) ? $buku->image : '' }}">
               <br>
                <img src="{{asset('asset/uploadcover/'.$buku->image)}}" id="profile-img" width="200px" />

                    @if ($errors->has('image'))
                         <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                        <p class="helper-block">
                            {{ trans('global.buku.fields.image_helper')}}
                        </p>
                        <script type="text/javascript">
                        $(document).ready(function(){
                            $("#image").click(function(){
                                $('#profile-img').attr('src',"");

                                });
                                });
                         function readURL(input) {
                     if (input.files && input.files[0]) {
                         var reader = new FileReader();
            
                     reader.onload = function (e) {
                        $('#profile-img').attr('src', e.target.result);
                             }
                        reader.readAsDataURL(input.files[0]);
                            }
                        }
                         $("#image").change(function(){
                        readURL(this);
                         });
                    </script>
                
             </div>

            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection