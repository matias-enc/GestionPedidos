@extends('admin_panel.index')

@section('content')
<div class="d-flex justify-content-center animated fadeIn">

    <div class="col-8">


        <div class="card shadow-sm card-primary card-outline card-small">
            <div class="card-header pb-1">
                <h3><strong>Validaciones Pendientes</strong></h3>
            </div>
            <div class="card-body">

                @if (sizeof($validaciones)>0)
                <div class="d-flex pl-2 pr-2">
                    <h5><label>Los usuarios que se encuentran a continuacion requieren de validacion para poder hacer uso dentro del sistema y realizar Pedidos.</label></h5>
                </div>
                <div class="card card-body card-small p-0  shadow-none ">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>Usuario</th>
                                <th>Solicitado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($validaciones as $validacion)
                            <tr>
                                <td class="text-center">{{$validacion->usuario->name}}</td>
                                <td class="text-center">
                                        {{$validacion->updated_at->diffForHumans()}}
                                </td>

                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary"
                                        href="{{route('ver_validacion_pendiente', $validacion)}}">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <br>
                <div class="row justify-content-center">
                    <h4>No hay Validaciones Pendientes!</h4>
                </div>
                <br>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush
