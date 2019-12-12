@extends('admin_panel.pdf.formatoDoc')
@section('content')

{{-- <div style="padding-top: 55px; padding-left: 55px; padding-right: 55px"> --}}
<div style="padding-top: 10px">
    <h5 style="font-weight: lighter; line-height: 28px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Me
        dirijo a Ud. a
        efectos de solicitar @foreach ($pedido->seguimientos as $seguimiento)
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
        hasta el dia
        {{$seguimiento->getFechaSalidaDoc()}}
        @if ($seguimiento == $pedido->seguimientos->last())
        .
        @else
        ;
        @endif
        @endforeach

    </h5>
    <h5 style="font-weight: lighter; padding-left: 35px">Sin otro particular saludamos a Ud. muy atentamente.</h5>
    <h5 style="float: right; padding-top: 75px; padding-right: 30px; font-weight: lighter; line-height: 28px   ">
       .............................. <br>
       {{auth()->user()->apellido}}, {{auth()->user()->name}} <br>
        DNI: {{auth()->user()->dni}}
    </h5>
</div>

@endsection
