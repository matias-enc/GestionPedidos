@extends('admin_panel.index')



@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("transiciones.create") }}">
            Crear Transicion
        </a>
    </div>
</div>

<div class="card ">

    <div class="card-body">
        <div class="table-responsive">
            <table id="roles" class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($flujo->transiciones as $transicion)
                            <tr>
                                <td>{{$transicion->nombre}}</td>
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
          $('#roles').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "columns": [
    null,
    null,
    null,
    null,
    { "width": "15%" }
  ],

          });
        });
</script>
@endpush
