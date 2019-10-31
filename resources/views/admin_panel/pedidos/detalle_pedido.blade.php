@extends('admin_panel.index')
@section('content')
{{-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 offset-1">
                <a href=" {{ URL::previous() }} " class="btn btn-outline-primary btn-pill">
<b>&larr; Volver </b>
</a>
</div>
</div>
<br> --}}
<div class="d-flex justify-content-between">
    <div class="card shadow-sm" style="width: 20rem;">
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

        </div>
    </div>

    <div class="col-3">
        <form class="" action="{{ route("pedidos.agregar_carrito") }}" method="POST" enctype="multipart/form-data">


            <div class="text-center card card-primary card-outline shadow-sm">
                <div class="card-header">
                    <h4 class="text-center"><strong>Detalles de Pedido</strong></h4>
                </div>

                <div class="card-body box-profile">
                    <ul class="list-group list-group-flush">
                        <div class="d-flex justify-content-between my-auto">
                            <h5><strong> {{$item->nombre}}</strong></h5>

                        </div>
                        <div class="d-flex justify-content-between my-2 border-bottom">
                            @if ($item->tipoItem->nombre == 'Albergues')
                            <label><strong>Precio</strong></label><a> <i class="fal fa-dollar-sign"> </i>
                                {{$item->precioUnitario}}/noche</a>
                            @else
                            <label><strong>Precio</strong></label><a> <i class="fal fa-dollar-sign"> </i>
                                {{$item->precioUnitario}}/hora</a>
                            @endif

                        </div>
                        <strong class="d-flex justify-content-start">Fechas</strong>
                        <div class="d-flex justify-content-between border mt-2">
                            <div class="ml-4">

                                {{\Carbon\Carbon::create($fechaInicial)->format('d/m/Y')}}
                            </div>
                            <div>

                                <i class="fal fa-arrow-right my-auto"></i>
                            </div>
                            <div class="mr-4">

                                {{\Carbon\Carbon::create($fechaFinal)->format('d/m/Y')}}
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <label><strong>TOTAL</strong></label>
                            </label><a> <i class="fas fa-dollar-sign"> </i>
                                <strong>{{$item->precioUnitario * $diferencia}}</strong></a>
                        </div>
                    </ul>
                    <br>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary btn-pill">
                            Agregar
                            <i class="fal fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

            @csrf
            <input type="hidden" id="item" name="item_id" class="form-control" value="{{$item->id}}">
            <input type="hidden" id="fechaInicial" name="fechaInicial" class="form-control" value="{{$fechaInicial}}">
            <input type="hidden" id="fechaFinal" name="fechaFinal" class="form-control" value="{{$fechaFinal}}">
        </form>
    </div>
    <!-- /.card -->
</div>



@endsection
