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
<div class="d-flex justify-content-between animated fadeIn">
    <div class="col-7">
        @if ($tipoItem->nombre == 'Albergues')
        <div class="alert alert-success alert-dismissible  animated fadeInDown shadow-sm">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fal fa-info"></i> Informacion!</h5>
            Las habitaciones de Albergue cuentan con un <strong>Horario de Entrada: 9:00hs AM</strong> y un
            <strong>Horario de Salida: 8:00hs AM</strong>, del dia siguiente.
        </div>
        @endif

        @if(sizeof($items)==0)
        <div class="card shadow-sm card-outline card-primary">
            <input type="hidden" id="item" name="item_id" class="form-control" value="{{$item->id}}">
            {{-- <img class="card-img-top" style="height: 15rem" src="{{asset('imagenes/albergue.jpg')}}" alt="Card
            image cap"> --}}



            <div class="card-header">
                <h2 class="card-title"><strong>{{$item->nombre}}</strong></h2>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="badge badge-warning">Capacidad: {{$item->capacidad}}</span>
                </div>
            </div>
            <div id="carrusel" class="card-img-top carousel slide shadow-none" data-ride="carousel">
                <div class="carousel-inner">
                        @if($item->tipoItem->nombre == 'Albergues')
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{asset('imagenes/albergue.jpg')}}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('imagenes/albergue.jpg')}}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('imagenes/albergue.jpg')}}" alt="Third slide">
                    </div>
                    @endif
                    @if($item->tipoItem->nombre == 'Complejos')
                    <div class="carousel-item active">
                            <img class="d-block w-100" src="{{asset('imagenes/complejo.jpg')}}" alt="First slide">
                        </div>
                    @endif
                    @if($item->tipoItem->nombre == 'Salones de Eventos')
                    <div class="carousel-item active">
                            <img class="d-block w-100" src="{{asset('imagenes/salon.jpg')}}" alt="First slide">
                        </div>
                    @endif
                </div>
                <a class="carousel-control-prev" href="#carrusel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carrusel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
            <div class="card-body">
                <label><strong>{{$item->nombre}}:</strong></label>
                <label>{{$item->descripcion}}</label>
            </div>
        </div>

        @endif
        @if(sizeof($items)>1)
        @foreach ($items as $item)
        <div class="card shadow-sm card-outline card-primary">
            <input type="hidden" id="item" name="item_id" class="form-control" value="{{$item->id}}">

            <div class="card-header">
                <h2 class="card-title"><strong>{{$item->nombre}}</strong></h2>

                <div class="card-tools">
                    <span class="badge badge-warning">Capacidad: {{$item->capacidad}}</span>
                    <a class="btn btn-primary  btn-sm btn-pill" data-toggle="collapse"
                        href="#collapseExample{{$item->id}}" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        Mas Informacion!
                    </a>
                </div>

            </div>
            <div class="collapse" id="collapseExample{{$item->id}}">
                <div id="carrusel" class="card-img-top carousel slide shadow-none" data-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{asset('imagenes/albergue.jpg')}}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('imagenes/albergue.jpg')}}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('imagenes/albergue.jpg')}}" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carrusel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carrusel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
                <div class="card-body">
                    <label><strong>{{$item->nombre}}:</strong></label><br>
                    <label>{{$item->descripcion}}</label>
                </div>
            </div>
        </div>
        @endforeach
        @endif

    </div>
    <div class="col-4">
        <form class="" action="{{ route("pedidos.agregar_carrito") }}" method="POST" enctype="multipart/form-data">
            @foreach ($items as $i)
            <input type="hidden" id="items" name="items_id[]" class="form-control" value="{{$i->id}}">
            @endforeach
            <div class="text-center card card-primary card-outline shadow-sm">
                <div class="card-header">
                    <h4 class="text-center"><strong>Detalles de Pedido</strong></h4>
                </div>

                <div class="card-body box-profile">
                    @if(sizeof($items)>1)
                    <ul class="list-group list-group-flush">
                        <div class="d-flex justify-content-between my-auto">
                            <h5><strong>Paquete de Habitaciones</strong></h5>
                        </div>
                        <div class="d-flex justify-content-between my-2 border-bottom">
                            <label><strong>Habitaciones</strong></label>
                            <label><strong>Precio</strong></label>
                        </div>
                        @foreach ($items as $item)
                        <div class="d-flex justify-content-between my-1">
                            <label class="ml-1"><strong>{{$item->nombre}}</strong></label>
                            <a> <i class="fal fa-dollar-sign"> </i>
                                {{$item->precioUnitario}}/noche</a>
                        </div>
                        @endforeach

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
                                <strong>{{$precioTotal}}</strong></a>
                        </div>
                    </ul>
                    <br>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary btn-pill">
                            Agregar
                            <i class="fal fa-shopping-cart"></i>
                        </button>
                    </div>


                    @else


                    <ul class="list-group list-group-flush">
                        <div class="d-flex justify-content-between my-auto">
                            <h5><strong> {{$item->nombre}}</strong></h5>
                        </div>

                        <div class="d-flex justify-content-between my-2 border-bottom">
                            @if ($item->tipoItem->nombre == 'Albergues')
                            <label><strong>Precio</strong></label><a> <i class="fal fa-dollar-sign"> </i>
                                {{number_format($item->precioUnitario,2)}}/noche</a>
                            @else
                            <label><strong>Precio</strong></label><a> <i class="fal fa-dollar-sign"> </i>
                                {{number_format($item->precioUnitario,2)}}/hora</a>
                            @endif

                        </div>
                        <strong class="d-flex justify-content-start">Fechas</strong>
                        <div class="d-flex justify-content-between border mt-2">
                            <div class="ml-4">

                                {{\Carbon\Carbon::create($fechaInicial)->format('d/m/Y G:i ')}}
                            </div>
                            <div>

                                <i class="fal fa-arrow-right my-auto"></i>
                            </div>
                            <div class="mr-4">

                                {{\Carbon\Carbon::create($fechaFinal)->format('d/m/Y G:i ')}}
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <label><strong>TOTAL</strong></label>
                            </label><a> <i class="fas fa-dollar-sign"> </i>
                                <strong>{{number_format($item->precioUnitario * $diferencia,2)}}</strong></a>
                        </div>
                    </ul>
                    <br>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary btn-pill">
                            Agregar
                            <i class="fal fa-shopping-cart"></i>
                        </button>
                    </div>
                    @endif
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
