@extends('admin_panel.index')

@section('content')
<div class="row justify-content-center">
    <div class="col-2">
        <div class="card card-outline card-primary card-body card-small">
            <div class="d-flex flex-column m-auto">
                <div class="text-center">
                    <span class="text-muted">PEDIDOS <br> INICIADOS</span>
                    <h2 class="mt-2"><strong><span class="badge  badge-primary">{{$iniciados}}</span></strong></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="card card-outline card-success card-body card-small">
            <div class="d-flex flex-column m-auto">
                <div class="text-center">
                    <span class="text-muted">PEDIDOS <br> SOLICITADOS</span>
                    <h2 class="mt-2" ><strong><span class="badge  badge-success">{{$solicitados}}</span></strong></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="card card-outline card-warning card-body card-small">
            <div class="d-flex flex-column m-auto">
                <div class="text-center">
                    <span class="text-muted">PEDIDOS <br> EN ESPERA DE PAGO</span>
                    <h2 class="mt-2"><strong><span class="badge  badge-warning">{{$pagospendientes}}</span></strong></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="card card-outline card-danger card-body card-small">
            <div class="d-flex flex-column m-auto">
                <div class="text-center">
                    <span class="text-muted">PEDIDOS FINALIZADOS</span>
                    <h2 class="mt-2"><strong><span class="badge  badge-danger">{{$finalizados}}</span></strong></h2>
                </div>
            </div>
        </div>
    </div>

</div>
<br>
<div class="row justify-content-start">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h3><strong>Habitaciones mas Solicitadas</strong></h3>
                <div>
                    {!! $chart->container() !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
{!! $chart->script() !!}
@endpush
