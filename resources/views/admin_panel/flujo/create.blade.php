@extends('admin_panel.index')

@section('content')
<div class="card card-outline card-primary col-6 offset-3">
    <div class="card-header">
        <div class="card-title">
            <strong>Crear Nuevo Flujo de Trabajo</strong>
        </div>
    </div>
    <div class="card-body ">
        <form action="{{ route("workflow.flujos.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="nombre">Nombre*</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', isset($transicion) ? $transicion->nombre : '') }}" required>
                @if($errors->has('nombre'))
                    <p class="help-block text-danger">
                        {{ $errors->first('nombre') }}
                    </p>
                @endif
            </div>
                <div>
                    <input class="btn btn-primary" type="submit" value="Guardar">
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
@endpush
