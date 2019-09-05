@extends('admin_panel.index')



@section('content')
@can('permisos_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.permisos.create") }}">
                Crear Permiso
            </a>
        </div>
    </div>
@endcan

<div class="card ">

    <div class="card-body">
        <div class="table-responsive">
            <table id="permisos" class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Slug</th>
                      <th>Descripcion</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($permisos as $permiso)
                            <tr>
                                <td>{{$permiso->name}}</td>
                                <td>{{$permiso->slug}}</td>
                                <td>{{$permiso->description}}</td>
                                <td>
                                    @can('permisos_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.permisos.show', $permiso->id) }}">
                                            Ver
                                        </a>
                                    @endcan

                                    @can('permisos_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.permisos.edit', $permiso->id) }}">
                                            Editar
                                        </a>
                                    @endcan

                                    @can('permisos_destroy')
                                        <form action="{{ route('admin.permisos.destroy', $permiso->id) }}" method="POST" onsubmit="return confirm('Esta seguro que desea borrar el rol {{$permiso->name}}?');" style="display: inline-block;">
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

