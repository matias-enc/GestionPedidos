@extends('admin_panel.index')

@section('content')


<div class=" row justify-content-center animated fadeIn">
    <div class="alert alert-success alert-dismissible col-8 animated fadeInDown">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fal fa-info"></i> Informacion!</h5>
        Actualmente no contamos con la cantidad que ha solicitado, pero hemos armado un <strong>Paquete</strong> para usted que podria
        interesarle.
    </div>
    <div class="col-9">
        <div class="card card-small card-outline card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4><strong>Paquete de {{$tipoItem->nombre}}</strong></h4>
                    <span class="badge badge-pill badge-warning my-auto">Capacidad: {{$capacidadNecesaria}}</span>
                </div>
            </div>
            <form action="{{ route("pedidos.detalle_pedido") }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach ($itemsRecomendados as $item)
                        <div class="card m-4 shadow-sm " style="width: 20rem;">
                        <input type="hidden" id="item" name="item_id[]" class="form-control" value="{{$item->id}}">
                            {{-- Cambiar al agregar fotos --}}
                            @if ($item->tipoItem->nombre=='Albergues')
                            <img class="card-img-top " style="height: 15rem" src="{{asset('imagenes/albergue.jpg')}}"
                                alt="Card image cap">

                            @endif
                            @if ($item->tipoItem->nombre=='Complejos')
                            <img class="card-img-top" style="height: 15rem" src="{{asset('imagenes/complejo.jpg')}}"
                                alt="Card image cap">

                            @endif
                            @if ($item->tipoItem->nombre=='Salones de Eventos')
                            <img class="card-img-top" style="height: 15rem" src="{{asset('imagenes/salon.jpg')}}"
                                alt="Card image cap">

                            @endif
                            <div class="card-header">
                                <h2 class="card-title"><strong>{{$item->nombre}}</strong></h2>
                                <div class="card-tools">
                                    <span class="badge badge-warning">Capacidad: {{$item->capacidad}} personas</span>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-2">
                                    @if ($item->tipoItem->nombre == 'Albergues')
                                    <div>
                                        <a> <i class="fas fa-dollar-sign"> </i>
                                            <strong>{{$item->precioUnitario}}</strong>
                                            (Por
                                            Noche)</a>
                                    </div>
                                    @else
                                    <div>
                                        <a> <i class="fas fa-dollar-sign"> </i>
                                            <strong>{{$item->precioUnitario}}</strong>
                                            (Por
                                            Hora)</a>
                                    </div>
                                    @endif

                                </div>


                            </div>
                        </div>

                        @csrf
                        <input type="hidden" id="fechaInicial" name="fechaInicial" class="form-control"
                            value="{{$fechaInicial}}">
                        <input type="hidden" id="fechaFinal" name="fechaFinal" class="form-control"
                            value="{{$fechaFinal}}">
                        @endforeach

                    </div>
                    <div class="d-flex justify-content-center">

                        <button class=" btn btn-pill btn-primary" type="submit">
                            Saber Más
                            <i class="fal fa-plus mr-2"></i>
                        </button>

                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
@push('scripts')


@endpush
