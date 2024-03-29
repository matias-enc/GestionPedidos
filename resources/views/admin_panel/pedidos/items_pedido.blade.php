@extends('admin_panel.index')
@section('content')
<div class="row animated fadeIn">

    <div class="col-7">


        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card card-small card-outline">
                    <div class="card-header pb-0 pt-2">

                        <div class="d-flex justify-content-between">
                            <h4><strong>Elementos en Carrito ( {{sizeof($pedido->seguimientos)}} )</strong></h4>

                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row"></div>

                        @foreach ($pedido->seguimientos as $seguimiento)

                        <div class="card card-small border shadow-sm">
                            <div class="card-header pb-0 pt-2">
                                <h5><strong>{{$seguimiento->item->nombre}}</strong></h5>

                            </div>
                            <div class="card-body">



                                <div class="d-flex justify-content-start">
                                    <strong>Fechas</strong>
                                </div>
                                <div class="d-flex justify-content-between">

                                    <div class="d-flex justify-content-between py-1  border">

                                        <div class="d-flex justify-content-between">
                                            <div class="pr-2 ml-1">
                                                {{$seguimiento->getFechaLlegada()->format('d/m/Y G:i ')}}
                                            </div>
                                            <div>
                                                <i class="fas fa-arrow-right my-auto"></i>
                                            </div>
                                            <div class="pl-2 mr-1">
                                                {{$seguimiento->getFechaSalida()->format('d/m/Y G:i ')}}
                                            </div>
                                        </div>

                                    </div>
                                    @if ($seguimiento->item->tipoItem->adicional==true)
                                    <div class="col justify-content-center my-auto">
                                        <button type="button" class="btn btn-white btn-sm btn-pill btn-outline-primary"
                                            data-toggle="modal"
                                            data-target="#exampleModalScrollable{{ $seguimiento->id }}"
                                            data-toggle="tooltip" data-placement="bottom"
                                            title="Añadir un Elemento adicional a {{$seguimiento->item->nombre}}">
                                            <i class="fal fa-plus"></i> Adicional
                                        </button>
                                    </div>
                                    @endif

                                    <div class=" my-auto mr-2">

                                        <form action="{{ route('pedidos.eliminar_seguimiento', $seguimiento) }}"
                                            method="POST" id="form-seguimiento{{$seguimiento->id}}"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-white btn-sm btn-pill bg-danger btn-seguimiento"
                                                id="{{$seguimiento->id}}" type="submit">
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
                                                <form id="form-adicional{{$adicional->id}}"
                                                    action="{{ route('pedidos.eliminar_adicional', $adicional) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-white btn-sm btn-pill border btn-adicional"
                                                        id="{{$adicional->id}}" type="submit">
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

                        @endforeach
                        <!-- Button trigger modal -->


                        <!-- Modal -->






                    </div>

                </div>
            </div>
        </div>


    </div>

    <div class="col-4 animated fadeInDown">
        <div class="card card-outline card-primary card-small shadow-sm">

            <div class="card-header pb-0 pt-2">
                <h3 class="text-center"><strong>Detalle de Pedido</strong></h3>
            </div>
            <div class="card-body ">
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
                            <td style="text-align: end">${{number_format($seguimiento->getCalculoPrecio(),2)}}</td>
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
                            <td style="text-align: end">${{number_format($adicional->getCalculoPrecio(),2)}}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
                @endif
                <hr class="mt-0 mb-1 border-dark">
                <div class="row justify-content-between ml-3 mr-2">
                    <label>
                        <h5><strong>TOTAL</strong></h5>
                    </label>
                    <label>
                        <h5><strong>${{number_format($pedido->getPrecioTotal(),2)}}</strong></h5>
                    </label>
                </div>
                <br>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary btn-lg btn-pill"
                        onclick="location.href = '{{ route('pedidos.confirmar_pedido' , $pedido) }}'">
                        Confirmar Pedido
                        <i class="fal fa-check"></i>

                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@foreach ($pedido->seguimientos as $seguimiento)
    <form action="{{ route("pedidos.disponibilidad_secundarios") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModalScrollable{{$seguimiento->id}}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">


                    <input type="hidden" name="seguimiento" value="{{$seguimiento->id}}">
                    <div class="modal-header">

                        <h4 class="modal-title" id="exampleModalScrollableTitle"><strong>Agregar un
                                Item
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
                                    <option value="" disabled selected style="">Seleccione un Item
                                    </option>
                                    @foreach ($secundarios as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <strong><Label>Cantidad</Label></strong>
                                <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                                    <input class="input-sm form-control " type="number" name="cantidad">
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer justify-content-end">
                        <button class="btn btn-pill btn-primary" type="submit">Asignar</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    @endforeach
@endsection
@push('scripts')
<script>
    const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-pill btn-success pl-4 pr-4 btn-lg ml-4 mr-4',
    cancelButton: 'btn btn-pill btn-danger pl-4 pr-4 btn-lg ml-4 mr-4'
  },
  buttonsStyling: false
})
</script>
<script>
    $('.btn-adicional').on('click', function(e){
        var id = $(this).attr('id');
    e.preventDefault();
    swalWithBootstrapButtons.fire({
        title: "Cuidado!",
        text: "Esta seguro que desea eliminar?",
        type: "warning",
        showCancelButton:true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    })
    .then ((willDelete) => {
        if (willDelete.value) {
        $("#form-adicional"+id).submit();
        }
    });
 });
</script>
<script>
    $('.btn-seguimiento').on('click', function(e){
        var id = $(this).attr('id');
    e.preventDefault();




swalWithBootstrapButtons.fire({
        title: "Cuidado!",
        text: "Esta seguro que desea eliminar?",
        type: "warning",
        showCancelButton:true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    })
    .then ((willDelete) => {
        if (willDelete.value) {
        $("#form-seguimiento"+id).submit();
        }
    });
 });
</script>
@endpush
