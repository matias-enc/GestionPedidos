@extends('admin_panel.index')

@section('content')
<div class="d-flex justify-content-center animated fadeIn">

    <div class="col-8">


        <div class="card shadow-sm card-primary card-outline card-small">
            <div class="card-header pb-1">
                <h3><strong>Documentaciones Pendientes</strong></h3>
            </div>
            <div class="card-body">

                @if (sizeof($pedidos)>0)
                <div class="d-flex pl-2 pr-2">
                    <h5><label>Los Pedidos que aparecen a continuación tienen una <strong>vigencia de 24hs.</strong>
                            para presentar la
                            documentación.</label></h5>
                </div>
                <div class="card card-body card-small p-0  shadow-none ">
                    <table id="pedidos" class="table">
                        <thead>
                            <tr class="text-center">
                                <th>Emitido</th>
                                <th>Vigencia hasta</th>
                                <th>Items</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                            <tr>
                                <td class="text-center">{{$pedido->updated_at->diffForHumans()}}</td>
                                <td class="text-center">
                                    {{$pedido->updated_at->addHours(24)->format('d/m/Y G:i A')}}<label
                                        class="text-muted">({{$pedido->updated_at->addHours(24)->diffForHumans()}})</label>
                                </td>
                                <td>
                                    @foreach ($pedido->seguimientos as $seguimiento)
                                    <span class="badge badge-info">{{ $seguimiento->item->nombre }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary"
                                        href="{{route('pedidos.ver_pendiente', $pedido)}}">
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
                    <h4>No tenes Documentacion Pendiente!</h4>
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
