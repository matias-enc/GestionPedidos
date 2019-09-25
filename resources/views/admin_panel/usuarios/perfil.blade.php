@extends('admin_panel.index')

@section('content')
<!-- Default Light Table -->
@csrf
<div class="row justify-content-center">
        <div class="col-lg-3">
          <div class="card card-small mb-4 pt-3 card-outline card-primary">
            <div class="card-header border-bottom text-center">
              <div class="mb-3 mx-auto">
                <img class="rounded-circle shadow-sm" src={{asset('imagenes/user.png')}} alt="User Avatar" width="110">
              </div>
              <h4 class="mb-0">{{$user->name}}
                @if ($user->apellido!=null)
                    {{$user->apellido}}
                @endif
            </h4>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item px-4">
                <div class="progress-wrapper">
                  <strong class="text-muted d-block mb-2">Reputacion</strong>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100" style="width: 74%;">
                      <span class="progress-value">Muy buena</span>
                    </div>
                  </div>
                </div>
              </li>
              <li class="list-group-item p-4">
                <strong class="text-muted d-block mb-2">Descripcion</strong>
                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio eaque, quidem, commodi soluta qui quae minima obcaecati quod dolorum sint alias, possimus illum assumenda eligendi cumque?</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card card-small mb-4 card-outline card-primary">
            <div class="card-header border-bottom">
              <h6 class="m-0"><strong>Detalles de la Cuenta</strong></h6>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item p-3">
                <div class="row">
                  <div class="col">
                        <form action="{{ route("actualizar_perfil") }}" method="POST" enctype="multipart/form-data">
                                @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="feFirstName">Nombre</label>
                          <input type="text" class="form-control" id="feFirstName" name="name" placeholder="First Name" value="{{$user->name}}" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="feLastName">Apellidos</label>
                        <input type="text" class="form-control" id="feLastName" name="apellido" placeholder="Last Name" value="@if ($user->apellido!=null) {{$user->apellido}}

                          @endif"required>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="feEmailAddress">Email</label>
                          <input type="text" class="form-control" id="feEmailAddress" name="email" placeholder="Email" value="{{$user->email}} "required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="fePassword">Contraseña</label>
                        <input type="password" class="form-control" id="fePassword" placeholder="Contraseña" required value="" required>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="dni">DNI</label>
                          <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" value="@if ($user->dni!=null) {{$user->dni}}

                          @endif" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="telefono">Telefono</label>
                          <input type="text" class="form-control" name="telefono" id="telefono" placeholder="telefono" value="@if ($user->telefono!=null) {{$user->telefono}}

                          @endif" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="feInputAddress">Direccion</label>
                        <input type="text" class="form-control" id="feInputAddress"  placeholder="@if ($user->direccion!=null) {{$user->direccion}}

                        @endif">
                      </div>

                      <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Default Light Table -->
@endsection
@push('scripts')
@endpush
