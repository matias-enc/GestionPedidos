@extends('admin_panel.index')



@section('content')

<div class="d-flex justify-content-center">


    <div class="col-8">
        <div class="card shadow-sm card-primary card-outline card-small">
            <div class="card-header ">
                <div class="d-flex justify-content-between">
                    <h3 class="my-auto"><strong>Estados</strong></h3>
                    <a class="btn btn-primary btn-pill btn-lg" href="{{ route("workflow.estados.create") }}">
                        Crear Estado
                        <i class="fal fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="roles" class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>Id Estado</th>
                                <th>Nombre de Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estados as $estado)
                            <tr>
                                <td>{{$estado->id}}</td>

                                <td>{{$estado->nombre}}</td>

                                <td><a class="btn btn-xs btn-primary"
                                        href="{{route('workflow.estados.show', $estado)}}">
                                        Ver
                                    </a></td>
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
