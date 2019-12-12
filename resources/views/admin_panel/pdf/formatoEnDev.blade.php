<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('admin_panel/plugins/bootstrap/css/bootstrap.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('fonts/stylesheet.css') }}"> --}}
    <style>
        /* html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        } */
    </style>
</head>
<header style="padding-left: 55px; padding-right: 55px">

    {{-- <h4>NOTA DE SOLICITUD</h4> --}}
    <h5 style="float: right; font-weight: lighter; font-size: 15px">Apostoles, Misiones. {{$fecha}} </h5>

</header>

<body>
    <div style="padding-top: 55px; padding-left: 55px; padding-right: 55px; line-height: 20px; font-size: 19px">
        <h5>    Municipalidad de Apostoles, Misiones <br>
            Juan de San Martín 70 - N3350 - Apóstoles, Misiones <br>
            S_____________/_____________D:
        </h5>
        @yield('content')
    </div>

    {{-- <h6><strong>Telefono: (03758)42-2194</strong></h6> --}}


</body>
<footer></footer>

</html>
