@extends('admin_panel.index')



@section('content')
<div class="col-lg-12">
    <a class="btn btn-success btn-pill" href="{{ route("workflow.estados.create") }}">
        <i class="fal fa-plus"></i> Nuevo Estado
    </a>
</div>
<div class="d-flex justify-content-center">


    <div class="col-8">


        <div class="card shadow-sm card-primary card-outline card-small">
            <div class="card-header pb-1">
                <h3><strong>Estados</strong></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="roles" class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>Id Estado</th>
                                <th>Nombre de Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estados as $estado)
                            <tr>
                                <td>{{$estado->id}}</td>

                                <td>{{$estado->nombre}}</td>
                            </tr>


                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function () {
          $('#roles').DataTable({
            "paging": true,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true

          });
        });
</script>
@endpush
