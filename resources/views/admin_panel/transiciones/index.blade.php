@extends('admin_panel.index')



@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("workflow.transiciones.create") }}">
            Crear Transicion
        </a>
    </div>
</div>

<div class="card ">

    <div class="card-body">
        <div class="table-responsive">
            <table id="roles" class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                      <th>Flujo de Trabajo</th>
                      <th>Nombre de Transicion</th>
                      <th>Estado Inicial</th>
                      <th>Estado Final</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($transiciones as $tr)
                            <tr>
                                <td>{{$tr->flujoTrabajo->nombre}}</td>

                                <td>{{$tr->nombre}}</td>

                                <td>{{$tr->estadoInicial->nombre}}</td>

                                <td>{{$tr->estadoFinal->nombre}}</td>
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
