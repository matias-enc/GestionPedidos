@extends('admin_panel.index')



@section('content')
@can('roles_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.roles.create") }}">
                Crear Rol
            </a>
        </div>
    </div>
@endcan

<div class="card ">

    <div class="card-body">
        <div class="table-responsive">
            <table id="roles" class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Slug</th>
                      <th>Descripcion</th>
                      <th>Permisos</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $rol)
                            <tr>
                                <td>{{$rol->name}}</td>
                                <td>{{$rol->slug}}</td>
                                <td>{{$rol->description}}</td>
                                <td>
                                    @foreach($rol->permissions as $permiso)
                                        <span class="badge badge-info">{{ $permiso->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('roles_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.roles.show', $rol->id) }}">
                                            Ver
                                        </a>
                                    @endcan

                                    @can('roles_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.roles.edit', $rol->id) }}">
                                            Editar
                                        </a>
                                    @endcan

                                    @can('roles_destroy')
                                        <form action="{{ route('admin.roles.destroy', $rol->id) }}" method="POST" onsubmit="return confirm('Esta seguro que desea borrar el rol {{$rol->name}}?');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="Borrar">
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
@push('scripts')
<script>
        $(function () {
          $('#roles').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "columns": [
    null,
    null,
    null,
    null,
    { "width": "15%" }
  ],

          });
        });
</script>
@endpush
