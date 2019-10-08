@extends('admin_panel.index')

@section('content')
<div class="card col-6 offset-3">
    <div class="card-body ">
        <div class="mb-2">
            <a style="margin-top:20px;margin-bottom:20px" class="btn btn-default" href="{{ url()->previous() }}">
                Volver a Lista
            </a>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Nombre
                        </th>
                        <td>
                            {{ $item->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tipo de Item
                        </th>
                        <td>
                            {{ $item->tipoItem->nombre }}
                        </td>
                    </tr>
                    @if ($item->capacidad != null)
                    <tr>
                        <th>
                            Capacidad
                        </th>
                        <td>
                            {{ $item->capacidad }}
                        </td>
                    </tr>
                    @endif
                    @if ($item->cantidad != null)
                    <tr>
                        <th>
                            Cantidad
                        </th>
                        <td>
                            {{ $item->cantidad }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th>
                            Descripcion
                        </th>
                        <td>
                            {{ $item->descripcion }}
                        </td>
                    </tr>


                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
