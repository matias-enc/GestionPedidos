@extends('admin_panel.index')



@section('content')

    <br>
<div class="row justify-content-center">


<div class="card card-outline card-primary col-8 animated fadeIn shadow-sm">
<div class="card-header">
    <div class="row justify-content-between">
        <h3 class="my-auto"><strong>Listado de Inmuebles</strong></h3>
        <div style="margin-bottom: 10px;" class="row offset-1">
                <div class="col-lg-12">
                    <a class="btn btn-primary btn-pill btn-lg" href="{{ route("item.create") }}">
                        Crear Item
                        <i class="fal fa-plus"></i>
                    </a>
                </div>
            </div>
    </div>
</div>
    <div class="card-body">

        <div class="table-responsive">
            <table id="items" class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Capacidad</th>
                      <th >Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($inmuebles as $inmueble)
                            <tr>
                                <td>{{$inmueble->nombre}}</td>
                                <td>{{$inmueble->descripcion}}</td>
                                <td>{{$inmueble->capacidad}}</td>
                                <td width="21%">
                                        <a class="btn btn-xs btn-primary" href="{{ route('item.show', $inmueble->id) }}">
                                            Ver
                                        </a>
                                        <a class="btn btn-xs btn-info" href="{{ route('item.edit', $inmueble->id) }}">
                                            Editar
                                        </a>
                                        <form action="{{ route('item.destroy', $inmueble->id) }}" method="POST" onsubmit="return confirm('Esta seguro que desea borrar el inmueble {{$inmueble->nombre}}?');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="Borrar">
                                        </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
    </div>
</div>

<div class="card card-outline card-primary col-8 animated fadeIn shadow-sm">
        <div class="card-header">
                <h3><strong>Listado de Muebles</strong></h3>
        </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="muebles" class="table table-bordered table-striped table-hover datatable">
                            <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>Descripcion</th>
                              <th>Cantidad</th>
                              <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($muebles as $mueble)
                                    <tr>
                                        <td>{{$mueble->nombre}}</td>
                                        <td>{{$mueble->descripcion}}</td>
                                        <td>{{$mueble->cantidad}}</td>
                                        <td width="21%">
                                                <a class="btn btn-xs btn-primary" href="{{ route('item.show', $mueble->id) }}">
                                                    Ver
                                                </a>
                                                <a class="btn btn-xs btn-info" href="{{ route('item.edit', $mueble->id) }}">
                                                    Editar
                                                </a>
                                                <form action="{{ route('item.destroy', $mueble->id) }}" method="POST" onsubmit="return confirm('Esta seguro que desea borrar el item {{$mueble->nombre}}?');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="Borrar">
                                                </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
            </div>
        </div>

</div>
@endsection

@push('scripts')
<script>
        $(function () {
          $('#items').DataTable({
            "paging": true,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "searching": true,
            "ordering": true,
            "info": false,
          });
        });
</script>
<script>
        $(function () {
          $('#muebles').DataTable({
            "paging": true,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "searching": true,
            "ordering": true,
            "info": false,
          });
        });
</script>

@endpush
