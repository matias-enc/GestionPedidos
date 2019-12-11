@extends('admin_panel.index')
@section('content')
<div class="row justify-content-between animated fadeIn">
    <div class="col-7">
        <div class="row justify-content-center">
            <div class="col-10 ">
                <div class="card card-small card-outline card-primary">
                    <div class="card-header pb-1">
                        <h4 class="text-center"><strong>Validacion de {{$usuario->name}} {{$usuario->apellido}}</strong>
                        </h4>
                    </div>
                    <div class="card-body pl-0 pr-0">
                        <div class="pl-4 pr-4">
                            <h5><strong>Solicitud Efectuada</strong>: {{$validacion->updated_at->format('d/m/Y H:i')}}hs
                            </h5>
                        </div>
                        <hr>
                        <div class="pl-4 pr-4">
                            <h5><strong>Datos Personales</strong>:</h5>
                            <div class="card card-body p-0">
                                <div class="d-flex justify-content-between">
                                    <div class="col pt-2">
                                        <label><strong>Nombre:</strong> {{$usuario->name}}</label><br>
                                        <label><strong>Apellido:</strong> {{$usuario->apellido}}</label><br>
                                        <label><strong>Direccion:</strong> {{$usuario->direccion}}</label><br>
                                        <label><strong>Email:</strong> {{$usuario->email}}</label><br>
                                        <label><strong>Dni:</strong> {{$usuario->dni}}</label><br>

                                    </div>
                                    <div class="col border-left pt-2">
                                        <label><strong>Telefono Fijo:</strong> {{$usuario->telefono}}</label><br>
                                        <label><strong>Nro. Celular:</strong> {{$usuario->celular}}</label><br>
                                        <label><strong>Pais:</strong> {{$usuario->pais->pais}}</label><br>
                                        <label><strong>Provincia:</strong> {{$usuario->provincia->provincia}}</label><br>
                                        <label><strong>Localidad:</strong> {{$usuario->localidad->localidad}}</label><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between pl-5 pr-5 pb-2">
                            <form id="form-cancelar" action="{{ route("cancelar_validacion", $validacion) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <button class="btn btn-pill btn-danger btn-cancelar px-4">
                                    Rechazar
                                    <i class="pl-1 fal fa-times"></i>
                                </button>
                            </form>
                            <form id="form-aceptar" action="{{ route("aceptar_validacion", $validacion) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <button class="btn btn-pill btn-success btn-aceptar px-4">
                                    Validar
                                    <i class="pl-1 fal fa-check"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-5">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card card-small">
                    <div class="card-body">
                        <h4 class="pl-3"><strong>Foto Frontal del Documento de Identidad</strong></h4>
                        <img src="{{ asset('/documentacion/validacion'. $frontal->documento) }}" class="img-fluid"
                            alt="">

                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card card-small">
                    <div class="card-body">
                        <h4 class="pl-3"><strong>Foto Dorso del Documento de Identidad</strong></h4>
                        <img src="{{ asset('/documentacion/validacion'. $dorso->documento) }}" class="img-fluid" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('.btn-aceptar').on('click', function(e){
            var id = $(this).attr('id');
        e.preventDefault();

        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-pill btn-success pl-4 pr-4 btn-lg ml-4 mr-4',
    cancelButton: 'btn btn-pill btn-danger pl-4 pr-4 btn-lg ml-4 mr-4'
  },
  buttonsStyling: false
})

        swalWithBootstrapButtons.fire({
        title: "Cuidado!",
        text: "Esta seguro que desea Aceptar la Validacion?",
        type: "info",
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    })
    .then ((willDelete) => {
        if (willDelete.value) {
        $("#form-aceptar").submit();
        }
    });
 });
</script>
<script>
    $('.btn-cancelar').on('click', function(e){
            var id = $(this).attr('id');
        e.preventDefault();

        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-pill btn-success pl-4 pr-4 btn-lg ml-4 mr-4',
    cancelButton: 'btn btn-pill btn-danger pl-4 pr-4 btn-lg ml-4 mr-4'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
        title: "Cuidado!",
        text: "Esta seguro que desea Cancelar la Validacion?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    })
    .then ((willDelete) => {
        if (willDelete.value) {
        $("#form-cancelar").submit();
        }
    });
 });
</script>
@endpush
