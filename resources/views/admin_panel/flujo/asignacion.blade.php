@extends('admin_panel.index')

@section('content')
<div class="card card-primary card-outline col-8 offset-2">

        <div class="card-header">
                <div class="card-title">
                    Nueva Asignacion de Estado
                </div>
            </div>
    <div class="card-body ">
        <form action="{{ route("workflow.flujos.asignacion") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table id="roles" class="table table-bordered ">
                    <thead>
                    <tr>
                      <th>Nombre del Estado</th>
                      <th>Paso Inicial</th>
                      <th>Paso Final</th>
                    </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>
                                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', isset($transicion) ? $transicion->nombre : '') }}" required>
                                            <input type="hidden" id="flujoTrabajo_id" name="flujoTrabajo_id" class="form-control" value="{{$flujo->id}}">
                                            @if($errors->has('nombre'))
                                                <p class="help-block">
                                                    {{ $errors->first('nombre') }}
                                                </p>
                                            @endif
                                        </div>
                                </td>

                                <td>

                                    <div class="form-group {{ $errors->has('estadoInicial_id') ? 'has-error' : '' }}">
                                            <select name="estadoInicial_id" id="estadoInicial_id" class=" form-control" required>
                                                @foreach($estados as $id => $estado)
                                                    <option value="{{ $id }}" >{{ $estado }}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                </td>

                                <td>

                                    <div class="form-group {{ $errors->has('estadoFinal_id') ? 'has-error' : '' }}">
                                            <select name="estadoFinal_id" id="estadoFinal_id" class="form-control" required>
                                                @foreach($estados as $id => $estado)
                                                    <option value="{{ $id }}">{{ $estado }}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                </td>

                            </tr>

                        </tbody>
                  </table>

            <div >
                <input class="btn btn-success" type="submit" value="Asignar">
            </div>
            </form>
    </div>
</div>

<div class="card card-primary card-outline col-md-8 offset-2">
    <div class="card-header">
        <div class="card-title">
            Estados Asignados
        </div>
    </div>
        <div class="card-body box-profile">
          <table id="transiciones" class="table table-bordered table-striped table-hover datatable">
                <thead>
                <tr>
                  <th>Nombre Estado</th>
                  <th>Paso Inicial</th>
                  <th>Paso Final</th>
                  <th>Accion</th>

                </tr>
                </thead>
                <tbody>
                    @foreach ($flujo->transiciones as $transicion)
                        <tr>
                            <td>{{$transicion->nombre}}</td>
                            <td>{{$transicion->estadoInicial->nombre}}</td>
                            <td>{{$transicion->estadoFinal->nombre}}</td>
                            <td>
                                <form action="{{ route('workflow.transiciones.destroy', $transicion) }}" method="POST" onsubmit="return confirm('Esta seguro que desea borrar la transicion {{$transicion->nombre}}?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Borrar" >
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

        </div>
        <!-- /.card-body -->
      </div>
@endsection
@push('scripts')

<script>
    $(document).ready(function() {
        $('.flujoTrabajo-js').select2();
        theme: "classic"
    });
</script>
<script>
    $(document).ready(function() {
        $('.estados-js').select2();
        theme: "classic"
    });
</script>
<script>
$(function () {
          $('#transiciones').DataTable({
            "paging": false,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "searching": true,
            "ordering": true,
            "info": false,
            "columns": [
    { "width": "25%" },
    null,
    null,
    { "width": "10%" }
  ],
          });
        });
</script>

@endpush
