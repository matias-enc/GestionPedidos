@extends('admin_panel.index')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-lg-8">


        <div class="card card-primary card-outline">
            <div class="card-header border-bottom">
                <h3 class="profile-username text-center"><strong>Solicitud de Pedido N°: {{ $pedido->id }}</strong>
                </h3>
            </div>
            <div class="card-body box-profile">
                <div class=" row">
                    <div class="col-6">
                        <div class="form-group border-bottom ">
                            <strong><label class="control-label "><i class="fas fa-user"></i> Detalles del Solicitante
                                </label></strong>
                        </div>
                        <div class="form-group ">
                            <label class="control-label "><strong>Nombre:</strong> {{ $pedido->usuario->name }} </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group border-bottom">
                            <strong><label class="control-label"><i class="fal fa-box-open"></i> Items Solicitados
                                </label></strong>
                            <br>
                        </div>
                        @foreach ($pedido->seguimientos as $seguimiento)
                        <div class="callout border shadow-sm">

                            <label><Strong>Tipo de Item:</Strong> {{ $seguimiento->item->tipoItem->nombre }}</label><br>
                            <label><Strong>Item:</Strong> {{ $seguimiento->item->nombre }}</label><br>
                            <label><Strong>Capacidad:</Strong> {{ $seguimiento->item->capacidad }}</label><br>
                            <label><Strong>Llegada:</Strong>
                                {{ \Carbon\Carbon::create($seguimiento->fechaInicial)->format('d/m/Y') }}</label>
                            <label><Strong>Salida:</Strong>
                                {{ \Carbon\Carbon::create($seguimiento->fechaFinal)->format('d/m/Y') }}</label><br>

                            @if (sizeof($seguimiento->adicionales)!=0)
                            <label><strong>Adicionales</strong>:</label>
                            <div class="row justify-content-start ">
                                @foreach ($seguimiento->adicionales as $adicional)
                                <div class="card card-small col-lg-7 border shadow-sm offset-1">
                                    <div class="card-body d-flex">
                                        <div class="d-flex flex-column justify-content-center ml-1">
                                            <span class="card-post__author-name">{{$adicional->item->nombre}}</span>
                                            <small class="text-muted">Cantidad: {{$adicional->cantidad}}</small>
                                        </div>
                                    </div>


                                </div>

                                @endforeach


                            </div>
                            @endif
                        </div>
                        @endforeach




                    </div>
                </div>
                <br>
                <div class="col-12 border-bottom"></div>
                <br>
                <div class="offset-2 col-8 justify-content-center">
                    <div class="d-flex justify-content-between row  ">
                        <button type="button" class="btn btn-pill btn-success" data-toggle="modal"
                            data-target="#exampleModalScrollable">
                            Aceptar Solicitud
                        </button>
                        <form action="{{ route("pedidos.finalizar_pedido") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$pedido->id}}" name='pedido_id'>
                            <input class="btn btn-pill btn-danger" type="submit" value="Cancelar Solicitud">
                        </form>
                    </div>
                </div>


            </div>

        </div>
        <!-- /.card-body -->
    </div>
</div>

<form action="{{ route("pedidos.asignar_estado") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="shadow-sm rounded modal-dialog modal-dialog-scrollable modal-md " role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <input type="hidden" name="pedido" value="{{$pedido->id}}">

                    <h4 class="modal-title" id="exampleModalScrollableTitle"><strong>Seleccione una Accion</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">Estados Posibles</label>
                    <select id="estado"
                        class="estados-js form-control {{ $errors->has('estados') ? 'is-invalid' : '' }}" name="estado">
                        <option value="" disabled selected style="">Seleccione una Accion</option>
                        @foreach ($pedido->flujoTrabajo->estados_posibles($pedido->estado) as $estado)
                        <option placeholder="Categoria" value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                        @endforeach
                </div>

                </select>

                <div class="modal-footer justify-content-end">
                    <button class="btn btn-pill btn-success" type="submit">Asignar!</button>
                </div>
            </div>
        </div>
    </div>
    </div>

</form>




@endsection
