@extends('admin_panel.index')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 offset-1">
            <a class="btn btn-success btn-pill btn-lg" href="{{ route("pedidos.nuevo_pedido") }}">
                <i class="fa fa-plus mr-2"></i>
                 Nuevo Pedido
            </a>
        </div>
    </div>
    <br>
<div class="card col-10 offset-1">

    <div class="card-body">
        <div class="table">
            <h3><strong>Mis Pedidos</strong></h3>
            <br>
            <table id="pedidos" class="table table-bordered table-striped table-hover datatable">

                    <thead>
                    <tr>
                      <th>Nro Pedido</th>
                      {{-- <th>Items</th> --}}
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->id}}</td>
                                @if($pedido->estado->nombre !='Finalizado')
                                <td><span class="badge badge-pill badge-success">{{ $pedido->estado->nombre }}</span></td>
                                @else
                                <td><span class="badge badge-pill badge-danger">{{ $pedido->estado->nombre }}</span></td>
                                @endif
                                <td>
                                        <a class="btn btn-xs btn-primary" href="{{route('pedidos.seguimiento', $pedido)}}">
                                            Seguimiento
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
            "ordering": true,
            "info": false,
            "lengthChange": false,
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
            "columns": [
    null,
    { "width": "10%" },
    { "width": "10%" }],
          });
        });
</script>
@endpush
