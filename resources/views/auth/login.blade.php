@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h2><strong class="text-primary">Bienvenido,</strong></h2>
                <h4><strong class="">Ingresa al Sistema</strong></h4>
                <br>
                <div class="form-group">
                    <label for="email" class=" text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="password" class=" text-md-right">{{ __('Password') }}</label>

                    <div class="">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <br>
                <div class="form-group ">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <a class="btn  btn-outline-primary w-100" href="{{ route('register') }}">Registrarme</a>

                    </div>

                    {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                    </a>
                    @endif --}}
                </div>
                <br>
            </form>
        </div>

    </div>
</div>
@endsection
