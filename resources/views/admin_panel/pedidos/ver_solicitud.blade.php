@extends('admin_panel.index')
@section('content')
<div class="d-flex justify-content-center">

         <div class="card card-primary card-outline col-md-10">
                <div class="card-header border-bottom">
                    <h3 class="profile-username text-center"><strong>Solicitud de Pedido N°: {{ $pedido->id }}</strong> </h3>
                </div>
            <div class="card-body box-profile">
                        <div class="offset-2 col-8 justify-content-center">
                            <div class="d-flex justify-content-between row  ">
                                <input class="btn btn-pill btn-success" type="submit" value="Aceptar Solicitud">
                                <input class="btn btn-pill btn-danger" type="submit" value="Cancelar Solicitud">
                            </div>
                        </div>
                        <br>
                        <div class="col-12 border-bottom"></div>
                            <br>
                        <div class=" row">
                            <div class="col-6">
                                <div class="form-group border-bottom ">
                                    <strong><label class="control-label " ><i class="fas fa-user"></i> Detalles del Solicitante </label></strong>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label "><strong>Nombre:</strong> {{ $pedido->usuario->name }} </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group border-bottom">
                                        <strong><label class="control-label"><i class="fal fa-box-open"></i> Items Solicitados </label></strong>
                                        <br>
                                </div>
                                @foreach ($pedido->seguimientos as $seguimiento)
                                <div class="form-group offset-1">
                                    <br>

                                    <label ><Strong>Tipo de Item:</Strong> {{ $seguimiento->item->tipoItem->nombre }}</label><br>
                                    <label ><Strong>Nombre:</Strong> {{ $seguimiento->item->nombre }}</label><br>
                                    <label ><Strong>Capacidad:</Strong> {{ $seguimiento->item->capacidad }}</label><br>
                                    <label ><Strong>Llegada:</Strong> {{ \Carbon\Carbon::create($seguimiento->fechaInicial)->format('d/m/Y') }}</label>
                                    <label  ><Strong>Salida:</Strong> {{ \Carbon\Carbon::create($seguimiento->fechaFinal)->format('d/m/Y') }}</label>
                                </div>
                                @endforeach




                            </div>
                        </div>

            </div>

            </div>
            <!-- /.card-body -->
        </div>




@endsection
