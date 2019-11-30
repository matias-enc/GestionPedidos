@extends('admin_panel.index')

@section('content')

<div class="row justify-content-center">
    <div class="col-10">


        <div class="card card-outline card-primary card-small">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="my-auto"><strong>Listado de Flujos de Trabajo</strong></h3>
                    <div>
                        <div class="">
                            <a class="btn btn-primary btn-pill btn-lg" href="{{ route("workflow.flujos.create") }}">
                                Crear Flujo
                                <i class="fal fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <div class="table">
                    <table id="flujos" class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Transiciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($flujos as $flujo)
                            <tr>
                                <td>{{$flujo[0]->nombre}}</td>
                                <td>
                                    @foreach($flujo[0]->transiciones as $tr)
                                    <span class="badge badge-pill badge-info">{{ $tr->nombre }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary" href="{{route('workflow.flujos.show', $flujo[0])}}">
                                        Ver
                                    </a>
                                    @if ($flujo[1])

                                    @else
                                    <form action="{{ route('workflow.flujos.destroy', $flujo[0]) }}" method="POST" onsubmit="return confirm('Esta seguro que desea borrar el flujo {{$flujo[0]->nombre}}?');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="Borrar">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function () {
          $('#flujos').DataTable({
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
            "columns": [
    { "width": "25%" },
    null,
    { "width": "15%" }
  ],
          });
        });
</script>
@endpush
