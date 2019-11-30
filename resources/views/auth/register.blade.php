@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h2><strong class="text-primary">Registro</strong></h2>
                <a href="{{ route('login') }}" class="text-gray"><h6>Actualmente tienes una cuenta? <strong class="text-primary">Iniciar Sesion</strong></h6></a>
                <br>
                <div class="form-group">
                    <label for="name" class="text-md-right">{{ __('Name') }}</label>

                    <div class="">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="text-md-right">{{ __('Password') }}</label>

                    <div class="">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <div class="">
                        <button type="submit" class="btn btn-primary">
                            Registrarme
                        </button>
                    </div>
                </div>
                <br>
            </form>
        </div>

    </div>
</div>
@endsection
