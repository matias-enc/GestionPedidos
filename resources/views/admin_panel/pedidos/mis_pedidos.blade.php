@extends('admin_panel.index')

@section('content')
<div class="row justify-content-center animated fadeIn">
    <div class="col-8">


        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3><strong>Mis Pedidos</strong></h3>
            </div>
            <div class="card-body">
                <div class="card shadow-none card-small ">
                    <div class="card-body p-0">
                        <table id="pedidos" class="table">
                            <thead>
                                <tr>
                                    <th>Items</th>
                                    {{-- <th>Items</th> --}}
                                    <th>Estado</th>
                                    <th style="text-align: end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                <tr>
                                    <td>
                                        @foreach ($pedido->seguimientos as $seguimiento)
                                        <span
                                            class="badge badge-pill badge-info">{{ $seguimiento->item->nombre }}</span>
                                        @endforeach
                                    </td>
                                    @if($pedido->estado->nombre !='Finalizado')
                                    <td><span
                                            class="badge badge-pill badge-success">{{ $pedido->estado->nombre }}</span>
                                    </td>
                                    @else
                                    <td><span class="badge badge-pill badge-danger">{{ $pedido->estado->nombre }}</span>
                                    </td>
                                    @endif
                                    <td style="text-align: end">
                                        <a class="btn btn-xs btn-primary"
                                            href="{{route('pedidos.seguimiento', $pedido)}}">
                                            Seguimiento
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush
