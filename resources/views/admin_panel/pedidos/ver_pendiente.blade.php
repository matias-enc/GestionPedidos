@extends('admin_panel.index')
@section('content')
<div class="row justify-content-center">
    <div class="col-4">
        <div class="card card-outline card-info shadow-sm">
            <div class="card-header pb-0 pt-2">
                <h4 class="text-center"><strong>Detalle de Pedido</strong></h4>
            </div>
            <div class="card-body ">
                <div class="pl-2">
                    <label><strong>Solicitante:</strong> {{$pedido->usuario->name}}</label><br>
                    <label><strong>Emitido:</strong> {{$pedido->updated_at->format('d/m/Y G:i A')}}</label>

                </div>
                <hr>
                <table class="table">
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


            </div>
            <div class="card-footer bg-white mt-0">
                <div class="pb-0">
                    <label style="font-size: 12px" class="text-monospace text-muted text-center"><strong>*Este Documento
                            debera de ser presentado posteriormente con su firma y
                            aclaracion.</strong></label>
                </div>
                <div class="d-flex justify-content-center pb-2 pt-1">
                    <button class="btn btn-danger "
                        onclick="location.href = '{{ route('pedidos.generar_documentacion' , $pedido) }}'">

                        <i class="fal fa-file-pdf"></i>
                        Generar Documentacion


                    </button>
                </div>
            </div>
        </div>


    </div>
    <div class="col-6 offset-1">
        <div class="card card-outline card-secondary shadow-sm">
            <div class="card-header pb-0 pt-2">
                <h4 class="text-center"><strong>Documentacion</strong></h4>
            </div>
            <div class="card-body">
                <div class="pl-2">
                    <h5><label class="text-justify">En esta seccion debera adjuntar la documentacion generada
                            anteriormente, la cual debe de
                            contar con su firma y aclaracion.</label>
                    </h5>
                    <form action="{{ route("pedidos.generar_pedido") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$pedido->id}}" name="pedido">
                        <div class="d-flex justify-content-center">
                            <div class="row">

                                <label class="btn btn-outline-danger  pb-0" type="none" for="file">
                                    <i class="fas fa-file-upload fa-3x pb-2 animated pulse infinite"></i><br>
                                    <label class="label-input" for="file">Elegir un Documento</label>
                                </label>
                                <input type="file" name="file" id="file" class="inputfile" />

                            </div>


                        </div>

                </div>
                <br>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-secondary btn-lg" type="submit">
                        Enviar Pedido
                        <i class="fal fa-paper-plane"></i>
                    </button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>

</div>


</div>
@endsection
@push('scripts')
<script>
    $('#file').on("change",function(e) {
        $('.label-input').html(e.target.files[0].name);
    });
</script>
@endpush
