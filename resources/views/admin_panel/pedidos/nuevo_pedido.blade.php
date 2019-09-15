@extends('admin_panel.index')
@section('content')
    <div class="container">
                    <form action="{{ route("pedidos.consultar_disponibilidad") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                                {{-- <nuevo_pedido>
                                </nuevo_pedido> --}}
                                <br>
                                <div class="card card-outline card-primary col-5 offset-3">
                                    <div class="card-header text-center">
                                        <div class="card-title">
                                            <h3><strong>Realizar un Nuevo Pedido</strong></h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <strong><Label>Seleccione una Categoria</Label></strong>
                                        <div class="form-group">
                                            <div class="form-group {{ $errors->has('tipoItem') ? 'has-error' : '' }}">
                                                <select name="tipoItem" id="tipoItem" class="estados-js form-control" required>
                                                    @foreach($tipoItems as $id => $tipo)
                                                        <option  placeholder="Categoria"  value="{{ $id }}" >{{ $tipo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <strong><Label>Llegada</Label></strong>
                                            <strong><Label>Salida</Label></strong>
                                        </div>
                                        <div class="input-group input-daterange" id="datepicker" data-date-format="dd/mm/yyyy" data-date-container='#datepicker'>
                                            <input type="text" class="input-sm form-control {{ $errors->has('inicial') ? 'is-invalid' : ''}}" name="inicial" placeholder="Llegada"/>
                                            <input type="text" class="input-sm form-control {{ $errors->has('inicial') ? 'is-invalid' : '' }}" name="final" placeholder="Salida" />
                                        </div>

                                        <br>
                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-pill btn-success" type="submit" value="Consultar Disponibilidad">
                                        </div>
                                    </div>
                                </div>
                                <br>
                    </form>

        </div>


    </div>
@endsection
@push('scripts')
<script>
    $('#datepicker').datepicker({
        weekStart: 1,
        startDate: "today",
        endDate: "1/1/2021",
        language: "es",
        todayHighlight: true,
    });
</script>
@endpush
