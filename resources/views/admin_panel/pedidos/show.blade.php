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
                          <h3 class="profile-username text-center">{{$pedido->id}}</h3>
                          <p class="text-muted text-center">Id del Pedido</p>
                          <h3 class="profile-username text-center">Estado actual: <span class="text-success">{{$pedido->estado->nombre}}</span></h3>




                        </div>
                        <!-- /.card-body -->
                      </div>


                            <div class="card card-primary card-outline col-md-6 offset-1">
                                    <div class="card-body box-profile">
                                      <div class="text-center">
                                        {{-- <img class="profile-user-img img-fluid img-circle"
                                             src="../../dist/img/user4-128x128.jpg"
                                             alt="User profile picture"> --}}
                                      </div>

                                      <h3 class="profile-username text-center">Historial de Estados</h3>

                                      <table id="transicion" class="table table-bordered table-striped table-hover datatable">
                                            <thead>
                                            <tr>
                                              <th>Estado</th>
                                              <th>Fecha</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pedido->historiales as $historial)
                                                    <tr>
                                                        <td>{{$historial->estado->nombre}}</td>
                                                        <td>{{date('d-m-Y', strtotime($historial->created_at))}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                          </table>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                              <!-- /.card -->
        </div>
</div>



@endsection
