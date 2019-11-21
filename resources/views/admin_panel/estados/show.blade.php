@extends('admin_panel.index')

@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card card-outline card-primary card-small">
            <div class="card-header pb-1">
                <div class="d-flex">
                    <a class="fas fa-chevron-left mt-1 mr-2" href="{{ url()->previous() }}" style="font-size: 18px">
                    </a>
                    <h4><strong>Visualizacion de Estado</strong></h4>
                </div>

            </div>
            <div class="card-body">
                <h5><strong>Descripcion</strong></h5>
                <div class="card card-body shadow-none p-0">
                    <table id="pedidos" class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Creado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center">{{$estado->id}}</td>
                                <td style="text-align: center">{{$estado->nombre}}</td>
                                <td style="text-align: center">{{$estado->created_at->format('d/m/Y')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
