@extends('admin_panel.index')

@section('content')
<div class="row justify-content-center">


    <div class="col-10">


        <div class="card card-small card-outline card-primary shadow-sm">
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
                                    <div class="col mr-2 ml-2">
                                        <strong><label for="">Usuario</label></strong>
                                        <select id="filtroUsuario"
                                            class="estados-js form-control {{ $errors->has('filtroEstado') ? 'is-invalid' : '' }}"
                                            name="usuario_id">
                                            <option value="" disabled selected style="">Seleccione un Usuario</option>
                                            @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ mb_strtoupper($usuario->name) }} {{mb_strtoupper($usuario->apellido)}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col mr-2 ml-2">
                                        <strong><label for="">Item</label></strong>
                                        <select id="filtroItem"
                                            class="estados-js form-control {{ $errors->has('filtro1') ? 'is-invalid' : '' }}"
                                            name="item_id">
                                            <option value="" disabled selected style="">Seleccione un Item</option>
                                            @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col mr-2 ml-2">
                                        <strong><label for="">Tipo de Estado</label></strong>
                                        <select id="filtroEstado"
                                            class="estados-js form-control {{ $errors->has('filtroEstado') ? 'is-invalid' : '' }}"
                                            name="estado_id">
                                            <option value="" disabled selected style="">Seleccione un Estado</option>
                                            @foreach ($estados as $estado)
                                            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col mr-2 ml-2">
                                        <strong><label for="">Fechas</label></strong>
                                        <div class="input-group input-daterange" id="datepicker"
                                            data-date-format="dd/mm/yyyy" data-date-container='#datepicker'>
                                            <input type="text"
                                                class="input-sm form-control {{ $errors->has('llegada') ? 'is-invalid' : ''}}"
                                                name="llegada" id="filtroLlegada" placeholder="Inicio"
                                                value="{{old('llegada')}}" }} />
                                            <input type="text"
                                                class="input-sm form-control {{ $errors->has('salida') ? 'is-invalid' : '' }}"
                                                name="salida" id="filtroSalida" placeholder="Final"
                                                value="{{ old('salida') }}" />
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-end  mr-2 ml-2">
                                    <button class="btn btn-info shadow-sm mr-1 ml-1" type="button" id="limpiar">
                                        <i class="fal fa-recycle "></i>
                                        Limpiar
                                    </button>
                                    <button class="btn btn-success shadow-sm mr-1 ml-1" type="button" id="filtrar">
                                        <i class="fal fa-check "></i>
                                        Aplicar
                                    </button>
                                    <button class="btn btn-danger shadow-sm mr-1 ml-1" type="submit" id="generar">
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
                                <th>Usuario</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Items</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                            @if ($pedido->usuario!=null)
                            <tr>
                                <td class="text-center">
                                    <span class="badge badge-warning">{{mb_strtoupper($pedido->usuario->name) }} {{mb_strtoupper($pedido->usuario->apellido)}}</span>
                                </td>
                                <td class="text-center"> {{$pedido->getFechaInicial()->format('d/m/Y')}}</td>
                                <td class="text-center"> {{$pedido->getFechaFinal()->format('d/m/Y')}}</td>
                                <td>
                                    @foreach ($pedido->seguimientos as $seguimiento)
                                    <span class="badge badge-info">{{ $seguimiento->item->nombre }}
                                        @if (sizeof($seguimiento->adicionales)>0)
                                        <i class="fas fa-exclamation-circle "></i>
                                        @endif


                                    </span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-success">{{ $pedido->estado->nombre }}</span>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary" href="{{route('pedidos.show', $pedido)}}">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            @endif
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
<script>
    $('#datepicker').datepicker({
                weekStart: 1,
                orientation: "bottom",
                endDate: "1/1/2021",
                language: "es",
                todayHighlight: true,
            });
</script>
<script>
    $(document).ready(function() {

    var table = $('#pedidos').DataTable();
    var contador = 0;

    $('#limpiar').click(function(){
        $("#filtroEstado ").prop("selectedIndex", 0) ;
        $("#filtroUsuario ").prop("selectedIndex", 0) ;
        $("#filtroItem ").prop("selectedIndex", 0) ;
        $("#filtroLlegada ").val('') ;
        $("#filtroSalida ").val('') ;
        for(var i = 0; i < contador; i++){
            $.fn.dataTable.ext.search.pop();
        }
        contador = 0;
        table.draw() ;
    }) ;

    $('#filtrar').click(function(){
        var filtroEstado = $('#filtroEstado').val();
        console.log(filtroEstado)
        var filtroUsuario = $('#filtroUsuario').val();
        if(filtroUsuario!=null){
        filtroUsuario = filtroUsuario.toUpperCase();
        }
        console.log(filtroUsuario);
        var filtroItem = $('#filtroItem').val();
        var filtroLlegada = $('#filtroLlegada').val();
        console.log(filtroLlegada)
        var filtroSalida = $('#filtroSalida').val();


        if(filtroUsuario != null){
            var usuarioSeleccionado = $('#filtroUsuario option:selected').text()
            console.log(usuarioSeleccionado)
            var filtradoTabla2 = function FuncionFiltrado(settings, data, dataIndex){
                if(data[0]==usuarioSeleccionado){
                    return true;
                    console.log('entre')
                }else{
                    return false;
                }
            }
            $.fn.dataTable.ext.search.push( filtradoTabla2 )
            contador++;

            table.draw()
        }
        if(filtroItem != null){
            var itemSeleccionado = $('#filtroItem option:selected').text()
            var filtradoTabla3 = function FuncionFiltrado(settings, data, dataIndex){
                if(data[3].includes(itemSeleccionado)){
                    return true;
                }else{
                    return false;
                }
            }
            $.fn.dataTable.ext.search.push( filtradoTabla3 )
            contador++;

            table.draw()
        }
        if(filtroEstado != null){
            var estadoSeleccionado = $('#filtroEstado option:selected').text()
            var filtradoTabla1 = function FuncionFiltrado(settings, data, dataIndex){
                if(data[4]==estadoSeleccionado){
                    return true;
                }else{
                    return false;
                }
            }
            contador++;
            $.fn.dataTable.ext.search.push( filtradoTabla1 )


            table.draw()
        }
        if(filtroLlegada != '' ){
            var llegada = $('#filtroLlegada').val()
            var datearray = llegada.split("/");
            var newdate =   datearray[2] + '/'+ datearray[1] + '/' + datearray[0] ;
            var llegada = $('#filtroLlegada').val()
            var datearray = llegada.split("/");
            llegada =   datearray[2] + '/'+ datearray[1] + '/' + datearray[0] ;
            var salida = $('#filtroSalida').val()
            datearray = salida.split("/");
            salida =   datearray[2] + '/'+ datearray[1] + '/' + datearray[0] ;
            var filtradoTablaFecha = function FuncionFiltrado(settings, data, dataIndex){
                var llegadaTable = data[1]
                datearray = llegadaTable.split("/");
                llegadaTable =   datearray[2] + '/'+ datearray[1] + '/' + datearray[0] ;
                var salidaTable = data[2]
                datearray = salidaTable.split("/");
                salidaTable =   datearray[2] + '/'+ datearray[1] + '/' + datearray[0] ;
                if((moment(llegadaTable).isSameOrAfter(llegada) && moment(llegadaTable).isSameOrBefore(salida))&&(moment(salidaTable).isSameOrAfter(llegada) && moment(salidaTable).isSameOrBefore(salida))){
                    return true;
                }else{
                    return false;
                }

            };
            $.fn.dataTable.ext.search.push( filtradoTablaFecha )
            contador++;
            table.draw();
        }
    });
});
</script>

@endpush
