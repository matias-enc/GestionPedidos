@extends('admin_panel.index')

@section('content')
<div class="d-flex justify-content-center">

    <div class="col-8">


        <div class="card shadow-sm card-primary card-outline card-small">
            <div class="card-header pb-1">
                <h3><strong>Pedidos Activos</strong></h3>
            </div>
            <div class="card-body">
                @if (sizeof($pedidos)>0)
                <div class="table">
                    <table id="pedidos" class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr class="text-center">
                                <th>Nr° Pedido</th>
                                <th>Fecha Inicial</th>
                                <th>Usuario</th>
                                <th>Items</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                            <tr>
                                <td class="text-center">{{$pedido->id}}</td>
                                <td class="text-center">{{$pedido->getFechaInicial()}}</td>
                                <td class="text-center">
                                    <span class="badge badge-warning">{{ $pedido->usuario->name }}</span>
                                </td>
                                <td >
                                    @foreach ($pedido->seguimientos as $seguimiento)
                                    <span class="badge badge-info">{{ $seguimiento->item->nombre }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary"
                                        href="{{route('pedidos.ver_iniciado', $pedido)}}">
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
                    <h4>No hay Pedidos Iniciados!</h4>
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
