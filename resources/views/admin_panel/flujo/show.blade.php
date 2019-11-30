@extends('admin_panel.index')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="row justify-content-center">
                <div class="card card-primary card-outline h-100">
                    <div class="card-body box-profile pl-0 pr-0 pb-2">
                        <div class=" pl-4 pr-4">
                            <h3 class="profile-username text-center">{{$flujo->nombre}}</h3>
                            <p class="text-muted text-center">Nombre del Flujo de Trabajo</p>

                        </div>
                        <hr>
                        <div class="mb-0 pl-4 pr-4">
                            @if ($uso==true)
                            <h3 class="profile-username text-center">Estado: <strong class="text-success">En
                                    Uso</strong></h3>
                            @else
                            <h3 class="profile-username text-center">Estado: <strong class="text-danger">Sin
                                    Uso</strong></h3>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>

        <div class="col-8">
            <div class="row justify-content-center">
                @if ($uso==true)
                <div class="col-9 animated fadeInDown">
                    <div class="alert alert-primary alert-dismissible shadow-sm" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fal fa-info"></i> Informacion!</h5>
                        Este flujo de trabajo se encuentra en un estado activo, por lo que no podra realizar
                        modificaciones en el mismo.
                    </div>
                </div>
                @endif

                <div class="col-10">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="text-center">
                            </div>

                            <h3 class="profile-username text-center pb-2">Transiciones</h3>

                            <div class="card card-body card-small p-0  shadow-none ">
                                <table id="transiciones" class="table">
                                    <thead>
                                        <tr>
                                            <th>Estado</th>
                                            <th class="text-center">Paso Inicial</th>
                                            <th class="text-center">Paso Final</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($flujo->transiciones as $tran)
                                        <tr>
                                            <td>{{$tran->nombre}}</td>
                                            <td class="text-center">{{$tran->estadoInicial->nombre}}</td>
                                            <td class="text-center">{{$tran->estadoFinal->nombre}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                @if ($uso==true)
                                <a href="{{ route('workflow.flujos.asignarTransiciones', $flujo->id) }}"
                                    class="btn btn-primary btn-pill disabled"><b>Asignar Transiciones &rarr;</b></a>
                                @else
                                <a href="{{ route('workflow.flujos.asignarTransiciones', $flujo->id) }}"
                                    class="btn btn-primary btn-pill"><b>Asignar Transiciones &rarr;</b></a>
                                @endif

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>



@endsection
