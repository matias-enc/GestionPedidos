@extends('admin_panel.index')

@section('content')
<div class="card col-10 offset-1">

    <div class="card-body">
            <h3><strong>Nuevas Solicitudes de Pedidos</strong></h3>
            <br>
        <div class="table">
            <table id="pedidos" class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                      <th>Nr°</th>
                      <th>Usuario</th>
                      <th>Items</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->id}}</td>
                                <td>
                                        <span class="badge badge-warning">{{ $pedido->usuario->name }}</span>
                                </td>
                                <td>
                                    @foreach ($pedido->seguimientos as $seguimiento)
                                        <span class="badge badge-info">{{ $seguimiento->item->nombre }}</span>
                                    @endforeach
                                </td>
                                <td>
                                        <span class="badge badge-pill badge-success">{{ $pedido->estado->nombre }}</span>
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{route('pedidos.ver_solicitud', $pedido)}}">
                                        Ver
                                    </a>
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
          $('#pedidos').DataTable({
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
