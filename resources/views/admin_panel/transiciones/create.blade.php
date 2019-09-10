@extends('admin_panel.index')

@section('content')
<div class="card col-6 offset-3">
    <div class="card-body ">
        <form action="{{ route("workflow.transiciones.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="nombre">Nombre*</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', isset($transicion) ? $transicion->nombre : '') }}" required>
                @if($errors->has('nombre'))
                    <p class="help-block">
                        {{ $errors->first('nombre') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('estados') ? 'has-error' : '' }}">
                <label for="flujoTrabajo_id">Flujo de Trabajo*</label>
                <select name="flujoTrabajo_id" id="flujoTrabajo_id" class="flujoTrabajo-js form-control" required>
                    @foreach($flujos as $id => $flujos)
                        <option value="{{ $id }}" {{ (in_array($id, old('flujos', [])) || isset($transicion) && $transicion->flujoTrabajo->contains($id)) ? 'selected' : '' }}>{{ $flujos }}</option>
                    @endforeach
                </select>
                @if($errors->has('flujoTrabajo_id'))
                    <p class="help-block">
                        {{ $errors->first('flujoTrabajo_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('estados') ? 'has-error' : '' }}">
                    <label for="estadoInicial_id">Estado Inicial*</label>
                    <select name="estadoInicial_id" id="estadoInicial_id" class="estados-js form-control" required>
                        @foreach($estados as $id => $estado)
                            <option value="{{ $id }}" {{ (in_array($id, old('estados', [])) || isset($transicion) && $transicion->estadoInicial->contains($id)) ? 'selected' : '' }}>{{ $estado }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('estadoInicial_id'))
                        <p class="help-block">
                            {{ $errors->first('estadoInicial_id') }}
                        </p>
                    @endif
                    {{-- {{unset($estados);}} --}}
            </div>
            <div class="form-group {{ $errors->has('estados') ? 'has-error' : '' }}">
                    <label for="estadoFinal_id">Estado Final*</label>
                    <select name="estadoFinal_id" id="estadoFinal_id" class="estados-js form-control" required>
                        @foreach($estados as $id => $estado)
                            <option value="{{ $id }}" {{ (in_array($id, old('estados', [])) || isset($transicion) && $transicion->estadoFinal->contains($id)) ? 'selected' : '' }}>{{ $estado }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('estadoFinal_id'))
                        <p class="help-block">
                            {{ $errors->first('estadoFinal_id') }}
                        </p>
                    @endif
                    {{-- {{unset($estados);}} --}}
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="Guardar">
            </div>

            </form>
    </div>
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
