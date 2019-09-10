@extends('layouts.admin')
@section('content')
@can('buku_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.buku.create") }}"> {{ trans('global.add') }} {{ trans('global.buku.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.buku.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                         <th>
                            {{ trans('global.buku.fields.image') }}
                        </th>
                        <th>
                            {{ trans('global.buku.fields.judul') }}
                        </th>
                         <th>
                            {{ trans('global.buku.fields.penerbit') }}
                        </th>
                        <th>
                            {{ trans('global.buku.fields.pengarang') }}
                        </th>
                         <th>
                            {{ trans('global.buku.fields.jumlah') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bukus as $key => $buku)
                        <tr data-entry-id="{{ $buku->id }}">
                            <td>

                            </td>
                            <td>
                               <img src="{{asset ('asset/uploadcover/'.$buku->image ) }} " alt="" style="width: 200px; height: 200px;" />
                            </td>
                        
                            <td>
                                {{ $buku->judul  ?? '' }}
                            </td>
                            <td>
                                {{$buku->penerbit ?? '' }}
                            </td>
                            <td>
                                {{$buku->pengarang ?? '' }}
                            </td>
                            <td>
                                {{$buku->jumlah ?? '' }}
                            </td>
                            

                            <td>
                                @can('buku_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.buku.show', $buku->id) }}">{{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('buku_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.buku.edit', $buku->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('buku_delete')
                                    <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.buku.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('buku_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection