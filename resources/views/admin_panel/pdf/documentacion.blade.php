@extends('admin_panel.pdf.layout')
@section('content')

<br>
<div class="row" style="margin-bottom: 5px">
    <h5 class="text-center"><strong>Items Solicitados</strong></h5>
</div>
<table >
    <thead>
        <tr>
            <th>Item</th>
            <th style="text-align: end">Precio</th>
        </tr>
    </thead>



    <tbody>
        @foreach ($pedido->seguimientos as $seguimiento)
        <tr>
            <td>{{$seguimiento->item->nombre}}</td>
            <td align="right">${{$seguimiento->getCalculoPrecio()}}</td>
        </tr>

        @endforeach
    </tbody>

</table>
@if ($pedido->cantidadAdicionales()>0)
<table>
    <thead>
        <tr>
            <th>Adicionales</th>
            <th style="text-align: end">Precio</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pedido->seguimientos as $seguimiento)
        @foreach ($seguimiento->adicionales as $adicional)
        <tr>
            <td>{{$adicional->item->nombre}}<label class="text-muted">({{$seguimiento->item->nombre}})</label></td>
            <td style="text-align: end">{{$adicional->getCalculoPrecio()}}</td>
        </tr>
        @endforeach
        @endforeach
    </tbody>
</table>
@endif
<hr class="mt-0 mb-1 border-dark">
<table>

        <tr>
            <th>
                TOTAL
            </th>
            <th >
                ${{$pedido->getPrecioTotal()}}
            </th>
        </tr>
</table>



@endsection
