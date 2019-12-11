<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/stylesheet.css') }}">
    <style>
        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h1,
        .h1 {
            font-size: 2.5rem;
        }

        h2,
        .h2 {
            font-size: 2rem;
        }

        h3,
        .h3 {
            font-size: 1.75rem;
        }

        h4,
        .h4 {
            font-size: 1.5rem;
        }

        h5,
        .h5 {
            font-size: 1.25rem;
        }

        h6,
        .h6 {
            font-size: 1rem;
        }

        article,
        aside,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section {
            display: block;
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }

        .imagen {
            height: 80px;
            width: 100px;
        }

        @page {
            margin: 100px 55px;
            margin-bottom: 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 15%;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        body {
            height: 80%;
            margin-bottom: 4%;
            margin-top: 4%;
        }

        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 10%;
        }

        p {
            page-break-after: always;
        }

        p:last-child {
            page-break-after: never;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        td,
        .tend {
            text-align: end;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .text-center {
            text-align: center !important;
        }

        .float-right {
            float: right !important;
        }
    </style>
</head>
<header>

    <div class="row" style="height: 100px">
        <div class="img">

            <img class="imagen" src="{{asset("imagenes/escudo-apostoles.png")}}" alt="">
        </div>
        <div class="justify-content-center">
            <div class="text-center">

                <h5><strong>MUNICIPALIDAD DE APOSTOLES</strong></h5>
                <h6><strong>Juan de San Martín 70, N3350 Apóstoles, Misiones</strong></h6>
                <h6><strong>Telefono: (03758) 42-2194</strong></h6>

            </div>
        </div>
        <div class="float-right" style="font-size: 12px">
            <h6><strong>Fecha:</strong> {{ Carbon\Carbon::now()->format('d/m/Y') }}</h6>
            <h6><strong>Hora:</strong> {{ Carbon\Carbon::now()->format('H:i' ) }}</h6>
            <h6><strong>Emisor:</strong> {{ auth()->user()->name }}</h6>
        </div>
    </div>
</header>

<body>

    @yield('content')

</body>
<footer></footer>

</html>
