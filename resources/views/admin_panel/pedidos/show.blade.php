@extends('admin_panel.index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-5">


            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header box-profile">
                    <div class="text-center">
                    </div>
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
                <div class="card-body p-0 pt-2">
                    <h4 class="text-center"><strong>Detalle del Pedido</strong>
                    </h4>
                </div>
                <hr class="p-0 m-0">
                <div class="card-body ">

                    <p class="text-center"><strong> Solicitud Efectuada:</strong>
                        {{ $pedido->getFechaSolicitud()->format('d/m/Y H:i')}}hs</p>
                    <p class="text-center"><strong> Fecha Final Aproximada:</strong>
                        {{ $pedido->getFechaFinal()->format('d/m/Y ')}}</p>

                    @foreach ($pedido->seguimientos as $seguimiento)
                    <div class="card card-outline  shadow-sm mb-1">
                        <div class="card-header pb-0 pt-1">
                            <h5 class="text-center"><strong> {{$seguimiento->item->nombre}}</strong></h5>
                        </div>
                        <div class="card-body">
                            <p class="text-center"><strong>Llegada:</strong>
                                {{$seguimiento->getFechaLlegada()->format('d/m/Y')}}
                                <strong>Salida:</strong> {{$seguimiento->getFechaSalida()->format('d/m/Y')}} </p>

                            @if (sizeof($seguimiento->adicionales)>0)
                            <p class="text-center">Adicionales</p>

                            <div class="row justify-content-center">
                                @foreach ($seguimiento->adicionales as $adicional)
                                <span class="badge-pill badge-info">{{$adicional->item->nombre}}:
                                    {{$adicional->cantidad}}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>

                    </div>
                    @endforeach
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-5 offset-1">


            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        {{-- <img class="profile-user-img img-fluid img-circle"
                                             src="../../dist/img/user4-128x128.jpg"
                                             alt="User profile picture"> --}}
                    </div>

                    <h3 class="profile-username text-center">Historial de Estados</h3>

                    <table id="transicion" class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Asignado Por:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->historiales as $historial)
                            <tr>
                                <td>{{$historial->estado->nombre}}</td>
                                <td>{{$historial->getCreado()->diffForHumans()}}</td>
                                @if ($historial->user_id!=null)
                                <td>{{$historial->usuario->name}}</td>
                                @else
                                <td>Sistema</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
