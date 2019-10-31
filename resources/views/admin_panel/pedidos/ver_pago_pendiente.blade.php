@extends('admin_panel.index')
@section('content')
<div class="row justify-content-center">

    <div class="col-4">
        <div class="card card-outline card-primary shadow-sm" style="border-radius: 0%">
            <div class="card-body ">
                <h4 class="text-center"><strong>Detalle de Pedido</strong></h4>
                <hr>
                <div class="pl-2">
                    <label><strong>Solicitante:</strong> {{$pedido->usuario->name}}</label><br>
                    <label><strong>Emitido:</strong> {{$pedido->updated_at->format('d/m/Y G:i A')}}</label>
                    <label><strong>Fecha de Entrada:</strong>
                        {{$pedido->getFechaInicial()->format('d/m/Y G:i A')}}</label>
                    <label><strong>Fecha de Salida:</strong> {{$pedido->getFechaFinal()->format('d/m/Y G:i A')}}</label>

                </div>
                <hr class="py-0">
                <table class="table mt-0">
                    <thead class="mt-0">
                        <tr>
                            <th>Solicitado</th>
                            <th style="text-align: end">Precio</th>
                        </tr>
                    </thead>



                    <tbody>
                        @foreach ($pedido->seguimientos as $seguimiento)
                        <tr>
                            <td>{{$seguimiento->item->nombre}}</td>
                            <td style="text-align: end">${{$seguimiento->getCalculoPrecio()}}</td>
                        </tr>

                        @endforeach
                    </tbody>



                </table>
                @if ($pedido->cantidadAdicionales()>0)


                <table class="table">
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
                            <td>{{$adicional->item->nombre}}<label
                                    class="text-muted">({{$seguimiento->item->nombre}})</label></td>
                            <td style="text-align: end">${{$adicional->getCalculoPrecio()}}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
                @endif
                <hr class="mt-0 mb-1 border-dark">
                <div class="row justify-content-between ml-3 mr-2 pb-0 mb-0">
                    <label>
                        <h5><strong>TOTAL</strong></h5>
                    </label>
                    <label>
                        <h5><strong>${{$pedido->getPrecioTotal()}}</strong></h5>
                    </label>
                </div>

                <br>
                {{-- {{dd($preference)}} --}}
                <div class="row justify-content-center">
                    <a href="{{$preference->sandbox_init_point}}" class="btn btn-lg btn-primary">
                        <i class="fal fa-credit-card"></i>
                        Iniciar Pago</a>
                </div>
            </div>
        </div>


    </div>
    <div class="col-5 offset-1">
        <div class="card">
            {{-- <div class="card-header pb-0 pt-2">
                <h4 class="text-center"><strong>Metodo de Pago</strong></h4>
            </div> --}}
            <div class="card-body">
                <div class="pl-2">
                    <img src="{{asset('imagenes/mercadopago-logo.png')}}" class="img-fluid" alt="Responsive image">
                    <hr>
                    <label class="text-justify">  Para la realizacion y control de los pagos contamos con el servicio
                            de <strong>MercadoPago</strong>, todo esto con el fin de brindarle mayor seguridad y transparencia a la hora
                            de realizar sus Pagos.</label>
                </div>

            </div>
        </div>
    </div>

</div>


</div>
@endsection
