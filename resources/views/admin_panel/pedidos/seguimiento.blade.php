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
<div class="container-fluid animated fadeIn">
    @if($pedido->aviso!=null)
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="alert alert-danger alert-dismissible shadow-sm " id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fal fa-info"></i> Informacion!</h5>
                Este pedido ha sido finalizado por el siguiente motivo: {{$pedido->aviso}}
            </div>
        </div>
    </div>
    @endif
    <div class="row ">
        <div class="col-6">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card card-outline card-primary shadow-sm">
                        <div class="card-header pb-0">
                            <h3 class="text-center"><strong>Detalle del Pedido</strong></h3>



                        </div>
                        <div class="card-body p-0 pt-2">
                            <h5 class="profile-username text-center pb-1    "><strong>Estado actual:</strong> <span
                                    class="text-success">{{$pedido->estado->nombre}}</span></h5>
                        </div>
                        <hr class="p-0 m-0">
                        <div class="card-body ">

                            <p class="text-center"><strong> Solicitud Efectuada:</strong>
                                {{ $pedido->getFechaSolicitud()->format('d/m/Y H:i')}}hs</p>
                            <p class="text-center"><strong> Fecha Final Aproximada:</strong>
                                {{ $pedido->getFechaFinal()->format('d/m/Y ')}}</p>


                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-9">
                    @foreach ($pedido->seguimientos as $seguimiento)
                    <div class="card card-outline shadow-sm mb-1 animated fadeInDown">
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
            </div>


        </div>
        <div class="col-6 ">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            </div>
                            <div class="timeline">
                                <div class="time-label">
                                    <span class="bg-secondary" style="color: ">Seguimiento</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                @foreach ($historiales as $historial)
                                @if($historial->estado->nombre != 'Finalizado')
                                <div>
                                    <i class="fas fa-check bg-success"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fal fa-check"></i>
                                            {{$historial->created_at->diffForHumans()}}</span>
                                        <h3 class="timeline-header"><strong>{{$historial->estado->nombre}} </strong>
                                        </h3>

                                    </div>
                                </div>
                                @else
                                <div>
                                    <i class="fas fa-times bg-danger"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fal fa-check"></i>
                                            {{$historial->created_at->diffForHumans()}}</span>
                                        <h3 class="timeline-header"><strong>{{$historial->estado->nombre}} </strong>
                                        </h3>

                                    </div>
                                </div>
                                @endIf

                                <!-- END timeline item -->
                                @endforeach
                                @if($historial->estado->nombre != 'Finalizado')
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>

            <!-- /.timeline -->

        </div>

    </div>
    <!-- /.card-body -->
</div>




@endsection
