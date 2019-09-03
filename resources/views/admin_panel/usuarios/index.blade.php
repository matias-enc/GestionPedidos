@extends('admin_panel.index')

@section('content')
<div class="card col 6">

    <div class="card-body">
        <div class="table-responsive">
            <table id="usuarios" class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                      <th>Usuario</th>
                      <th>Email</th>
                      <th>Rol</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->roles as $rol)
                                        <span class="badge badge-info">{{ $rol->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('usuarios_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                            Ver
                                        </a>
                                    @endcan

                                    @can('usuarios_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                            Editar
                                        </a>
                                    @endcan

                                    {{-- @can('user_delete')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
        $(function () {
          $('#usuarios').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
          });
        });
</script>
@endpush
