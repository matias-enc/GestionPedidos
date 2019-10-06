@extends('admin_panel.index')

@section('content')

<div class="row justify-content-center">


    <div class="card card-primary card-outline shadow-sm">
        <div class="card-body text-center">
            <h3><strong> {{$tipoItem->nombre}} Disponibles </strong></h3>
        </div>
    </div>
</div>
<form action="{{ route("pedidos.detalle_pedido") }}" method="POST" enctype="multipart/form-data">
    <div class="d-flex row justify-content-center">


        @foreach ($items as $item)
        <form action="{{ route("pedidos.detalle_pedido") }}" method="POST" enctype="multipart/form-data">
            <div class="card m-4 shadow-sm " style="width: 20rem;">
                <input type="hidden" id="item" name="item_id" class="form-control" value="{{$item->id}}">
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
                            <a> <i class="fas fa-dollar-sign"> </i> <strong>{{$item->precioUnitario}}</strong> (Por
                                Noche)</a>
                        </div>
                        @else
                        <div>
                                <a> <i class="fas fa-dollar-sign"> </i> <strong>{{$item->precioUnitario}}</strong> (Por
                                    Hora)</a>
                            </div>
                        @endif

                    </div>
                    <div class="d-flex justify-content-center">

                        <button class=" btn btn-pill btn-success" type="submit">
                            <i class="fal fa-map-marker mr-2"></i>
                            Ver Más
                        </button>

                    </div>

                </div>
            </div>

            @csrf
            <input type="hidden" id="fechaInicial" name="fechaInicial" class="form-control" value="{{$fechaInicial}}">
            <input type="hidden" id="fechaFinal" name="fechaFinal" class="form-control" value="{{$fechaFinal}}">
        </form>
        @endforeach

    </div>

    @endsection
    @push('scripts')


    @endpush
