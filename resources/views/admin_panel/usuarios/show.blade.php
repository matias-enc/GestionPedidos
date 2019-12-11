@extends('admin_panel.index')

@section('content')

<div class="row justify-content-center">
    <div class="col-xs-12 col-lg-8">
        <div class="card card-small mb-4 card-outline card-primary animated fadeIn">
            <div class="card-header pb-0">
                <h6 class="text-muted mb-0"><strong>Usuario Id: {{$user->id}}</strong></h6>
                <h3 class="mt-0 "><strong>Datos Personales</strong></h3>
            </div>
            <div class="card-body">
                <div class="ml-2">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <h5><strong>Nombre</strong></h5>
                            <input type="text" class="form-control" name="name" placeholder="Nombre"
                                value="{{$user->name}}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <h5><strong>Apellido</strong></h5>
                            <input type="text" class="form-control" name="apellido" placeholder="Apellidos" value="{{$user->apellido}}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <h5><strong>Dirección</strong></h5>
                            <input type="text" class="form-control" name="direccion" placeholder="Dirección" value="{{$user->direccion}}" disabled
                                >
                        </div>
                        <div class="form-group col-md-6">
                            <h5><strong>DNI</strong></h5>
                            <input type="text" class="form-control" id="dni" name="dni" style="text-align: end"
                                placeholder="Número de Documento" data-inputmask="'mask': '99.999.999'" value="{{$user->dni}}" disabled>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <h5><strong>Teléfono</strong></h5>
                            <input type="text" class="form-control" name="telefono" style="text-align: end" value="{{$user->telefono}}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            @if($user->celular!=null)
                            <h5 class="text-muted"><strong style="color: black">Teléfono Celular</strong>
                            </h5>
                            <input type="text" class="form-control" name="celular" style="text-align: end"
                            value="{{$user->celular}}" disabled>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <h5><strong>Pais</strong></h5>
                            <input type="text" class="form-control" name="pais"
                                value="{{$user->pais->pais}}" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <h5><strong>Provincia</strong></h5>
                            <input type="text" class="form-control" name="provincia"
                                value="{{$user->provincia->provincia}}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <h5><strong>Localidad</strong></h5>
                            <input type="text" class="form-control" name="localidad"
                                value="{{$user->localidad->localidad}}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <h5><strong>Código Postal</strong></h5>
                            <input type="text" class="form-control" value="{{$user->postal}}" disabled>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('admin_panel/plugins/inputmask/jquery.inputmask.bundle.js')}}"></script>
<script>
    $(":input").inputmask();
</script>
<script>
    $('.selection').select2();
</script>
<script>
    $(document).ready(function(){
        $('#seleccionPais').change(function(){
            var Pais = $(this).val();
            if(Pais != null){
                var url = "{{ route('validacion.provincias', "pais") }}" ;
                url = url.replace('pais' , Pais) ;
                // alert(tip_rec_id) ;
                //AJAX

                $.get(url, function(data){

                    // $('#medida').val(data) ;
                    console.log(data);
                    $('#seleccionProvincia').children('option:not(:first)').remove() ;
                    for (var i = 0; i < data.length; i++) {

                        $('#seleccionProvincia').append('<option value='+data[i].id+'>'+data[i].provincia+'</option>') ;

                    }
                });
            } else {
                // $('#medida').val('') ;
            }
        });
        $('#seleccionProvincia').change(function(){
            var Provincia = $(this).val();
            if(Provincia != null){
                var url = "{{ route('validacion.localidad', "provincia") }}" ;
                url = url.replace('provincia' , Provincia) ;
                // alert(tip_rec_id) ;
                //AJAX

                $.get(url, function(data){

                    // $('#medida').val(data) ;
                    console.log(data);
                    console.log(data.length);
                    $('#seleccionLocalidad').children('option:not(:first)').remove() ;
                    for (var i = 0; i < data.length; i++) {

                        $('#seleccionLocalidad').append('<option value='+data[i].id+'>'+data[i].localidad+'</option>') ;

                    }
                });
            } else {
                // $('#medida').val('') ;
            }
        });
    });

</script>
@endpush
