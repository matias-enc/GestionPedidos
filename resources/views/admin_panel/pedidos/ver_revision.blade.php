@extends('admin_panel.index')
@section('content')
<div class="row justify-content-start">
    <div class="col-6">
        <div class="row justify-content-center">

            <div class="col-8">
                <div class="card card-outline card-primary card-small shadow-sm">
                    <div class="card-header pb-0">
                        <h3><strong>Historial de Observaciones</strong></h3>
                    </div>
                    <div class="card-body">
                        @foreach ($pedido->seguimientos as $seguimiento)
                        <div class="card card-primary shadow-sm border-primary">
                            <div class="card-header">
                                <h4 class="text-center"><strong>{{$seguimiento->item->nombre}}</strong></h4>
                            </div>
                            <div class="card-body">
                                @if (sizeof($seguimiento->historiales->where('revision', '!=', null))>0)


                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Revision</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($seguimiento->historiales as $historial)
                                        @if ($historial->revision!=null)
                                        <tr>
                                            <td><label>{{$historial->revision}}</label></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr></tr>
                                    </tbody>
                                </table>

                                @else
                                <div class="d-flex justify-content-center">
                                    <h5><strong>No presenta Observaciones a la hora de Finalizacion!</strong></h5>
                                </div>
                                @endif

                            </div>
                            @if (sizeof($seguimiento->adicionales)>0)
                            <h5 class="text-center mb-0 bg-info pt-2 pb-2"><strong>Adicionales de
                                    {{$seguimiento->item->nombre}}</strong></h5>
                            <div class="card-body">



                                @foreach ($seguimiento->adicionales as $adicional)



                                <div class="card card-outline card-info card-small shadow-none">
                                    <div class="card-header pb-0">
                                        <h5><strong>{{$adicional->item->nombre}}</strong></h5>
                                    </div>
                                    <div class="card-body">
                                        @if (sizeof($adicional->historiales->where('revision', '!=', null))>0)
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>Revision</th>
                                                    <th class="text-center">Faltante</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($adicional->historiales as $id => $historial )

                                                @if ($historial->revision!=null)
                                                <tr>
                                                    <td><label class="text-muted">{{$historial->revision}}</label></td>
                                                    <td class="text-center">@if ($historial->faltante!=null)
                                                        <label class="text-muted ">{{($historial->faltante)}}</label>
                                                        @else
                                                        -
                                                        @endif</td>
                                                </tr>
                                                @endif


                                                @endforeach
                                            </tbody>
                                        </table>
                                        @else
                                        <div class="d-flex">
                                            <h5>No presenta Observaciones a la Hora de la Devolucion!</h5>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card card-outline card-primary card-small shadow-sm ">
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
                        <h4 class="mb-3 text-center"><strong class="border-bottom border-dark">Detalle del
                                Pedido:</strong>
                        </h4>
                        <p class="text-center"><strong> Pedido Finalizado:</strong>
                            {{ $pedido->getFechaSolicitud()->format('d/m/Y H:i')}}hs</p>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="col-12">
            <div class="card  card-small shadow-sm ">
                {{-- <div class="card-header pb-0">
                    <h3><strong>Valoracion hacia el Usuario</strong></h3>
                </div> --}}
                <form action="{{ route("pedidos.procesar_revision") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pedido" value="{{$pedido->id}}">
                    <div class="card-body">
                        <div class="row mt-1">
                            <h4 class="text-center"> <strong>Calificación del usuario en base a las
                                    Observaciones</strong>
                            </h4>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <div class="col">
                                <div class="row justify-content-center">
                                    <i class="fal fa-angry fa-2x "
                                        style="background: red; border-radius: 50%; line-height: 98%"></i>
                                </div>
                                <div class="row justify-content-center">
                                    <label class="" style="font-size: 12px">Muy Mala</label>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="1" name="calificacion"
                                            value="1">
                                        <label class="custom-control-label" for="1"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div>
                                    <div class="row justify-content-center">
                                        <i class="fal fa-frown fa-2x "
                                            style="background: orange; border-radius: 50%; line-height: 98%"></i>
                                    </div>
                                    <div class="row justify-content-center">
                                        <label class="" style="font-size: 12px">Mala</label>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="2" name="calificacion"
                                            value="2">
                                        <label class="custom-control-label" for="2"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <i class="fal fa-meh fa-2x  "
                                        style="background: yellow; border-radius: 50%; line-height: 98%"></i>
                                </div>
                                <div class="row justify-content-center">
                                    <label class="" style="font-size: 12px">Regular</label>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="3" name="calificacion"
                                            value="3">
                                        <label class="custom-control-label" for="3"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <i class="fal fa-smile fa-2x  "
                                        style="background: #0fbe6c; border-radius: 50%; line-height: 98%"></i>
                                </div>
                                <div class="row justify-content-center">
                                    <label class="" style="font-size: 12px">Buena</label>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="4" name="calificacion"
                                            value="4">
                                        <label class="custom-control-label" for="4"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <i class="fal fa-laugh fa-2x  "
                                        style="background: #188a66; border-radius: 50%; line-height: 98%"></i>
                                </div>
                                <div class="row justify-content-center">
                                    <label class="" style="font-size: 12px">Muy Buena</label>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="5" name="calificacion"
                                            value="5">
                                        <label class="custom-control-label" for="5"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-end">
                                <button class="btn btn-success btn-pill shadow-sm " data-toggle="modal"
                                data-target="#seguimiento{{$seguimiento->id}}"
                                type="submit">Enviar</button>
                        </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>

</div>





@endsection
