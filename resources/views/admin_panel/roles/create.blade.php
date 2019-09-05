@extends('admin_panel.index')

@section('content')
<div class="card col-6 offset-3">
    <div class="card-body ">
        <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Nombre*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                <label for="slug">Slug*</label>
                <input type="slug" id="slug" name="slug" class="form-control" value="{{ old('slug', isset($rol) ? $rol->slug : '') }}" required>
                @if($errors->has('slug'))
                    <p class="help-block">
                        {{ $errors->first('slug') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Description</label>
                <input type="description" id="description" name="description" class="form-control" required>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                    <label for="permisos">Permisos*</label>
                    <select name="permisos[]" id="permisos" class="permisos-js form-control" multiple="multiple" required>
                        @foreach($permisos as $id => $permisos)
                            <option value="{{ $id }}" {{ (in_array($id, old('permisos', [])) || isset($user) && $user->permisos->contains($id)) ? 'selected' : '' }}>{{ $permisos }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('permisos'))
                        <p class="help-block">
                            {{ $errors->first('permisos') }}
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
        $('.permisos-js').select2();
        theme: "classic"
    });
</script>
@endpush
