@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Detail Berita
    </div>

    <div class="card-body">
        <div class="col-md-12 text-right">
            <a href="{{route('admin.berita.index') }}" class="btn btn-danger"> Back </a>
        </div>
        <img src="{{ URL::to('/') }}/uploadberita/{{ $data->image }} ">
        <br><br>
        <h3 class="text-justify">{{strip_tags ($data->artikel)}}</h3>
    </div>
</div> 
@endsection