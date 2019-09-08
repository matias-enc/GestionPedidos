@extends('admin_panel.index')

@section('content')
<div class="card col-6 offset-3">
    <div class="card-body ">
        <form action="{{ route("transiciones.store") }}" method="POST" enctype="multipart/form-data">
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
                <label for="flujoTrabajo">Flujo de Trabajo*</label>
                <select name="flujoTrabajo" id="flujoTrabajo" class="flujoTrabajo-js form-control" required>
                    @foreach($flujos as $id => $flujos)
                        <option value="{{ $id }}" {{ (in_array($id, old('flujos', [])) || isset($transicion) && $transicion->flujoTrabajo->contains($id)) ? 'selected' : '' }}>{{ $flujos }}</option>
                    @endforeach
                </select>
                @if($errors->has('estados'))
                    <p class="help-block">
                        {{ $errors->first('estados') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('estados') ? 'has-error' : '' }}">
                    <label for="estadoInicial">Estado Inicial*</label>
                    <select name="estadoInicial" id="estadoInicial" class="estadoInicial-js form-control" required>
                        @foreach($estado1 as $id => $estados)
                            <option value="{{ $id }}" {{ (in_array($id, old('estados', [])) || isset($transicion) && $transicion->estadoInicial->contains($id)) ? 'selected' : '' }}>{{ $estados }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('estados'))
                        <p class="help-block">
                            {{ $errors->first('estados') }}
                        </p>
                    @endif
            </div>
            <div class="form-group {{ $errors->has('estados') ? 'has-error' : '' }}">
                <label for="estadoFinal">Estado Final*</label>
                <select name="estadoFinal" id="estadoFinal" class="estadoFinal-js form-control" required>
                    @foreach($estado2 as $id => $estados)
                        <option value="{{ $id }}" {{ (in_array($id, old('estados', [])) || isset($transicion) && $transicion->estadoFinal->contains($id)) ? 'selected' : '' }}>{{ $estados }}</option>
                    @endforeach
                </select>
                @if($errors->has('estados'))
                    <p class="help-block">
                        {{ $errors->first('estados') }}
                    </p>
                @endif
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
        $('.estadoInicial-js').select2();
        theme: "classic"
    });
</script>
<script>
    $(document).ready(function() {
        $('.estadoFinal-js').select2();
        theme: "classic"
    });
</script>
@endpush
