@extends('admin_panel.index')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 offset-1">
            <a class="btn btn-success btn-pill btn-lg" href="{{ route("pedidos.nuevo_pedido") }}">
                <i class="fa fa-plus mr-2"></i>
                 Nuevo Pedido
            </a>
        </div>
    </div>
    <br>
<div class="card col-10 offset-1">

    <div class="card-body">
        <div class="table">
            <h3><strong>Mis Pedidos</strong></h3>
            <br>
            <table id="pedidos" class="table table-bordered table-striped table-hover datatable">

                    <thead>
                    <tr>
                      <th>Nro Pedido</th>
                      {{-- <th>Items</th> --}}
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->id}}</td>
                                <td><span class="badge badge-pill badge-success">{{ $pedido->estado->nombre }}</span></td>
                                {{-- <td>
                                    @foreach($pedido->transiciones as $tr)
                                        <span class="badge badge-pill badge-info">{{ $tr->nombre }}</span>
                                    @endforeach
                                </td> --}}
                                <td>
                                        <a class="btn btn-xs btn-primary" href="{{route('pedidos.seguimiento', $pedido)}}">
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
@endsection
@push('scripts')
{{-- <script>
        $(function () {
          $('#pedidos').DataTable({
            "ordering": true,
            "info": false,
          });
        });
</script> --}}
@endpush
