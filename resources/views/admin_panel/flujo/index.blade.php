@extends('admin_panel.index')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 offset-1">
            <a class="btn btn-success btn-pill" href="{{ route("workflow.flujos.create") }}">
                Crear Nuevo Flujo de Trabajo
            </a>
        </div>
    </div>
<div class="card col-10 offset-1">

    <div class="card-body">
        <div class="table">
            <table id="flujos" class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                      <th>nombre</th>
                      <th>transiciones</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($flujos as $flujo)
                            <tr>
                                <td>{{$flujo->nombre}}</td>
                                <td>
                                    @foreach($flujo->transiciones as $tr)
                                        <span class="badge badge-pill badge-info">{{ $tr->nombre }}</span>
                                    @endforeach
                                </td>
                                <td>
                                        <a class="btn btn-xs btn-primary" href="{{route('workflow.flujos.show', $flujo)}}">
                                            Ver
                                        </a>

                                        <a class="btn btn-xs btn-info" href="#">
                                            Editar
                                        </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
        $(function () {
          $('#flujos').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": false,
          });
        });
</script>
@endpush
