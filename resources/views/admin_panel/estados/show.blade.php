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
                            {{ $rol->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Descripcion
                        </th>
                        <td>
                            {{ $rol->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Slug
                        </th>
                        <td>
                            {{ $rol->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Permisos
                        </th>
                        <td>
                            @foreach($rol->permissions as $permiso)
                                <span class="badge badge-info">{{ $permiso->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
