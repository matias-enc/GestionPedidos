@extends('admin_panel.index')

@section('content')
<div class="row justify-content-center">


    <div class="col-10">

        <div class="card card-small card-outline card-primary shadow-sm">
            <div class="card-header pb-0">
                <h3><strong>Pedido ID: {{$auditoria->auditable_id}}</strong></h3>
            </div>
            <div class="card-body box-profile">
                <div class="row">
                    <div class="col-md-4">
                        <label for=""><strong>Tabla</strong></label>
                        <p>Pedidos</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for=""><strong>Usuario</strong></label>
                        <p> {{$auditoria->user->name}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for=""><strong>Accion</strong></label>
                        <p>{{ strtoupper($auditoria->event) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for=""><strong>Fecha y Hora</strong></label>
                        <p>{{$auditoria->created_at->format('d/m/Y H:i:s')}}</p>
                    </div>
                </div>

                <br>
                <div class="card card-body shadow-none card-small p-0">


                    <table class="table">
                        <thead>
                            <tr>
                                <th>Campos</th>
                                <th style="text-align: center">Datos Actuales</th>
                                <th style="text-align: center">Datos Historicos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($auditoria->getModified() as $attribute => $modified)

                            <tr>
                                <td style="text-justify: auto">
                                    {{$attribute}}
                                </td>

                                <td style="text-align: center">
                                    @if(!empty($auditoria->new_values))
                                    {{$auditoria->new_values[$attribute]}}
                                    @else
                                    -
                                    @endif
                                </td>

                                <td style="text-align: center">
                                    @if(!empty($auditoria->old_values))
                                    {{$auditoria->old_values[$attribute]}}
                                    @else
                                    -
                                    @endif
                                </td>
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
