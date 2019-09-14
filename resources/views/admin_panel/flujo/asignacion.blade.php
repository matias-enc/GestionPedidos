@extends('admin_panel.index')

@section('content')
<div class="card card-primary card-outline col-8 offset-2">

        <div class="card-header">
                <div class="card-title">
                    Nueva Transicion
                </div>
            </div>
    <div class="card-body ">
        <form action="{{ route("workflow.flujos.asignacion") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="fechaInicial" name="fechaInicial" class="form-control" value="{{$fechaInicial}}">
            <input type="hidden" id="fechaFinal" name="fechaFinal" class="form-control" value="{{$fechaFinal}}">
            <table id="roles" class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                      <th>Nombre Transicion</th>
                      <th>Estado Inicial</th>
                      <th>Estado Final</th>
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
                                            <select name="estadoInicial_id" id="estadoInicial_id" class="estados-js form-control" required>
                                                @foreach($estados as $id => $estado)
                                                    <option value="{{ $id }}" >{{ $estado }}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                </td>

                                <td>

                                    <div class="form-group {{ $errors->has('estadoFinal_id') ? 'has-error' : '' }}">
                                            <select name="estadoFinal_id" id="estadoFinal_id" class="estados-js form-control" required>
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
            Transiciones Asignadas
        </div>
    </div>
        <div class="card-body box-profile">
          <table id="transicion" class="table table-bordered table-striped table-hover datatable">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Estado Inicial</th>
                  <th>Estado Final</th>
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

@endpush
