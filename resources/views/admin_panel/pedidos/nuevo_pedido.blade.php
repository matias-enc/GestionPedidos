@extends('admin_panel.index')
@section('content')
<div class="container">
    <form action="{{ route("pedidos.consultar_disponibilidad") }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row justify-content-center">


            <div class="card card-outline card-primary">
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


                    <strong><Label>Categoria</Label></strong>
                    <select id="tipoItem"
                        class="estados-js form-control {{ $errors->has('tipoItem') ? 'is-invalid' : '' }}"
                        name="tipoItem">
                        <option value="" disabled selected style="">Seleccione un Tipo</option>
                        @foreach ($tipoItems as $tipoItem)
                        <option placeholder="Categoria" value="{{ $tipoItem->id }}"
                            {{ old('tipoItem') == $tipoItem->id ? 'selected' : '' }}>{{ $tipoItem->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- @endforeach --}}
                <div class="form-group" id="capacidad" class="m-1">
                    <strong><Label>Capacidad</Label></strong>
                    <div class="form-group ">
                        <input class="input-sm form-control {{ $errors->has('capacidad') ? 'is-invalid' : '' }} "
                            type="number" name="capacidad" value="{{old('capacidad')}}" }}>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <strong><Label>Llegada</Label></strong>
                    <strong><Label>Salida</Label></strong>
                </div>
                <div class="input-group input-daterange" id="datepicker" data-date-format="dd/mm/yyyy"
                    data-date-container='#datepicker'>
                    <input type="text" class="input-sm form-control {{ $errors->has('inicial') ? 'is-invalid' : ''}}"
                        name="inicial" placeholder="Llegada" value="{{old('inicial')}}" }} />
                    <input type="text" class="input-sm form-control {{ $errors->has('inicial') ? 'is-invalid' : '' }}"
                        name="final" placeholder="Salida" value="{{ old('final') }}" />
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


</div>
@endsection
@push('scripts')
<script>
    $('#datepicker').datepicker({
        weekStart: 1,
        orientation: "top",
        startDate: "today",
        endDate: "1/1/2021",
        language: "es",
        todayHighlight: true,
    });
</script>
{{-- <script language="javascript" type="text/javascript">
    function d1(selectTag){
     if(selectTag.value == 1){
    document.getElementById('1').style.display = "block";
    document.getElementById('1').style.visibility = "visible";
    document.getElementById('capacidad').style.display = "block";
    document.getElementById('capacidad').style.visibility = "visible";
    document.getElementById('2').style.display = "none";
    document.getElementById('2').style.visibility = "hidden";
        document.getElementById('cantidad').style.display = "none";
        document.getElementById('cantidad').style.visibility = "hidden";
     }else{
    document.getElementById('2').style.display = "block";
    document.getElementById('2').style.visibility = "visible";
    document.getElementById('cantidad').style.display = "block";
    document.getElementById('cantidad').style.visibility = "visible";
    document.getElementById('1').style.display = "none";
    document.getElementById('1').style.visibility = "hidden";
        document.getElementById('capacidad').style.display = "none";
        document.getElementById('capacidad').style.visibility = "hidden";
     }
    }
</script> --}}
@endpush
