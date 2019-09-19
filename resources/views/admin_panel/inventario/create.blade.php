@extends('admin_panel.index')

@section('content')
<div class="row justify-content-center">


    <div class="card card-small col-6 ">
        <div class="card-header">
            <h3><strong>Crear Nuevo Item</strong></h3>
        </div>

        <div class="card-body ">
            <form action="{{ route("item.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                        <strong><Label>Nombre</Label></strong>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', isset($user) ? $user->nombre : '') }}" required>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
                        <strong><Label>Categoria</Label></strong>
                    <select id="categorias" class="estados-js form-control" onchange="d1(this)" >
                            <option value="" disabled selected style="">Seleccione una Categoria</option>
                            @foreach($categorias as $categoria)
                                <option  placeholder="Categoria"  value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option>
                            @endforeach
                    </select>
                    @if($errors->has('descripcion'))
                        <p class="help-block">
                            {{ $errors->first('descripcion') }}
                        </p>
                    @endif
                </div>


                                @foreach($categorias as $id => $categoria)
                                <div  class="form-group " style="display:none"  id="{{$categoria->id}}">


                                <strong><Label>Tipo de Item</Label></strong>
                                    <select id="tipoItems"   class="estados-js form-control {{ $errors->has('tipoItems') ? 'is-invalid' : '' }}"  name="tipoItems_id">
                                            <option value="" disabled selected style="">Seleccione una Categoria</option>
                                    @foreach ($categoria->tipoItems as $tipoItem)
                                            <option  placeholder="Categoria"  value="{{ $tipoItem->id }}" >{{ $tipoItem->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                @endforeach
                <div class="form-group" id="cantidad" type="hidden"   style="display:none" class="m-1">
                    <strong><Label>Cantidad</Label></strong>
                    <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                            <input class="input-sm form-control " type="number" name="cantidad">
                    </div>
                </div>
                <div class="form-group" id="capacidad"   style="display:none" class="m-1">
                    <strong><Label>Capacidad</Label></strong>
                    <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                            <input class="input-sm form-control " type="number" name="capacidad">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
                        <strong><Label>Descripcion</Label></strong>
                    <input type="descripcion" id="descripcion" name="descripcion" class="form-control" required>
                    @if($errors->has('descripcion'))
                        <p class="help-block">
                            {{ $errors->first('descripcion') }}
                        </p>
                    @endif
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script language="javascript" type="text/javascript">
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
    </script>
@endpush

