@extends('admin_panel.index')

@section('content')
<div class="d-flex justify-content-center">

    <div class="col-8">


        <div class="card shadow-sm card-primary card-outline">
            <div class="card-header">
                <h3><strong>Pedidos Activos</strong></h3>
            </div>
            <div class="card-body">

                <br>
                <div class="table">
                    <table id="pedidos" class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr class="text-center">
                                <th>Nr° Pedido</th>
                                <th>Usuario</th>
                                <th>Items</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                            <tr>
                                <td class="text-center">{{$pedido->id}}</td>
                                <td class="text-center">
                                    <span class="badge badge-warning">{{ $pedido->usuario->name }}</span>
                                </td>
                                <td >
                                    @foreach ($pedido->seguimientos as $seguimiento)
                                    <span class="badge badge-info">{{ $seguimiento->item->nombre }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    {{-- <a class="btn btn-xs btn-primary"
                                        href="{{route('pedidos.ver_solicitud', $pedido)}}">
                                        Ver
                                    </a> --}}
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
          });
        });
</script>
@endpush
