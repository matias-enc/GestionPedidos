<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>


</head>

<body>
    <br><br><br><br><br>
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card shadow-sm border-light" >
                {{-- <div class="card-body p-0"> --}}
                    <div class="row align-items-center" style="min-height: 400px">
                        <div class="col-5 pt-5 border-right border-light">
                            @yield('content')
                        </div>
                        <div class="col-7 ">
                            <div class="row justify-content-center">
                                <img src="{{asset('imagenes/escudo-apostoles.png')}}" class="img-fluid" alt=""
                                    style="height: 250px">
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>

    </div>
</body>

</html>
