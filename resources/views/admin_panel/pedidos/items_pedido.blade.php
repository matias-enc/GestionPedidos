@extends('admin_panel.index')
@section('content')
<div class="card col-10 offset-1">

        <div class="card-body">
            <div class="d-flex justify-content-between">
                    <h3><strong>Items dentro del Pedido</strong></h3>
                    <button class="btn btn-success btn-pill" onclick="location.href = '{{ route('pedidos.nuevo_pedido') }}'">
                        <i class="fal fa-plus"></i>
                        Agregar Item
                    </button>

            </div>
            <br>
            <div class="table">
                <table id="carrito" class="table table-bordered table-striped table-hover datatable">
                        <thead>
                        <tr>
                          <th>Items</th>
                          <th>Items Adicionales</th>
                          <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->seguimientos as $seguimiento)
                                <tr>
                                    <td>
                                        <span class="badge badge-warning">{{ $seguimiento->item->nombre }}</span>
                                    </td>
                                    <td>
                                        {{-- @foreach ($pedido->seguimientos as $seguimiento) --}}
                                            <span class="badge badge-info">N/A</span>
                                        {{-- @endforeach --}}
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{route('pedidos.show', $pedido)}}">
                                            Eliminar
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
          $('#carrito').DataTable({
            "paging": false,
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
            "searching": false,
            "ordering": true,
            "info": false,
            "columns": [
    null,
    null,
    { "width": "15%" }
  ],
          });
        });
</script>
@endpush
