@extends('admin_panel.index')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-small card-outline card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3><strong>Elementos en Carrito ( {{sizeof($pedido->seguimientos)}} )</strong></h3>

                </div>
            </div>

            <div class="card-body">
                <div class="row"></div>

                @foreach ($pedido->seguimientos as $seguimiento)

                <div class="card card-small border shadow-sm">
                    <div class="card-header">
                        <h5><strong>Item:</strong> {{$seguimiento->item->nombre}}</h5>

                    </div>
                    <div class="card-body">


                        <div class="row justify-content-between">
                            <div class="col justify-content-start my-auto">
                                <p><strong>Llegada:</strong> {{$seguimiento->getFechaLlegada()}}</p>
                                <p><strong>Salida:</strong> {{$seguimiento->getFechaSalida()}}</p>
                            </div>
                            <div class="col justify-content-center my-auto">
                                <button type="button" class="btn btn-outline-primary btn-pill btn-xs"
                                    data-toggle="modal" data-target="#exampleModalScrollable{{ $seguimiento->id }}">
                                    <i class="fal fa-plus"></i> Adicional
                                </button>
                            </div>
                            <div class=" col my-auto ml-auto ">

                                <form action="{{ route('pedidos.eliminar_seguimiento', $seguimiento) }}" method="POST"
                                    onsubmit="return confirm('Esta seguro que desea borrar el item: {{$seguimiento->item->nombre}}?');"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-white btn-sm bg-danger" type="submit">
                                        <i class="far fa-times mr-1"></i> Eliminar
                                    </button>
                                </form>
                            </div>


                        </div>
                        <br>
                        @if (sizeof($seguimiento->adicionales)!=0)
                        <h5><strong>Adicionales</strong>:</h5>
                        <div class="row justify-content-center ">
                            @foreach ($seguimiento->adicionales as $adicional)
                            <div class="card card-small col-lg-9 border shadow-sm">
                                <div class="card-body row">
                                    <div class="d-flex flex-column justify-content-start mt-auto mb-auto">
                                        <i class="far fa-circle fa-xs" style="color:black">

                                        </i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center ml-3">
                                        <span class="card-post__author-name">{{$adicional->item->nombre}}</span>
                                        <small class="text-muted">Cantidad: {{$adicional->cantidad}}</small>
                                    </div>
                                    <div class="my-auto ml-auto ">
                                        <form id="form-adicional" action="{{ route('pedidos.eliminar_adicional', $adicional) }}"
                                            method="POST"

                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-white btn-sm btn-pill border" id="btn-borrar" type="submit">
                                                <i class="far fa-times mr-1"></i> Eliminar </a>
                                            </button>
                                        </form>
                                    </div>
                                </div>


                            </div>

                            @endforeach


                        </div>
                        @endif
                    </div>

                </div>


                <!-- Button trigger modal -->


                <!-- Modal -->

                <form action="{{ route("pedidos.disponibilidad_secundarios") }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal fade" id="exampleModalScrollable{{$seguimiento->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">


                                <input type="hidden" name="seguimiento" value="{{$seguimiento->id}}">
                                <div class="modal-header">

                                    <h4 class="modal-title" id="exampleModalScrollableTitle"><strong>Agregar un Item
                                            Adicional a
                                            {{ $seguimiento->item->nombre }}</strong></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex">
                                        <div class="col-lg-6">
                                            <strong><Label>Tipo de Item Adicional</Label></strong>
                                            <select id="item_id"
                                                class="estados-js form-control {{ $errors->has('item_id') ? 'is-invalid' : '' }}"
                                                name="item_id">
                                                <option value="" disabled selected style="">Seleccione un Item</option>
                                                @foreach ($secundarios as $item)
                                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <strong><Label>Cantidad</Label></strong>
                                            <div
                                                class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                                                <input class="input-sm form-control " type="number" name="cantidad">
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button class="btn btn-pill btn-success" type="submit">Consultar!</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                @endforeach

                <div class="d-flex justify-content-end">
                    <button class="btn btn-success btn-pill btn-lg"
                        onclick="location.href = '{{ route('pedidos.confirmar_pedido' , $pedido) }}'">
                        Confirmar Pedido
                        <i class="fal fa-check"></i>

                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
 $('#btn-borrar').on('click', function(e){
    e.preventDefault();

swal({
        title: "Cuidado!",
        text: "Esta seguro que desea eliminar?",
        icon: "warning",
        dangerMode: true,

        buttons: {
        cancel: "Cancelar",
        confirm: "Aceptar",
        },
        customClass: {
            confirmButton: 'btn-primary',
        },
    })
    .then ((willDelete) => {
        if (willDelete) {
        $("#form-adicional").submit();
        }
    });
 });
</script>
@endpush
