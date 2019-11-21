@extends('admin_panel.index')
@section('content')
<div class="row justify-content-start">
    <div class="col-4">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <div class="row justify-content-between my-auto">
                    <div class="ml-5">
                        <h3 class="profile-username text-center">{{$pedido->id}}</h3>
                        <p class="text-muted text-center">Id del Pedido</p>
                    </div>
                    <div class="mr-5">
                        <h3 class="profile-username text-center">{{strtoupper($pedido->usuario->name)}}</h3>
                        <p class="text-muted text-center">Usuario Solicitante</p>
                    </div>
                </div>
                <h3 class="profile-username text-center pb-1    "><strong>Estado actual:</strong> <span
                        class="text-success">{{$pedido->estado->nombre}}</span></h3>
            </div>
            <div class="card-body ">
                <h4 class="mb-3 text-center"><strong class="border-bottom border-dark">Detalle del Pedido:</strong>
                </h4>
                <p class="text-center"><strong> Solicitud Efectuada:</strong>
                    {{ $pedido->getFechaSolicitud()->format('d/m/Y H:i')}}hs</p>
                <p class="text-center"><strong> Fecha Final Aproximada:</strong>
                    {{ $pedido->getFechaFinal()->format('d/m/Y ')}}</p>

            </div>
        </div>


    </div>


    <div class="col-6 offset-1">
        @foreach ($pedido->seguimientos as $seguimiento)
        <div class="card card-outline shadow-none card-primary">
            <div class="card-header border-bottom-0 ">
                <div class="row justify-content-between ml-1 mr-1">
                    <h4 class="my-auto"><strong>{{$seguimiento->item->nombre}} <span
                                class="badge badge-pill badge-success">{{$seguimiento->estado->nombre}}</span>
                            @if (sizeof($seguimiento->adicionales)>0)
                            <span class="badge badge-pill badge-warning">Adicionales:
                                {{sizeof($seguimiento->adicionales)}}</span></strong>@endif
                    </h4>
                    <label data-toggle="collapse" data-target="#collapseExample{{$seguimiento->id}}" aria-expanded="false"
                        aria-controls="collapseExample">

                        <i class="far fa-plus"></i>
                    </label>
                </div>
            </div>
            <div class="collapse" id="collapseExample{{$seguimiento->id}}">
                <hr>
                <div class="card-body">
                    <div class="card card-body">
                        <div class="timeline">
                            <div class="time-label">
                                <span class="bg-primary">Historial de {{$seguimiento->item->nombre}}</span>
                            </div>
                            @foreach ($seguimiento->historiales as $historial)
                            <div>
                                <i class="fas fa-check bg-success"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fal fa-check"></i>
                                        {{$historial->created_at->diffForHumans()}}</span>
                                    <h4 class="timeline-header"><strong>{{$historial->estado->nombre}} </strong></h4>

                                </div>
                            </div>
                            @endforeach
                            @if ($seguimiento->estado->nombre!='Terminado')
                            <div>
                                <i class="fas fa-clock bg-info"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">
                                        <strong>{{$seguimiento->item->tipoItem->flujoTrabajo->transicion_siguiente($historial->estado)->nombre}}
                                        </strong></h3>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-pill btn-success" data-toggle="modal"
                                data-target="#seguimiento{{$seguimiento->id}}">{{$seguimiento->item->tipoItem->flujoTrabajo->estado_siguiente($historial->estado)->nombre}}</button>
                            {{-- //MODAL --}}
                            <div class="modal fade" id="seguimiento{{$seguimiento->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="shadow-sm rounded modal-dialog modal-dialog-scrollable modal-md "
                                    role="document">
                                    <div class="modal-content card-outline card-primary">

                                        <div class="modal-header">
                                            <input type="hidden" name="pedido" value="{{$pedido->id}}">

                                            <h4 class="modal-title" id="exampleModalScrollableTitle"><strong>Accion
                                                    Importante Requerida!</strong></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route("pedidos.asignar_estado_seguimiento") }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="seguimiento" value="{{$seguimiento->id}}">
                                            <input type="hidden" name="estado"
                                                value="{{$seguimiento->item->tipoItem->flujoTrabajo->estado_siguiente($seguimiento->estado)->id}}">
                                            <div class="modal-body">
                                                <h5 class="text-center ">
                                                    <strong
                                                        class="border-bottom border-dark">{{$seguimiento->item->tipoItem->flujoTrabajo->transicion_siguiente($historial->estado)->nombre}}</strong>
                                                </h5>
                                                <div class="card card-body border shadow-sm mt-3">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-7">
                                                            <label><strong>Presento inconvenientes a la hora de realizar
                                                                    la
                                                                    accion?</strong></label>
                                                        </div>
                                                        <div class="my-auto mr-4">
                                                            <label data-toggle="collapse"
                                                                data-target="#collapseSeguimiento{{$seguimiento->id}}"
                                                                aria-expanded="false"
                                                                aria-controls="collapseSeguimiento{{$seguimiento->id}}">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="switch1{{$seguimiento->id}}">
                                                                    <label class="custom-control-label"
                                                                        for="switch1{{$seguimiento->id}}"></label>
                                                                </div>
                                                            </label>
                                                        </div>


                                                    </div>
                                                    <div class="collapse" id="collapseSeguimiento{{$seguimiento->id}}">
                                                        <div class="form-group">
                                                            <textarea class="form-control border" rows="3"
                                                                placeholder="Detalle los inconvenientes..."
                                                                name="revision"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer justify-content-end">
                                                <button class="btn btn-pill btn-success" data-toggle="modal"
                                                    data-target="#seguimiento{{$seguimiento->id}}"
                                                    type="submit">{{$seguimiento->item->tipoItem->flujoTrabajo->estado_siguiente($seguimiento->estado)->nombre}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- FIN MODAL --}}

                        </div>
                    </div>
                    @else
                </div>
            </div>
            @endif
            <hr>
            @if (sizeof($seguimiento->adicionales)>0)
            <div class="row justify-content-center">
                <h4><strong>Adicionales</strong></h4>
            </div>
            <hr class="mt-0">
            @foreach ($seguimiento->adicionales as $adicional)
            <div class="card card-body border shadow-sm">
                <div class="timeline">
                    <div class="time-label">
                        <span class="bg-warning border shadow-sm">{{$adicional->item->nombre}} - Cantidad:
                            {{$adicional->cantidad}}</span>
                    </div>
                    @foreach ($adicional->historiales as $historial)
                    <div>
                        <i class="fas fa-check bg-success"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fal fa-check"></i>
                                {{$historial->created_at->diffForHumans()}}</span>
                            <h4 class="timeline-header"><strong>{{$historial->estado->nombre}} </strong></h4>

                        </div>
                    </div>
                    @endforeach
                    @if ($adicional->estado->nombre!='Terminado')
                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header">
                                <strong>{{$adicional->item->tipoItem->flujoTrabajo->transicion_siguiente($adicional->estado)->nombre}}
                                </strong></h3>
                        </div>

                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    {{-- <form action="{{ route("pedidos.asignar_estado_adicional") }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="adicional" value="{{$adicional->id}}">
                    <input type="hidden" name="estado"
                        value="{{$adicional->item->tipoItem->flujoTrabajo->estado_siguiente($adicional->estado)->id}}">
                    <button class="btn btn-pill btn-success"
                        type="submit">{{$adicional->item->tipoItem->flujoTrabajo->estado_siguiente($adicional->estado)->nombre}}</button>
                    </form> --}}





                    <button class="btn btn-pill btn-success" data-toggle="modal"
                        data-target="#adicional{{$adicional->id}}">{{$adicional->item->tipoItem->flujoTrabajo->estado_siguiente($historial->estado)->nombre}}</button>
                    {{-- //MODAL --}}
                    <div class="modal fade" id="adicional{{$adicional->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="shadow-sm rounded modal-dialog modal-dialog-scrollable modal-md " role="document">
                            <div class="modal-content card-outline card-primary">

                                <div class="modal-header">
                                    <input type="hidden" name="pedido" value="{{$pedido->id}}">

                                    <h4 class="modal-title" id="exampleModalScrollableTitle"><strong>Accion
                                            Importante Requerida!</strong></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route("pedidos.asignar_estado_adicional") }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="adicional" value="{{$adicional->id}}">
                                    <input type="hidden" name="estado"
                                        value="{{$adicional->item->tipoItem->flujoTrabajo->estado_siguiente($adicional->estado)->id}}">
                                    <div class="modal-body">
                                        <h5 class="text-center ">
                                            <strong
                                                class="border-bottom border-dark">{{$adicional->item->tipoItem->flujoTrabajo->transicion_siguiente($adicional->estado)->nombre}}</strong>
                                        </h5>
                                        <div class="card card-body border shadow-sm mt-3">
                                            <div class="d-flex justify-content-between">
                                                <div class="col-7">
                                                    <label><strong>Presento inconvenientes a la hora de realizar
                                                            la
                                                            accion?</strong></label>
                                                </div>
                                                <div class="my-auto mr-4">
                                                    <label data-toggle="collapse"
                                                        data-target="#collapseAdicional{{$adicional->id}}"
                                                        aria-expanded="false"
                                                        aria-controls="collapseAdicional{{$adicional->id}}">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="switch1{{$adicional->id}}">
                                                            <label class="custom-control-label"
                                                                for="switch1{{$adicional->id}}"></label>
                                                        </div>
                                                    </label>
                                                </div>


                                            </div>
                                            <div class="collapse" id="collapseAdicional{{$adicional->id}}">
                                                <div class="form-group">
                                                    <textarea class="form-control border" rows="3"
                                                        placeholder="Detalle los inconvenientes..."
                                                        name="revision"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($adicional->item->tipoItem->flujoTrabajo->transicion_siguiente($adicional->estado)->devolucion == true)


                                        <div class="card card-body border shadow-sm mt-3">
                                            <div class="d-flex justify-content-between">
                                                <div class="col-7">
                                                    <label><strong>Hay faltantes a la hora de la
                                                            devolucion</strong></label>
                                                </div>
                                                <div class="my-auto mr-4">
                                                    <label data-toggle="collapse"
                                                        data-target="#collapseAdicional2{{$adicional->id}}"
                                                        aria-expanded="false"
                                                        aria-controls="collapseAdicional2{{$adicional->id}}">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="switch2{{$adicional->id}}">
                                                            <label class="custom-control-label"
                                                                for="switch2{{$adicional->id}}"></label>
                                                        </div>
                                                    </label>
                                                </div>


                                            </div>
                                            <div class="collapse" id="collapseAdicional2{{$adicional->id}}">
                                                <div class="form-group">
                                                    <input type="number" class="form-control"
                                                        placeholder="Cantidad que falta" min="0" name="faltante">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="modal-footer justify-content-end">
                                        <button class="btn btn-pill btn-success" data-toggle="modal"
                                            data-target="#adicional{{$adicional->id}}"
                                            type="submit">{{$adicional->item->tipoItem->flujoTrabajo->estado_siguiente($adicional->estado)->nombre}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- FIN MODAL --}}






                </div>
            </div>
            @else
        </div>
    </div>
    @endif
    @endforeach
    @endif
</div>
</div>
</div>
@endforeach
</div>
</div>
@endsection
