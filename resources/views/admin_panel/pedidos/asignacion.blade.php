@extends('admin_panel.index')

@section('content')

<div class="d-flex justify-content-center">


    <div class="card card-primary card-outline col-4 ">
            <div class="card-header text-center">
                <h3><strong> {{$tipoItem->nombre}} Disponibles </strong></h3>
            </div>
    </div>
</div>
<form action="{{ route("pedidos.detalle_pedido") }}" method="POST" enctype="multipart/form-data">
<div class="d-flex row justify-content-center">


            @foreach ($items as $item)
            <form action="{{ route("pedidos.detalle_pedido") }}" method="POST" enctype="multipart/form-data">
                <div class="card m-4" style="width: 20rem;">
                        <input type="hidden" id="item" name="item_id" class="form-control" value="{{$item->id}}">
                        <img class="card-img-top" style="height: 15rem" src="{{asset('imagenes/albergue.jpg')}}" alt="Card image cap">
                        <div class="card-header">
                            <h2 class="card-title"><strong>{{$item->nombre}}</strong></h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                            <span class="badge badge-warning">Capacidad: {{$item->capacidad}}</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                    {{-- <a href="#" class="btn btn-pill btn-success">Reservar &rarr;</a> --}}
                                    <button class=" btn btn-pill btn-success" type="submit">
                                                <i class="fal fa-map-marker mr-2"></i>
                                        Reservar
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
