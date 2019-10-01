@extends('admin_panel.pdf.layout')
@section('content')
<div class="" style="padding-left: 5%; font-size: 15px" >
        @if ($usuario!=null || $item!=null || $estado!=null)
        <div class="row" style="margin-top: 0%; margin-bottom: 0px">
            <strong>Filtros Utilizados</strong>

        </div>

        @endif
        @if ($usuario!=null)
        <div style="padding-bottom: 0px; margin-top: 0px; font-size: 12px">
            <strong>*Por Usuario:</strong> {{$usuario->name}}

        </div>
        @endif
        @if ($item!=null)
        <div style="padding-bottom: 0px; margin-top: 0px; font-size: 12px">
            <strong>*Por Item:</strong> {{$item->nombre}}

        </div>
        @endif
        @if ($estado!=null)
        <div style="padding-bottom: 0px; margin-top: 0px; font-size: 12px">
            <strong>*Por Estado:</strong> {{$estado->nombre}}

        </div>
        @endif
</div>
<br>
<div class="row" style="margin-bottom: 5px">
    <h5 class="text-center"><strong>Reporte de Pedidos</strong></h5>
</div>
<div style="font-size: 12px; margin-left: 10px; margin-bottom: 5px">

    Registros Totales Encontrados: {{ sizeof($pedidos)}}
</div>
<div class="table">
    <table id="pedidos" class="table table-bordered">
        <thead>
            <tr style="line-height: 14px; background: lightgrey" >
                <th>Usuario</th>
                <th>Items</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
            <tr style="line-height: 12px">
                <td>
                    <span>{{ $pedido->usuario->name }}</span>
                </td>
                <td>
                    @foreach ($pedido->seguimientos as $seguimiento)
                    <span>{{ $seguimiento->item->nombre }}</span>
                    @endforeach
                </td>
                <td>
                    <span>{{ $pedido->estado->nombre }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
