@extends('admin_panel.pdf.layout')
@section('content')
<div class="" style="padding-left: 5%; font-size: 15px">
    @if ($usuario!=null || $operacion!=null || $llegada!=null)
    <div class="row" style="margin-top: 0%; margin-bottom: 0px">
        <strong>Filtros Utilizados</strong>

    </div>

    @endif
    @if ($usuario!=null)
    <div style="padding-bottom: 0px; margin-top: 0px; font-size: 12px">
        <strong>*Por Usuario:</strong> {{$usuario->name}}

    </div>
    @endif
    @if ($operacion!=null)
    <div style="padding-bottom: 0px; margin-top: 0px; font-size: 12px">
        <strong>*Por Operacion:</strong> {{strtoupper($operacion)}}

    </div>
    @endif
    @if ($llegada!=null)
    <div style="padding-bottom: 0px; margin-top: 0px; font-size: 12px">
        <strong>*Fecha Inicial:</strong> {{$llegada}} <strong> *Fecha Final:</strong> {{$salida}}

    </div>
    @endif
</div>
<br>
<div class="row" style="margin-bottom: 5px">
    <h5 class="text-center"><strong>Reporte de Auditorias</strong></h5>
</div>
<div style="font-size: 12px; margin-left: 10px; margin-bottom: 5px">

    Registros Totales Encontrados: {{ sizeof($auditorias)}}
</div>
<div class="table">
    <table id="auditorias" class="table table-bordered">
        <thead>
            <tr style="line-height: 14px; background: lightgrey">
                    <th style="text-align: center">IDº</th>
                    <th style="text-align: center">Tabla</th>
                    <th style="text-align: center">Operacion</th>
                    <th style="text-align: center">Fecha</th>
                    <th style="text-align: center">Hora</th>
                    <th style="text-align: center">Usuario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auditorias as $auditoria)
            <tr style="line-height: 12px">
                    <td style="text-align: center">{{$auditoria->auditable_id}}</td>
                    <td style="text-align: center">PEDIDOS</td>
                    <td style="text-align: center; text-transform:uppercase">{{$auditoria->event}}</td>
                    <td style="text-align: center">{{$auditoria->created_at->format('d/m/Y')}}</td>
                    <td style="text-align: center">{{$auditoria->created_at->format('H:i:s')}}</td>
                    <td style="text-align: center">{{strtoupper($auditoria->user->name)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
