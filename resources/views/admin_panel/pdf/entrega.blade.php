@extends('admin_panel.pdf.formatoEnDev')
@section('content')

<div style="padding-top: 10px">
        <h5 style="font-weight: lighter; line-height: 28px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; En el dia de la fecha se hace entrega de

                {{$seguimiento->item->nombre}} para el dia {{$seguimiento->getFechaLlegadaDoc()}}
                @if(sizeof($seguimiento->adicionales)>0)
                , con los adicionales
                @foreach ($seguimiento->adicionales as $adicional)
                    {{$adicional->item->nombre}} ({{$adicional->cantidad}})
                    @if ($adicional == $seguimiento->adicionales->last())
                    @else
                    ,
                    @endif
                @endforeach
                @endif
                en optimas condiciones para su uso,
                a {{$seguimiento->pedido->usuario->apellido}} {{$seguimiento->pedido->usuario->name}}, DNI: {{$seguimiento->pedido->usuario->dni}};
                hasta el dia
                {{$seguimiento->getFechaSalidaDoc()}}.
            </h5>

            <h5 style="float: right; padding-top: 75px; padding-right: 30px; font-weight: lighter; line-height: 28px   ">
                    .............................. <br>
                    {{$seguimiento->pedido->usuario->apellido}}, {{$seguimiento->pedido->usuario->name}} <br>
                     DNI: {{$seguimiento->pedido->usuario->dni}}
                 </h5>
</div>

@endsection
