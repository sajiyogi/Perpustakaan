@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.ebook.create") }}"> Add
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        Ebook
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                         <th>
                            File
                        </th>
                        <th>
                            Judul
                        </th>
                         <th>
                            Pengarang
                        </th>
                         <th>
                            Penerbit
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ebook as $key => $e)
                        <tr data-entry-id="{{ $e->id }}">
                            <td>

                            </td>
                            <td>
                              {{ $e->file  ?? '' }}
                               <!-- <img src="{{asset ('asset/uploadcover/'.$e->file ) }} " alt="" style="width: 200px; height: 200px;" /> -->
                            </td>
                        
                            <td>
                                {{ $e->judul  ?? '' }}
                            </td>
                            <td>
                                {{$e->pengarang ?? '' }}
                            </td>
                            <td>
                                {{$e->penerbit ?? '' }}
                            </td>
                            

                            <td>
                             
                                    <a class="btn btn-xs btn-primary" href="/ebook/{{$e->file}}" download="{{ $e->file }}">download
                                    </a>
                      
                             
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ebook.edit', $e->id) }}">
                                        Edit
                                    </a>
                          
                                    <form action="{{ route('admin.ebook.destroy', $e->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                        
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
    url: "{{ route('admin.ebook.massDestroy') }}",
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