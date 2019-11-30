@extends('admin_panel.index')

@section('content')

<div class="row justify-content-center">


    <div class="col-10">

        <div class="card card-small card-outline card-primary shadow-sm animated fadeIn">
            <div class="card-header pb-1">
                <div class="row justify-content-between my-auto ml-1 mr-1">
                    <h3><strong>Auditorias</strong></h3>
                    <button class="btn btn-primary shadow-sm mb-1" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-filter mr-2"></i>
                        Filtros
                    </button>

                </div>
            </div>

            <div class="card-body">
                <div class="collapse" id="collapseExample">
                    <form action="{{ route("auditoria.reporte") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card border-primary shadow-sm">
                            <div class="card-body ">
                                <div class="row justify-content-start mr-2 ml-2">
                                    <div class="col mr-2 ml-2">
                                        <strong><label for="">Usuario</label></strong>
                                        <select id="filtroUsuario" class="estados-js form-control" name="usuario_id">
                                            <option value="" disabled selected style="">Seleccione un Usuario</option>
                                            @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ strtoupper($usuario->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col mr-2 ml-2">
                                        <strong><label for="">Operacion</label></strong>
                                        <select id="filtroOperacion"
                                            class="estados-js form-control {{ $errors->has('filtro1') ? 'is-invalid' : '' }}"
                                            name="operacion">
                                            <option value="" disabled selected style="">Seleccione una Operacion
                                            </option>
                                            <option value="created">CREATED</option>
                                            <option value="deleted">DELETED</option>
                                            <option value="updated">UPDATED</option>

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

                <div class="table-responsive table-sm">
                    <table id="auditorias" class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center">IDº</th>
                                <th style="text-align: center">Tabla</th>
                                <th style="text-align: center">Operacion</th>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Hora</th>
                                <th style="text-align: center">Usuario</th>
                                <th style="text-align: center">Operacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auditorias as $auditoria)
                            <tr>
                                <td style="text-align: center">{{$auditoria->auditable_id}}</td>
                                <td style="text-align: center">PEDIDOS</td>
                                <td style="text-align: center; text-transform:uppercase">{{$auditoria->event}}</td>
                                <td style="text-align: center">{{$auditoria->created_at->format('d/m/Y')}}</td>
                                <td style="text-align: center">{{$auditoria->created_at->format('H:i:s')}}</td>
                                <td style="text-align: center">{{strtoupper($auditoria->user->name)}}</td>

                                <td width="150px" class="text-center">
                                    <a href="{{route('auditoria.show' , ['auditoria'=> $auditoria, 'id' => $auditoria->auditable_id])}}"
                                        class="btn btn-xs btn-primary">Ver
                                        mas</a>

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
              $('#auditorias').DataTable({
                "order": [[ 0, "desc" ]] ,
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

        var table = $('#auditorias').DataTable();
        var contador = 0;

        $('#limpiar').click(function(){
            $("#filtroUsuario ").prop("selectedIndex", 0) ;
            $("#filtroOperacion ").prop("selectedIndex", 0) ;
            $("#filtroLlegada ").val('') ;
            $("#filtroSalida ").val('') ;
            for(var i = 0; i < contador; i++){
                $.fn.dataTable.ext.search.pop();
            }
            contador = 0;
            table.draw() ;
        });

        $('#filtrar').click(function(){
            var filtroUsuario = $('#filtroUsuario').val();
            // filtroUsuario = filtroUsuario.toUpperCase();
            console.log(filtroUsuario);
            var filtroOperacion = $('#filtroOperacion').val();
            var filtroLlegada = $('#filtroLlegada').val();
            // console.log(filtroLlegada)
            var filtroSalida = $('#filtroSalida').val();


            if(filtroUsuario != null){
                var usuarioSeleccionado = $('#filtroUsuario option:selected').text()
                console.log(usuarioSeleccionado)
                var filtradoTabla2 = function FuncionFiltrado(settings, data, dataIndex){
                    if(data[5]==usuarioSeleccionado){
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
            if(filtroOperacion != null){
                var itemSeleccionado = $('#filtroOperacion option:selected').text()
                console.log(itemSeleccionado);
                var filtradoTabla3 = function FuncionFiltrado(settings, data, dataIndex){
                    if(data[2].toUpperCase()==itemSeleccionado){
                        return true;
                    }else{
                        return false;
                    }
                }
                $.fn.dataTable.ext.search.push( filtradoTabla3 )
                contador++;

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
                    var llegadaTable = data[3]
                    datearray = llegadaTable.split("/");
                    llegadaTable =   datearray[2] + '/'+ datearray[1] + '/' + datearray[0] ;
                    if(moment(llegadaTable).isSameOrAfter(llegada) && moment(llegadaTable).isSameOrBefore(salida)){
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
