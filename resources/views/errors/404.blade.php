@extends('admin_panel.index')
@section('content')
<div class="row justify-content-center pb-0 ">
    <h4 class="text-primary animated pulse infinite "
        style=" font-size: 250px; font-weight: 800; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
        404</h4>
    <br>
    {{-- <h4>Uste e tontos i se ha perdio.</h4> --}}
</div>
<div class="row justify-content-center">
    <h2>
        Parece que te has perdido!</h2>
</div>

<div class="row justify-content-center">
    <h4 class="text-gray">
        La pagina que estas buscando no existe o fue movida.</h4>
</div>
<br>
<div class="row justify-content-center">
<a href="{{URL::previous()}}" class="btn btn-pill btn-lg btn-outline-primary pl-3 pr-3">
        <i class="fal fa-arrow-left pr-1"></i>
        Volver
    </a>

</div>
@endsection
