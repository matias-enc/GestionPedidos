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
        <div class="d-flex row justify-content-center">
                <div class="card mr-5" style="width: 20rem;">
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




            <form action="{{ route("pedidos.confirmar_pedido") }}" method="POST" enctype="multipart/form-data">
                <div class="ml-5 card card-primary card-outline offset-1">
                    <div class="card-header">
                            <h2 class="card-title text-center"><strong>Detalles de Pedido</strong></h2>
                            <div class="card-tools">
                            </div>
                        </div>

                    <div class="card-body box-profile">
                            <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nombre: </strong>{{$item->nombre}}</li>
                                    <li class="list-group-item"><strong>Llegada </strong>{{$fechaInicial}}</li>
                                    <li class="list-group-item"><strong>Salida </strong>{{$fechaFinal}}</li>
                                </ul>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary btn-pill">
                                        <i class="fal fa-plus"></i>
                                        Solicitar
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
                              <!-- /.card -->
        </div>



@endsection
