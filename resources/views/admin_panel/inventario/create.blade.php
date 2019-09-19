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
                    <select name="tipoItems_id" id="tipoItems_id" class="estados-js form-control" onchange="d1(this)" required >
                            <option value="" disabled selected style="">Seleccione una Categoria</option>
                            @foreach($tipoItems as $tipo)
                                <option  placeholder="Categoria"  value="{{ $tipo->id }}" >{{ $tipo->nombre }}</option>
                            @endforeach
                    </select>
                    @if($errors->has('descripcion'))
                        <p class="help-block">
                            {{ $errors->first('descripcion') }}
                        </p>
                    @endif
                </div>
                <div class="form-group" id="capacidad"   style="display:none" class="m-1">
                    <strong><Label>Capacidad</Label></strong>
                    <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                            <input class="input-sm form-control " type="number" name="capacidad">
                    </div>
                </div>
                <div class="form-group" id="cantidad"   style="display:none" class="m-1">
                    <strong><Label>Cantidad</Label></strong>
                    <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                            <input class="input-sm form-control " type="number" name="cantidad">
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
     if(selectTag.value == 4){
    document.getElementById('cantidad').style.display = "block";
     }else{
     document.getElementById('cantidad').style.display = "none";
     }
     if(selectTag.value != 4){
        document.getElementById('capacidad').style.display = "block";
    }else{
        document.getElementById('capacidad').style.display = "none";
    }
    }
    </script>
@endpush

