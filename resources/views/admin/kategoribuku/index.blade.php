@extends('layouts.admin')

@section('content')


    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kategoribuku.create') }}"> Tambah Kategori Buku
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">Data Kategori Buku</div>

    <!-- session pesan -->

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>Id Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                        <tr data-entry-id="{{ $row->id }}">
                            <td>

                            </td>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>
                                <div class="btn-group">
                                <a class="btn btn-warning" href="{{route('admin.kategoribuku.edit', $row->id)}}">Ubah</a>
                                <form method="POST" action="{{route('admin.kategoribuku.destroy', $row->id) }}"  onclick="return confirm('Are You Sure ? ')">
                                 @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
