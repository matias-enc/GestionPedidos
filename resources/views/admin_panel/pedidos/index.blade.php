@extends('admin_panel.index')

@section('content')
<div class="row justify-content-center">


    <div class="col-10">


        <div class="card card-small ">
            <div class="card-header">
                <div class="row justify-content-between ml-1 mr-1">
                    <h3><strong>Pedidos</strong></h3>
                    <button class="btn btn-primary shadow-sm" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-filter mr-2"></i>
                        Filtros
                    </button>

                </div>
            </div>

            <div class="card-body">
                <div class="collapse" id="collapseExample">
                    <form action="{{ route("pedidos.reporte") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card border-primary shadow-sm">
                            <div class="card-body ">

                                <div class="row justify-content-start mr-2 ml-2">
                                    <div class="mr-2 ml-2">
                                        <strong><label for="">Usuario</label></strong>
                                        <select id="filtro2"
                                            class="estados-js form-control {{ $errors->has('filtro1') ? 'is-invalid' : '' }}"
                                            name="usuario_id">
                                            <option value="" disabled selected style="">Seleccione un Usuario</option>
                                            @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="mr-2 ml-2">
                                        <strong><label for="">Item</label></strong>
                                        <select id="filtro3"
                                            class="estados-js form-control {{ $errors->has('filtro1') ? 'is-invalid' : '' }}"
                                            name="item_id">
                                            <option value="" disabled selected style="">Seleccione un Item</option>
                                            @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mr-2 ml-2">
                                        <strong><label for="">Tipo de Estado</label></strong>
                                        <select id="filtro1"
                                            class="estados-js form-control {{ $errors->has('filtro1') ? 'is-invalid' : '' }}"
                                            name="estado_id">
                                            <option value="" disabled selected style="">Seleccione un Estado</option>
                                            @foreach ($estados as $estado)
                                            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-end  mr-2 ml-2">
                                    <button class="btn btn-secondary shadow-sm mr-1 ml-1" type="button" id="limpiar">
                                        <i class="fal fa-recycle "></i>
                                        Limpiar
                                    </button>
                                    <button class="btn btn-info shadow-sm mr-1 ml-1" type="button" id="filtrar">
                                        <i class="fal fa-filter "></i>
                                        Filtrar
                                    </button>
                                    <button class="btn btn-success shadow-sm mr-1 ml-1" type="submit" id="generar">
                                        <i class="fal fa-file-pdf "></i>
                                        Generar PDF
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
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
                                    <a class="btn btn-xs btn-primary" href="{{route('pedidos.show', $pedido)}}">
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
<script>
    $(document).ready(function() {

    var table = $('#pedidos').DataTable();
    var contador = 0;

    $('#limpiar').click(function(){
        $("#filtro1 ").prop("selectedIndex", 0) ;
        $("#filtro2 ").prop("selectedIndex", 0) ;
        $("#filtro3 ").prop("selectedIndex", 0) ;
        for(var i = 0; i < contador; i++){
            $.fn.dataTable.ext.search.pop();
        }
        contador = 0;
        table.draw() ;
    }) ;

    $('#filtrar').click(function(){
        var filtro1 = $('#filtro1').val();
        var filtro2 = $('#filtro2').val();
        var filtro3 = $('#filtro3').val();

        if(filtro1 != null){
            var estadoSeleccionado = $('#filtro1 option:selected').text()
            var filtradoTabla1 = function FuncionFiltrado(settings, data, dataIndex){
                if(data[3]==estadoSeleccionado){
                    return true;
                }else{
                    return false;
                }
            }
            contador++;
            $.fn.dataTable.ext.search.push( filtradoTabla1 )


            table.draw()
        }
        if(filtro2 != null){
            var usuarioSeleccionado = $('#filtro2 option:selected').text()
            var filtradoTabla2 = function FuncionFiltrado(settings, data, dataIndex){
                if(data[1]==usuarioSeleccionado){
                    return true;
                }else{
                    return false;
                }
            }
            $.fn.dataTable.ext.search.push( filtradoTabla2 )
            contador++;

            table.draw()
        }
        if(filtro3 != null){
            var itemSeleccionado = $('#filtro3 option:selected').text()
            var filtradoTabla3 = function FuncionFiltrado(settings, data, dataIndex){
                if(data[2].includes(itemSeleccionado)){
                    return true;
                }else{
                    return false;
                }
            }
            $.fn.dataTable.ext.search.push( filtradoTabla3 )
            contador++;

            table.draw()
        }
    });
});
</script>
@endpush
