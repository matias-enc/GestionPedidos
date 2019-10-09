@extends('admin_panel.index')
@section('content')
<div class="row justify-content-start">
    <div class="col-4">
        <div class="card card-outline card-primary">
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
    <div class="col-4 offset-1">
        <div class="card card-outline card-primary">

        </div>
    </div>
</div>



@endsection
