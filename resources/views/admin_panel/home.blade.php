@extends('admin_panel.index')
@section('content')
<form class="form-group">
        <div class="container-fluid">
            <div class="row offset-1">
                    <div class="card" style="width: 25rem;">
                            <img class="card-img-top" style="height: 15rem" src="{{asset('imagenes/salon.jpg')}}" alt="Card image cap">
                            <div class="card-header">
                                <h2 class="card-title"><strong>Salon de Eventos</strong></h2>
                                <div class="card-tools">
                                    <!-- Buttons, labels, and many other things can be placed here! -->
                                    <!-- Here is a label for example -->
                                    {{-- <span class="badge badge-warning">Prueba</span> --}}
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <div class="card-body">

                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex eos adipisci est voluptatem obcaecati magni, qui, quis aspernatur ipsum maiores enim recusandae aperiam tempore laborum! Obcaecati officiis provident nisi repellendus?</p>
                                <a href="#" class="btn btn-pill btn-primary">Saber Mas &rarr;</a>
                            </div>
                        </div>

                    <div class="card offset-1" style="width: 25rem;">
                        <img class="card-img-top" style="height: 15rem" src="{{asset('imagenes/complejo.jpg')}}" alt="Card image cap">
                        <div class="card-header">
                            <h2 class="card-title"><strong>Complejo</strong></h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                {{-- <span class="badge badge-warning">Prueba</span> --}}
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">

                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex eos adipisci est voluptatem obcaecati magni, qui, quis aspernatur ipsum maiores enim recusandae aperiam tempore laborum! Obcaecati officiis provident nisi repellendus?</p>

                                    <a href="#" class="btn btn-pill btn-primary">Saber Mas &rarr;</a>
                        </div>
                    </div>
            </div>

        </div>
    </form>
@endsection



