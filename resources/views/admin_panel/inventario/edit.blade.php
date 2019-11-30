@extends('admin_panel.index')

@section('content')
<div class="row justify-content-center">

    <div class="col-6">


        <div class="card card-small card-outline card-primary">
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
                            <option placeholder="Categoria" value="{{ $categoria->id }}" @if ($item->
                                tipoItem->categoria->nombre == $categoria->nombre)
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
                            <option placeholder="Categoria" value="{{ $tipoItem->id }}">{{ $tipoItem->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach
                    @if ($item->cantidad > 0)
                    <div class="form-group" id="cantidad" class="m-1">
                        <strong><Label>Cantidad</Label></strong>
                        <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                            <input class="input-sm form-control " type="number" name="cantidad"
                                value="{{$item->cantidad}}">
                        </div>
                    </div>
                    @endif
                    @if ($item->capacidad > 0)
                    <div class="form-group" id="capacidad" class="m-1">
                        <strong><Label>Capacidad</Label></strong>
                        <div class="form-group {{ $errors->has('itemSecundario') ? 'has-error' : '' }}">
                            <input class="input-sm form-control " type="number" name="capacidad"
                                value="{{$item->capacidad}}">
                        </div>
                    </div>
                    @endif
                    <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
                        <strong><Label>Descripcion</Label></strong>
                        <input type="descripcion" id="descripcion" name="descripcion" class="form-control"
                            value="{{$item->descripcion}}" required>
                        @if($errors->has('descripcion'))
                        <p class="help-block">
                            {{ $errors->first('descripcion') }}
                        </p>
                        @endif
                    </div>
                    @if (sizeof($item->imagenes)>0)


                    <div class="form-group">
                        <strong><Label>Imagenes</Label></strong>
                        <div class="row">


                            @foreach ($item->imagenes as $imagen)
                            <div class="col-6">


                                <div class="card card-small">
                                    <img class="card-img-top"
                                        src="{{ asset('/imagenes/item_imagenes/'. $imagen->archivo) }}"
                                        alt="Card image cap" style="height:120px">
                                    <div class="card-body p-0">
                                        <div class="d-flex justify-content-center my-1">
                                            <a href="{{route('borrar_imagen', $imagen->id)}}" class="btn btn-danger btn-sm">Borrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <br>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-pill btn-outline-primary btn-sm" type="button" data-toggle="modal"
                            data-target="#myModal">Agregar Fotos</button>
                        <input class="btn btn-primary btn-pill" type="submit" value="Guardar">
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cargar Imagenes</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('fileUpload', $item)}}" class="dropzone" id="dropzone">
                    @csrf
                    <div class="dz-message" data-dz-message><span>Arrastre sus archivos aqui</span></div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="{{route('item.edit', $item->id)}}" class="btn btn-primary btn-pill">Listo</a>
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
<script>
    Dropzone.options.myDropzone = {
        maxFilesize: 3,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            timeout: 50000,

            success: function(file, response)
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }

    };
</script>
@endpush
