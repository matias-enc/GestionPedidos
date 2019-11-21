@extends('admin_panel.index')

@section('content')

<div class="row justify-content-center animated fadeIn">
    <div class="col-8">
        <h4 class="pb-3 text-muted"><strong>Configuraciones</strong></h4>
        <div class="card card-small card-outline card-primary">
            <div class="card-header pb-0">
                <h4 class="pl-2 pb-1"><strong>INFORMACION GENERAL</strong></h4>
            </div>
            <div class="card-body">
                    <form action="{{ route("actualizar_informacion") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                <div class="d-flex">
                    <div class="col mt-2">
                        <label class=""><strong>LOGO DEL SISTEMA</strong></label>
                    </div>
                    <div class="col">
                        <input type="text" name="logo" class="form-control" value="{{$configuracion->logo}}">
                    </div>
                </div>
                <hr class="p-0">

                <div class="d-flex">
                    <div class="col mt-2">
                        <label class=""><strong>NOMBRE</strong></label>
                    </div>
                    <div class="col ">
                        <input type="text" name="nombre" class="form-control" value="{{$configuracion->nombre}}">
                    </div>
                </div>
                <hr class="p-0">
                <div class="d-flex">
                    <div class="col mt-2">
                        <label class=""><strong>DIRECCION</strong></label>
                    </div>
                    <div class="col">
                        <input type="text" name="direccion" class="form-control" value="{{$configuracion->direccion}}">
                    </div>
                </div>
                <hr class="p-0">
                <div class="d-flex">
                    <div class="col mt-2">
                        <label class=""><strong>TELEFONO</strong></label>
                    </div>
                    <div class="col">
                        <input type="text" name="telefono" class="form-control" value="{{$configuracion->telefono}}">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end pt-1 pr-3">
                    <button class="btn btn-primary" type="submit">
                        Actualizar Datos
                    </button>
                </div>
                    </form>
            </div>
        </div>
        <hr>
        <div class="card card-small card-outline card-primary">
            <div class="card-header pb-0">
                <h4 class="pl-2 pb-1"><strong>REPUTACION Y PENALIZACIONES</strong></h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-11">
                        <div class="alert alert-primary alert-dismissible shadow-sm" id="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fal fa-info"></i> Informacion!</h5>
                            A continuacion estan definidas la cantidad de dias de penalizacion dependiendo de la reputacion establecida.
                        </div>
                    </div>
                </div>
                <form action="{{ route("actualizar_penalizacion") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                @foreach ($calificaciones as $calificacion)
                <div class="d-flex">
                    <div class="col mt-2">
                        <label class=""><strong>{{strtoupper($calificacion->nombre)}}</strong></label>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col pr-0">
                                <input id="input-penalizacion" name="calificaciones[]" type="number" min="0" class="form-control" style="text-align: end" value="{{$calificacion->penalizacion}}" >
                            </div>
                            <div class="col p-2 pl-0">
                                <label>dias</label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                @endforeach
                <div class="d-flex justify-content-end pt-1 pr-3">
                    <button class="btn btn-primary" type="submit">
                        Actualizar Datos
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- @push('scripts')
<script type='text/javascript'
    src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
    $(document).ready(function(){
        $("#input-penalizacion").numeric({
            decimal : ".",  negative : false, scale: 3
        })
    });

</script>
@endpush --}}
