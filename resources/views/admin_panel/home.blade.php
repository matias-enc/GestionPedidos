@extends('admin_panel.index')
@section('content')
<form class="form-group">
    {{-- <div class="container-fluid"> --}}
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card card-hover" style="width: 25rem;">
                <img class="card-img-top" style="height: 15rem" src="{{asset('imagenes/salon.jpg')}}"
                    alt="Card image cap">
                <div class="card-header pb-1    ">
                    <h4><strong>Salones de Eventos</strong></h4>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">

                    <p class="card-text">
                        Estas buscando realizar una fiesta para una cantidad de personas considerable? Solicita uno de nuestros salones de eventos que mejor se adapte a tus necesidades!
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-pill btn-primary">Saber Mas &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-hover" style="width: 25rem;">
                <img class="card-img-top" style="height: 15rem" src="{{asset('imagenes/complejo.jpg')}}"
                    alt="Card image cap">
                <div class="card-header pb-1    ">
                    <h4><strong>Complejos</strong></h4>
                    <div class="card-tools">
                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body">

                    <p class="card-text">Complejos para eventos con la capacidad para realizar Fiestas de Egresados,
                        Congresos, Reuniones Parroquiales. Solicita uno de nuestros complejos disponibles!</p>

                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-pill btn-primary">Saber Mas &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-hover" style="width: 25rem;">
                <img class="card-img-top" style="height: 15rem" src="{{asset('imagenes/albergue.jpg')}}"
                    alt="Card image cap">
                <div class="card-header pb-1    ">
                    <h4><strong>Albergues</strong></h4>
                    <div class="card-tools">
                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body">

                    <p class="card-text">Necesitas albergar personas para un evento, o queres estar de estadia unos dias
                        por nuestra localidad? Solicita uno de los albergues que tenemos disponibles para tus
                        necesidades!</p>

                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-pill btn-primary">Saber Mas &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- </div> --}}
    {{-- </form> --}}
    {{-- <div class="row justify-content-center">

    <img src="{{asset('/imagenes/meme.png')}}" class="img-fluid"><br>
    </div>
    <div class="row justify-content-center">
        <H2><strong>YO HABIA PONIDO MI INICIO ACA!</strong></H2>
    </div> --}}
    @endsection
