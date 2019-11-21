@extends('admin_panel.index')

@section('content')
<!-- Default Light Table -->
@csrf
<div class="row justify-content-between animated fadeIn">
    <div class="col-xs-12 col-lg-6 ">
        <div class="card card-outline card-primary card-small mb-4">
            <div class="card-header pb-0">
                <h6 class="text-muted mb-0"><strong>PASO 2</strong></h6>
                <h3 class="mt-0 "><strong>Documento de Identidad</strong></h3>
            </div>
            <div class="card-body p-1">
                <form action="{{ route("enviar_datos") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div id="divFrontal">
                            <br>
                            <h5 class="text-center pt-3 pb-1 animated fadeIn" id="label-frontal"><strong>Tome una foto
                                    frontal de
                                    su
                                    Documento</strong></h5>
                            <div class="d-flex justify-content-center pb-2">
                                <div class=" col-8">
                                    <img src="{{asset('imagenes/dni-frontal.png')}}"
                                        class="img-fluid animated flipInY shadow-sm border" id="imagen-frontal" alt=""
                                        style="border-radius: 0.8em">
                                </div>
                            </div>
                            <label class="d-flex justify-content-center text-muted text-center pl-3 pr-3">Procure que la
                                foto se realice en un lugar <br> iluminado para una mejor visibilidad de la
                                imagen</label>

                            <br>
                            <br>
                            <div class="row justify-content-center ">
                                <label class="btn btn-primary btn-pill btn-lg pb-0" type="none" for="frontal">
                                    <label class="label-input" for="frontal" id="labelFrontal" capture="camera">Foto
                                        Frontal</label>
                                </label>
                                <input type="file" name="fotoFrontal" id="frontal" class="inputfile"  />
                                {{-- accept="image/*" --}}
                            </div>
                        </div>
                        <div id="divDorso" class="animated fadeIn"
                            style="visibility: hidden; display: none; animation-delay: .25s">
                            <br>
                            <h5 class="text-center pt-3 pb-1 animated fadeIn" id="label-frontal"><strong>Tome una foto
                                    del dorso de
                                    su
                                    Documento</strong></h5>
                            <div class="d-flex justify-content-center pb-2">
                                <div class=" col-8">
                                    <img src="{{asset('imagenes/dni-dorso.png')}}"
                                        class="img-fluid animated flipInY shadow-sm border" id="imagen-frontal" alt=""
                                        style="border-radius: 0.8em; animation-delay: .25s">
                                </div>
                            </div>
                            <label class="d-flex justify-content-center text-muted text-center pl-3 pr-3">Procure que la
                                foto se realice en un lugar <br> iluminado para una mejor visibilidad de la
                                imagen</label>

                            <br>
                            <br>
                            <div class="row justify-content-center ">
                                <label class="btn btn-primary btn-pill btn-lg pb-0" type="none" for="dorso">
                                    <label class="label-input" for="dorso" id="labelDorso">Foto Dorso</label>
                                </label>
                                <input type="file" name="fotoDorso" id="dorso" class="inputfile"/>
                            </div>
                        </div>

                        <div id="divFin" style="visibility: hidden; display: none;">
                            <br>
                            <div class="d-flex justify-content-center pb-2">
                                <div class=" col-8">
                                    <img src="{{asset('imagenes/dni.png')}}" class="img-fluid animated fadeIn"
                                        id="imagen-frontal" alt="" style="border-radius: 0.8em; animation-delay: .25s">
                                </div>
                            </div>
                            <h4 class="text-center pt-3 pb-1 animated fadeIn" id="label-frontal"
                                style="animation-delay: .30s"><strong>La carga de datos ha finalizado!</strong></h4>
                            <h6 class="text-center animated fadeIn" style="animation-delay: .35s">Puede proceder a
                                enviar
                                sus datos para su revision.</h6>
                            <br>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button class=" btn btn-pill btn-lg btn-primary animated fadeIn"
                                    style="animation-delay: .40s" type="submit">
                                    Enviar Datos
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- <br>
                <div class="d-flex justify-content-end" style="visibility: hidden; display: none" id="btnEnviar">
                    <button class="btn btn-primary">
                        Enviar Datos
                    </button>
                </div> --}}
                    <br>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-lg-4">
        <div class="card card-outline card-primary" style="border-radius: 0.25em"">
            <div class=" card-body ">
                <h4 class=" text-center mb-3"><strong>Documentacion Pendiente</strong></h4>
            <label style="font-size: 16px">Sabemos que lleva su tiempo, pero es indispensable para realizar pedidos
                dentro del sistema</label>
            <hr>
            <div class="pl-3">

                <div class="d-flex ">
                    <label class="btn btn-pill my-auto border" style="width: 37px"><strong style="color: gray"><i
                                class="fal fa-check"></i></strong></label>
                    <h5 class="ml-3 my-auto" style="color: gray"><strong>Datos Personales</strong></h5>
                </div>
                <br>
                <div class="d-flex ">
                    <label class="btn btn-primary btn-pill my-auto" style="width: 37px"><strong>2</strong></label>
                    <h5 class="ml-3 my-auto"><strong>Documentación</strong></h5>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Default Light Table -->
@endsection
@push('scripts')
<script type='text/javascript'
    src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();
</script>
<script>
    $('#frontal').on("change",function(e) {
        $('#labelFrontal').html(e.target.files[0].name);
        $("#divFrontal").css('visibility','hidden');
        $("#divFrontal").css('display','none');
        $("#subirDorso").css('visibility','visible');
        $("#subirDorso").css('display','block');
        $("#divDorso").css('visibility','visible');
        $("#divDorso").css('display','block');
    });
    $('#dorso').on("change",function(e) {
        $('#labelDorso').html(e.target.files[0].name);
        $("#divDorso").css('visibility','hidden');
        $("#divDorso").css('display','none');
        $("#divFin").css('visibility','visible');
        $("#divFin").css('display','block');
        $("#btnEnviar").css('visibility','visible');
        $("#btnEnviar").css('display','block');

    });
</script>
@endpush
