@extends('admin_panel.index')

@section('content')
<div class="card col-6 offset-3">
    <div class="card-body ">
            <div class="card-body">
                    <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
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
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            @if($errors->has('password'))
                                <p class="help-block">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                                <label for="roles">Roles*</label>
                                <select name="roles[]" id="roles" class="roles-js form-control" multiple="multiple" required>
                                    @foreach($roles as $id => $roles)
                                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('roles'))
                                    <p class="help-block">
                                        {{ $errors->first('roles') }}
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
        $('.roles-js').select2();
        theme: "classic"
    });
</script>
@endpush
