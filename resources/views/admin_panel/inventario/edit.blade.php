@extends('admin_panel.index')

@section('content')

<div class="card col-6 offset-3">
    <div class="card-body ">
        <div class="mb-2">

            <div class="card-body ">

                <form action="{{ route("item.update", $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                        <strong><Label>Nombre</Label></strong>
                        <input type="text" id="nombre" name="nombre" class="form-control"
                            value="{{ old('nombre', isset($item) ? $item->nombre : '') }}" required>
                        @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
                        <strong><Label>Categoria</Label></strong>
                        <select id="categorias" class="estados-js form-control" onchange="d1(this)">
                            <option value="" disabled selected style="">Seleccione una Categoria</option>
                            @foreach($categorias as $categoria)
                            <option placeholder="Categoria" value="{{ $categoria->id }}" @if ($item->tipoItem->categoria->nombre == $categoria->nombre)
                                selected
                            @endif disabled>{{ $categoria->nombre }}
                            </option>
                            @endforeach
                        </select>
                        @if($errors->has('descripcion'))
                        <p class="help-block">
                            {{ $errors->first('descripcion') }}
                        </p>
                        @endif
                    </div>


                    @foreach($categorias as $id => $categoria)
                    <div class="form-group " style="display:none" id="{{$categoria->id}}">
                        <strong><Label>Tipo de Item</Label></strong>
                        <select id="tipoItems"
                            class="estados-js form-control {{ $errors->has('tipoItems') ? 'is-invalid' : '' }}"
                            name="tipoItems_id">
                            <option value="" disabled selected style="">Seleccione una Categoria</option>
                            @foreach ($categoria->tipoItems as $tipoItem)
                            <option placeholder="Categoria" value="{{ $tipoItem->id }}" >{{ $tipoItem->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach
                    @if ($item->cantidad > 0)
                    <div class="form-group" id="cantidad" class="m-1">
                        <strong><Label>Cantidad</Label></strong>
                        <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                        <input class="input-sm form-control " type="number" name="cantidad" value="{{$item->cantidad}}">
                        </div>
                    </div>
                    @endif
                    @if ($item->capacidad > 0)
                    <div class="form-group" id="capacidad" class="m-1">
                        <strong><Label>Capacidad</Label></strong>
                        <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                            <input class="input-sm form-control " type="number" name="capacidad" value="{{$item->capacidad}}">
                        </div>
                    </div>
                    @endif
                    <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
                        <strong><Label>Descripcion</Label></strong>
                    <input type="descripcion" id="descripcion" name="descripcion" class="form-control" value="{{$item->descripcion}}" required>
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
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.permissions-js').select2();
        theme: "classic"
    });
</script>
@endpush
