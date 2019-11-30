@extends('admin_panel.index')

@section('content')
<!-- Default Light Table -->
@csrf
<div class="row justify-content-between">
    <div class="col-xs-12 col-lg-8">
        <div class="card card-small mb-4 card-outline card-primary animated fadeIn">
            <div class="card-header pb-0">
                <h6 class="text-muted mb-0"><strong>PASO 1</strong></h6>
                <h3 class="mt-0 "><strong>Cargue sus Datos Personales</strong></h3>
            </div>
            <div class="card-body">
                <div class="ml-2">
                    <form action="{{ route("cargar_datos") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h5><strong>Nombre</strong></h5>
                                <input type="text" class="form-control" name="name" placeholder="Nombre"
                                    value="{{$user->name}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <h5><strong>Apellido</strong></h5>
                                <input type="text" class="form-control" name="apellido" placeholder="Apellidos"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h5><strong>Dirección</strong></h5>
                                <input type="text" class="form-control" name="direccion" placeholder="Dirección"
                                    value="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <h5><strong>DNI</strong></h5>
                                <input type="text" class="form-control" id="dni" name="dni"
                                    placeholder="Número de Documento" data-inputmask="'mask': '99.999.999'" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h5><strong>Teléfono</strong></h5>
                                <input type="text" class="form-control" name="telefono" value="" style="text-align: end"
                                    placeholder="Ej. (3758)42-0021" data-inputmask="'mask': '(9999)99-9999'" required>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 class="text-muted"><strong style="color: black">Teléfono Celular</strong>(opcional)
                                </h5>
                                <input type="text" class="form-control" name="celular" style="text-align: end"
                                    placeholder="Ej. (3758)15-1231" data-inputmask="'mask': '(9999)99-999999'">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h5><strong>País</strong></h5>
                                <input type="text" class="form-control" name="pais" placeholder="Ej. Argentina" value=""
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <h5><strong>Provincia</strong></h5>
                                <input type="text" class="form-control" name="provincia" placeholder="Ej. Misiones">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h5><strong>Localidad</strong></h5>
                                <input type="text" class="form-control" name="localidad" placeholder="Ej. Apostoles"
                                    value="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <h5><strong>Código Postal</strong></h5>
                                <input type="text" class="form-control" name="postal" placeholder="Ej. 3350"
                                    data-inputmask="'mask': '9999'">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-pill btn-lg">Enviar Datos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-lg-4 ">
        <div class="card card-outline card-primary" style="border-radius: 0.25em"">
            <div class=" card-body ">
                <h4 class=" text-center mb-3"><strong>Documentacion Pendiente</strong></h4>
            <label style="font-size: 16px">Sabemos que lleva su tiempo, pero es indispensable para realizar pedidos
                dentro del sistema</label>
            <hr>
            <div class="pl-3">
                <div class="d-flex ">
                    <label class="btn btn-primary btn-pill my-auto" style="width: 37px"><strong>1</strong></label>
                    <h5 class="ml-3 my-auto"><strong>Datos Personales</strong></h5>
                </div>
                <br>
                <div class="d-flex ">
                    <label class="btn btn-pill my-auto border" style="width: 37px"><strong
                            style="color: gray">2</strong></label>
                    <h5 class="ml-3 my-auto" style="color: gray"><strong>Documentación</strong></h5>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Default Light Table -->
@endsection
@push('scripts')
<script src="{{asset('admin_panel/plugins/inputmask/jquery.inputmask.bundle.js')}}"></script>
<script>
    $(":input").inputmask();
</script>
@endpush
