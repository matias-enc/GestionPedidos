@extends('admin_panel.index')
@section('content')
<div class="container">
    <form action="{{ route("pedidos.consultar_disponibilidad") }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row justify-content-center animated fadeIn">


            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header text-center">
                    <div class="card-title">
                        <h3><strong>Realizar un Nuevo Pedido</strong></h3>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
                    <strong><Label>Categoria</Label></strong>
                    <select name=categorias id="categorias" class="estados-js form-control" onchange="d1(this)"
                        required>
                        <option value="" disabled selected style="">Seleccione una Categoria</option>
                        @foreach($categorias as $categoria)
                        <option placeholder="Categoria" value="{{ $categoria->id }}"
                            {{ old('categorias') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('descripcion'))
                    <p class="help-block">
                        {{ $errors->first('descripcion') }}
                    </p>
                    @endif
                </div> --}}


                {{-- @foreach($categorias as $id => $categoria) id="{{$categoria->id}}"--}}
                <div class="form-group ">


                    <strong><Label>CATEGORIA</Label></strong>
                    <select id="tipoItem"
                        class="estados-js form-control {{ $errors->has('tipoItem') ? 'is-invalid' : '' }}"
                        name="tipoItem" onchange="d1(this)">
                        <option value="" disabled selected style="">Seleccione un Tipo</option>
                        @foreach ($tipoItems as $tipoItem)
                        <option placeholder="Categoria" value="{{ $tipoItem->id }}"
                            {{ old('tipoItem') == $tipoItem->id ? 'selected' : '' }}>{{ $tipoItem->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- @endforeach --}}
                <div id="fechas" class="mb-3">
                    <div class="d-flex justify-content-between">
                        <strong><Label>LLEGADA</Label></strong>
                        <strong><Label id="salida">SALIDA</Label></strong>
                    </div>
                    <div class="input-group input-daterange" id="datepicker" data-date-format="dd/mm/yyyy"
                        data-date-container='#datepicker'>
                        <input type="text"
                            class="input-sm form-control {{ $errors->has('inicial') ? 'is-invalid' : ''}}"
                            name="inicial" placeholder="Llegada" value="{{old('inicial')}}" }} />
                        <input type="text" id="final"
                            class="input-sm form-control {{ $errors->has('final') ? 'is-invalid' : '' }}" name="final"
                            placeholder="Salida" value="{{ old('final') }}" />
                    </div>
                </div>

                <div id="capacidad" class="mt-1 mb-1" style="visibility: hidden; display: none">
                        <strong><Label cla>CAPACIDAD</Label></strong>
                    <div class="d-flex justify-content-between ml-2 mr-2">


                        <Label class="mt-2 ml-2 mr-3">PERSONAS</Label>
                    <div class="row justify-content-center ">
                        <div class="col">
                            <button id="minus" class="btn btn-outline-primary btn-pill btn-number" disabled data-type="minus"><i class="fal fa-minus primary"> </i></button>
                        </div>
                        <input id="capacidad" type="hidden" name="capacidad">
                        <strong><label id="personas" class="mt-2 input-number"> 0</label>+</strong>
                        <div class="col">
                            <button id="plus" class="btn btn-outline-primary btn-pill btn-number" data-type="plus"><i class="fal fa-plus primary"> </i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="horas" style="visibility: hidden; display: none">

                <div class="d-flex justify-content-between mt-3 ">
                    <strong><Label>Hora Llegada</Label></strong>
                    <strong><Label>Hora Salida</Label></strong>
                </div>
                <div class="input-group date " id="hora">
                    <input type="text"
                        class=" text-center form-control datetimepicker-input {{ $errors->has('hora_inicial') ? 'is-invalid' : ''}}"
                        name="hora_inicial" id="timepicker" data-toggle="datetimepicker" data-target="#timepicker" />
                    <input type="text"
                        class=" text-center form-control datetimepicker-input {{ $errors->has('hora_final') ? 'is-invalid' : ''}}"
                        name="hora_final" id="timepicker_final" data-toggle="datetimepicker"
                        data-target="#timepicker_final" />
                </div>
            </div>

            <br>
            <div class="d-flex justify-content-end">
                <input class="btn btn-pill btn-success" type="submit" value="Buscar">
            </div>
        </div>
</div>
<br>
</form>
</div>
</div>


</div>
@endsection
@push('scripts')

<script>
    $('#datepicker').datepicker({
        weekStart: 1,
        orientation: "bottom",
        startDate: "+7d",
        endDate: "1/1/2021",
        language: "es",
        todayHighlight: true,
    });
    $('#datepicker').parent().css('position', 'relative');
    $('#datepicker').parent().css('z-index', 3000);
</script>
<script language="javascript" type="text/javascript">
    function d1(selectTag){
     if(selectTag.value == 3){
        document.getElementById('horas').style.display = "none";
        document.getElementById('horas').style.visibility = "hidden";
        document.getElementById('capacidad').style.display = "block";
        document.getElementById('capacidad').style.visibility = "visible";
        document.getElementById('capacidad').classList.add('animated', 'fadeIn')
        document.getElementById('fechas').classList.add('animated', 'fadeIn')

     }else{
    document.getElementById('horas').style.display = "block";
    document.getElementById('horas').style.visibility = "visible";
    document.getElementById('capacidad').style.display = "none";
    document.getElementById('capacidad').style.visibility = "hidden";
    document.getElementById('fechas').classList.add('animated', 'fadeIn')
    document.getElementById('horas').classList.add('animated', 'fadeIn')
     }
    }
</script>
<script>
    $(document).ready(function(){
    var seleccionado = $('#tipoItem').val();
     if(seleccionado == 1 || seleccionado == 2 ){
        document.getElementById('horas').style.display = "block";
        document.getElementById('horas').style.visibility = "visible";
        document.getElementById('capacidad').style.display = "none";
        document.getElementById('capacidad').style.visibility = "hidden";
     }else if(seleccionado == 3){
        document.getElementById('horas').style.display = "none";
        document.getElementById('horas').style.visibility = "hidden";
        document.getElementById('capacidad').style.display = "block";
        document.getElementById('capacidad').style.visibility = "visible";
     }
});
</script>
<script>
    $(function () {
    $('#timepicker').datetimepicker({
          format: 'LT'
        });
    $('#timepicker_final').datetimepicker({
          format: 'LT'
        })});
</script>
<script>
    $('.btn-number').on('click', function(e){
    e.preventDefault();
    var id = $(this).attr('data-type');
    var min = 0;
    var max = 8;
    var input = document.getElementById('personas');
    currentVal = parseInt(document.getElementById('personas').textContent);
        if(id == 'minus') {

            if(currentVal > min ){
                input.textContent = currentVal - 1;
                $('input[name="capacidad"]').val(currentVal - 1);
            }
            if(currentVal - 1 == min){
                $(this).attr('disabled', true);
            }
            if( currentVal - 1 < max){
                document.getElementById('plus').disabled = false;
            }

        } else if(id == 'plus') {

            if(currentVal < max ) {
                input.textContent = currentVal + 1;
                $('input[name="capacidad"]').val(currentVal + 1);

            }
            if(currentVal + 1 == max ){
                $(this).attr('disabled', true);
            }
            if(currentVal + 1 > min){
                document.getElementById('minus').disabled = false;
            }

        }
});
</script>
@endpush
