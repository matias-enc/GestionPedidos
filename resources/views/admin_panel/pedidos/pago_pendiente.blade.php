@extends('admin_panel.index')

@section('content')
<div class="d-flex justify-content-center animated fadeIn">

    <div class="col-8">


        <div class="card shadow-sm card-primary card-outline card-small">
            <div class="card-header pb-1">
                <h3><strong>Pagos Pendientes</strong></h3>

            </div>
            <div class="card-body">
                @if (sizeof($pedidos)>0)
                <div class="d-flex pl-2 pr-2 justify-content-center pt-1 pb-2">
                    <h5><label>En esta seccion se encuentran todos sus pedidos en <strong>espera de
                                pago</strong>.</label></h5>
                </div>
                    <div class="card card-body card-small p-0  shadow-none ">
                        <table id="pedidos" class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Nr° de Pedido</th>
                                    <th>Solicitado</th>
                                    <th>Items</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                <tr>
                                    <td class="text-center">{{$pedido->id}}</td>
                                    <td class="text-center">{{$pedido->getFechaSolicitud()->diffForHumans()}}</td>
                                    <td class="text-center">
                                        @foreach ($pedido->seguimientos as $seguimiento)
                                        <span class="badge badge-secondary">{{ $seguimiento->item->nombre }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-xs p-1 btn-success"
                                            href="{{route('pedidos.ver_pago_pendiente', $pedido)}}">
                                            <i class="fal fa-credit-card"></i>
                                            Pagar
                                        </a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                <br>
                <div class="row justify-content-center">
                    <h4>No tenes Pagos Pendientes!</h4>
                </div>
                <br>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
{{-- <script>
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
</script> --}}
@endpush
