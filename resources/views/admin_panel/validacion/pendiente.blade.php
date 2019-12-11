@extends('admin_panel.index')

@section('content')
<!-- Default Light Table -->
@csrf
<div class="row justify-content-center animated fadeIn">
    <div class="col-xs-12 col-lg-4 ">
        <div class="card card-outline card-primary" style="border-radius: 0.25em"">
            <div class=" card-body ">
                    @if(auth()->user()->validacion->estado !='Desaprobado')
                <h4 class=" text-center mb-3"><strong>Documentacion Enviada</strong></h4>
            <label style="font-size: 16px">Su documentacion ha sido enviada para que un administrativo la evalue. Se le notificara una vez realizada la validacion.</label>
            @else
            <h4 class=" text-center mb-3"><strong>Validacion Rechazada</strong></h4>
            <label style="font-size: 16px">Su validacion ha sido rechazada, por lo que no podrá realizar pedidos.</label>
            @endif
            <hr>
            <div class="pl-3">

                <div class="d-flex ">
                    <label class="btn btn-pill my-auto border" style="width: 37px"><strong style="color: gray"><i
                                class="fal fa-check"></i></strong></label>
                    <h5 class="ml-3 my-auto" style="color: gray"><strong>Datos Personales</strong></h5>
                </div>
                <br>
                <div class="d-flex ">
                    <label class="btn btn-pill my-auto border" style="width: 37px"><strong style="color: gray"><i
                                class="fal fa-check"></i></strong></label>
                    <h5 class="ml-3 my-auto" style="color: gray"><strong>Documentacion</strong></h5>
                </div>
                <br>
                <div class="d-flex ">
                    @if(auth()->user()->validacion->estado !='Desaprobado')
                    <label class="btn btn-primary btn-pill my-auto" style="width: 38px"><strong><i class="fal fa-clock"></i></strong></label>
                    <h5 class="ml-3 my-auto"><strong>Pendiente</strong></h5>
                    @else
                    <label class="btn btn-danger btn-pill my-auto" style="width: 38px"><strong><i class="fal fa-times"></i></strong></label>
                    <h5 class="ml-3 my-auto"><strong>Rechazado</strong></h5>
                    @endif
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
