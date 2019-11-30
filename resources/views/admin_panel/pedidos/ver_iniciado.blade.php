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
        <div class="alert alert-success alert-dismissible  animated fadeInDown shadow-sm" id="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fal fa-info"></i> Informacion!</h5>
            Al momento de realizar la <strong>Entrega</strong> o registrar una <strong>Devolucion</strong> debe de
            generar una documentacion, esta misma debe firmar la persona a la cual se hace la entrega de lo que haya
            solicitado.
            Posteriormente debe de subirse una copia del <strong>Documento Firmado</strong>.
        </div>
        @foreach ($pedido->seguimientos as $seguimiento)
        @if($seguimiento->estado!=null)
        <div class="card card-outline shadow-none card-primary">
            <div class="card-header border-bottom-0 ">
                <div class="row justify-content-between ml-1 mr-1">
                    <h4 class="my-auto"><strong>{{$seguimiento->item->nombre}}
                            @if ($seguimiento->estado!=null)

                            <span class="badge badge-pill badge-success">{{$seguimiento->estado->nombre}}</span>@endif
                            @if (sizeof($seguimiento->adicionales)>0)
                            <span class="badge badge-pill badge-warning">Adicionales:
                                {{sizeof($seguimiento->adicionales)}}</span></strong>@endif
                    </h4>
                    <label data-toggle="collapse" data-target="#collapseExample{{$seguimiento->id}}"
                        aria-expanded="false" aria-controls="collapseExample">

                        <i class="far fa-plus"></i>
                    </label>
                </div>
            </div>

            <div class="collapse show" id="collapseExample{{$seguimiento->id}}">
                <hr>
                <div class="card-body">
                    <div class="timeline">
                        <div class="time-label">
                            <span class="bg-primary">Historial de {{$seguimiento->item->nombre}}</span>
                        </div>
                        @foreach ($seguimiento->historiales as $historial)
                        <div>
                            <i class="fas fa-check bg-success"></i>
                            <div class="timeline-item shadow-sm border">

                                <h4 class="timeline-header border-bottom-0 d-flex justify-content-between">
                                    <strong>{{$historial->estado->nombre}}
                                    </strong>

                                    @if($historial->documentacion==null)
                                    @if ($historial->estado->nombre == 'Entregado' || $historial->estado->nombre ==
                                    'Terminado')
                                    <div class="d-flex">


                                        <a class="btn btn-sm btn-danger pb-2 ml-2"
                                            href="{{route('pedidos.generar_documentacion_historial', $historial)}}">
                                            <i class="fal fa-file-pdf"></i> Generar</a>
                                        <button class="btn btn-primary btn-sm pb-0 ml-2 btn-subir" type="none"
                                            for="documento{{$historial->id}}" id="{{$historial->id}}">
                                            <label class="label-input" for="documento{{$historial->id}}"
                                                id="labeldocumento"><i class="fal fa-upload"></i> Subir</label>
                                        </button>
                                        <form
                                            action="{{ route("pedidos.asignar_documentacion_historial", $historial) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="documento" id="documento{{$historial->id}}"
                                                class="inputfile" style="display: none; visibility: hidden" />
                                            <button id="btn-enviar{{$historial->id}}"
                                                class="btn btn-pill btn-success btn-sm ml-2" type="submit"
                                                style="display: none; visibility: hidden">
                                                <i class="fal fa-check"> </i>
                                            </button>
                                        </form>

                                    </div>
                                    @endif
                                    @else
                                    <div class="d-flex">
                                        <label class="my-auto"> Enviado <i class="fal fa-check"></i></label>
                                    </div>
                                    @endif
                                </h4>



                            </div>

                        </div>
                        @endforeach
                        @if ($seguimiento->estado->nombre=='Terminado')
                    </div></div></div>
                        @else
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
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content card-outline card-primary overflow-auto">

                                    <div class="modal-header">
                                        <input type="hidden" name="pedido" value="{{$pedido->id}}">

                                        <h4 class="modal-title" id="exampleModalScrollableTitle"><strong>Accion
                                                Importante Requerida!</strong></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route("pedidos.asignar_estado_general") }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="seguimiento" value="{{$seguimiento->id}}">
                                        <input type="hidden" name="estado"
                                            value="{{$seguimiento->item->tipoItem->flujoTrabajo->estado_siguiente($seguimiento->estado)->id}}">
                                        <div class="modal-body">
                                            <h5 class="text-center ">
                                                <strong
                                                    class="">{{$seguimiento->item->tipoItem->flujoTrabajo->transicion_siguiente($historial->estado)->nombre}}</strong>
                                            </h5>
                                            <div class="card card-primary card-outline ">
                                                <div class="card-header pb-0">
                                                    <h5><strong>{{$seguimiento->item->nombre}}</strong></h5>
                                                </div>
                                                <div class="card-body">

                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-7">
                                                            <label><strong>Presento inconvenientes a la hora de
                                                                    realizar
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
                                            @if(sizeof($seguimiento->adicionales)>0)
                                            {{-- <hr> --}}
                                            <h5 class="text-center"><strong>Adicionales de
                                                    {{$seguimiento->item->nombre}}</strong></h5>
                                            {{-- <hr> --}}
                                            @foreach ($seguimiento->adicionales as $adicional)
                                            <div class="card card-outline card-warning">
                                                <input type="hidden" name="adicionales[]" value="{{$adicional->id}}">
                                                <div class="card-header pb-0">
                                                    <h5><strong>{{$adicional->item->nombre}}</strong></h5>
                                                </div>

                                                <div class=" card-body">

                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-7">
                                                            <label><strong>Presento inconvenientes a la hora de
                                                                    realizar
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
                                                                name="revision_adicional[]"></textarea>
                                                        </div>
                                                    </div>
                                                    {{-- {{$adicional->item->tipoItem->flujoTrabajo->transicion_siguiente($adicional->estado)}}
                                                    --}}
                                                    @if($adicional->item->tipoItem->flujoTrabajo->transicion_siguiente($adicional->estado)!=null)
                                                    @if($adicional->item->tipoItem->flujoTrabajo->transicion_actual($adicional->estado)->devolucion==true)

                                                    <hr>
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
                                                                placeholder="Cantidad que falta" min="0"
                                                                name="faltantes[]">
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>

                                        <div class="modal-footer justify-content-end">
                                            <button class="btn btn-pill btn-success" data-toggle="modal"
                                                data-target="#seguimiento{{$seguimiento->id}}"
                                                type="submit">Asignar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- FIN MODAL --}}
                    </div>
                </div>
            </div>
            @endif

        </div>
        @endif
        @endforeach
    </div>
</div>
</div>

</div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $("#alert").fadeTo(15000, 500).slideUp(500, function(){
        $("#alert").slideUp(500);
});
});
</script>
<script>
    $('.btn-subir').on("click",function(e) {
    var id = $(this).attr('id');
    console.log(id)
    $('#documento'+id).on("change",function(e) {
        $("#btn-enviar"+id).css('visibility','visible');
        $("#btn-enviar"+id).css('display','block');
})
});
</script>
@endpush
