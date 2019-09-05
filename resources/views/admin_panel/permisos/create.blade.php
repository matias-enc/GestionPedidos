@extends('admin_panel.index')

@section('content')
<div class="card col-6 offset-3">
    <div class="card-body ">
        <form action="{{ route("admin.permisos.store") }}" method="POST" enctype="multipart/form-data">
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
                <input type="slug" id="slug" name="slug" class="form-control" value="{{ old('slug', isset($permiso) ? $permiso->slug : '') }}" required>
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
            <div>
                <input class="btn btn-danger" type="submit" value="Guardar">
            </div>
        </form>
    </div>
</div>
@endsection

