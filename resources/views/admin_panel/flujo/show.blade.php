@extends('admin_panel.index')
@section('content')
<div class="container-fluid">
        <div class="row">
                <div class="card card-primary card-outline col-md-3 offset-1 h-100">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            {{-- <img class="profile-user-img img-fluid img-circle"
                                 src="../../dist/img/user4-128x128.jpg"
                                 alt="User profile picture"> --}}
                          </div>
                          <h3 class="profile-username text-center">{{$flujo->nombre}}</h3>
                          <p class="text-muted text-center">Nombre del Flujo de Trabajo</p>




                        </div>
                        <!-- /.card-body -->
                      </div>


                            <div class="card card-primary card-outline col-md-6 offset-1">
                                    <div class="card-body">
                                      <div class="text-center">
                                        {{-- <img class="profile-user-img img-fluid img-circle"
                                             src="../../dist/img/user4-128x128.jpg"
                                             alt="User profile picture"> --}}
                                      </div>

                                      <h3 class="profile-username text-center">Transiciones</h3>

                                      <table id="transicion" class="table table-bordered table-striped table-hover datatable">
                                            <thead>
                                            <tr>
                                              <th>Transicion</th>
                                              <th>Paso Inicial</th>
                                              <th>Paso Final</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($flujo->transiciones as $tran)
                                                    <tr>
                                                        <td>{{$tran->nombre}}</td>
                                                        <td>{{$tran->estadoInicial->nombre}}</td>
                                                        <td>{{$tran->estadoFinal->nombre}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                          </table>
                                          <br>
                                          <a href="{{ route('workflow.flujos.asignarTransiciones', $flujo->id) }}" class="btn btn-primary btn-pill"><b>Asignar Transiciones &rarr;</b></a>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                              <!-- /.card -->
        </div>
</div>



@endsection
