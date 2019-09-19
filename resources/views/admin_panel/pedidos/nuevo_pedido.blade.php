@extends('admin_panel.index')
@section('content')
    <div class="container">
                    <form action="{{ route("pedidos.consultar_disponibilidad") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                                {{-- <nuevo_pedido>
                                </nuevo_pedido> --}}
                                <br>
                                <div class="card card-outline card-primary col-5 offset-3">
                                    <div class="card-header text-center">
                                        <div class="card-title">
                                            <h3><strong>Realizar un Nuevo Pedido</strong></h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <strong><Label>Categoria</Label></strong>
                                        <div class="form-group">
                                            <div class="form-group {{ $errors->has('tipoItem') ? 'has-error' : '' }}">
                                                <select name="tipoItem" id="tipoItem" class="estados-js form-control" onchange="d1(this)" required>
                                                    <option value="" selected disabled>Seleccione una Categoria</option>
                                                    @foreach($tipoItems as $tipo)
                                                        <option  placeholder="Categoria"  value="{{ $tipo->id }}" >{{ $tipo->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @foreach ($tipoItems as $id => $tipoItem)

                                            @if($tipoItem->nombre=='Secundarios')

                                            <div class="form-group" id="prg1" style="display:none">
                                                <strong><Label>Seleccione un Item</Label></strong>
                                                <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                                                    <select name="itemSecundario"   class="estados-js form-control"  required>
                                                        @foreach($tipoItem->items as $tipo)
                                                            <option  placeholder="Categoria"  value="{{ $tipo->id }}" >{{ $tipo->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                        @endforeach

                                        <div class="d-flex justify-content-between">
                                            <strong><Label>Llegada</Label></strong>
                                            <strong><Label>Salida</Label></strong>
                                        </div>
                                        <div class="input-group input-daterange" id="datepicker" data-date-format="dd/mm/yyyy" data-date-container='#datepicker'>
                                            <input type="text" class="input-sm form-control {{ $errors->has('inicial') ? 'is-invalid' : ''}}" name="inicial" placeholder="Llegada"/>
                                            <input type="text" class="input-sm form-control {{ $errors->has('inicial') ? 'is-invalid' : '' }}" name="final" placeholder="Salida" />
                                        </div>
                                        <br>
                                            <div class="form-group" id="cant"   style="display:none" class="m-1">
                                                <strong><Label>Cantidad de Huespedes</Label></strong>
                                                <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                                                        <input class="input-sm form-control " type="number" name="capacidad">
                                                </div>
                                            </div>
                                        <br>
                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-pill btn-success" type="submit" value="Consultar Disponibilidad">
                                        </div>
                                    </div>
                                </div>
                                <br>
                    </form>

        </div>


    </div>
@endsection
@push('scripts')
<script>
    $('#datepicker').datepicker({
        weekStart: 1,
        startDate: "today",
        endDate: "1/1/2021",
        language: "es",
        todayHighlight: true,
    });
</script>
<script language="javascript" type="text/javascript">
    function d1(selectTag){
     if(selectTag.value == 4){
    document.getElementById('prg1').style.display = "block";
     }else{
     document.getElementById('prg1').style.display = "none";
     }
     if(selectTag.value == 3){
        document.getElementById('cant').style.display = "block";
    }else{
    document.getElementById('cant').style.display = "none";
    }
    }
    </script>
@endpush
