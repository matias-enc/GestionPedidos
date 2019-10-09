@extends('admin_panel.index')

@section('content')
<div class="d-flex justify-content-center">
    <div class="col-6">
        <div class="card card-outline card-primary card-small">
            <div class="card-header pb-1">
                <h3>Nuevo Estado</h3>
            </div>
            <div class="card-body ">
                <form action="{{ route("workflow.estados.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="nombre"><strong>Nombre del Estado</strong></label>
                        <input type="text" id="nombre" name="nombre" class="form-control"
                            value="{{ old('nombre', isset($transicion) ? $transicion->nombre : '') }}" required>
                        @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <div>
                            <input class="btn btn-pill btn-success" type="submit" value="Guardar">
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
@endsection
