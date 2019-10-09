@extends('admin_panel.index')

@section('content')
<div class="card col-6 offset-3">
    <div class="card-body ">
        <div class="mb-2">


                <form action="{{ route("admin.roles.update", [$rol]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Nombre *</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($rol) ? $rol->name : '') }}" required>
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



                        <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                            <label for="permissions">Permisos*</label>
                            <select name="permissions[]" id="permissions" class="permissions-js form-control" multiple="multiple" required>
                                @foreach($permissions as $id => $permissions)
                                    <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($rol) && $rol->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('permissions'))
                                <p class="help-block">
                                    {{ $errors->first('permissions') }}
                                </p>
                            @endif
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="Guardar">
                        </div>

                    </form>



        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.permissions-js').select2();
        theme: "classic"
    });
</script>
@endpush
