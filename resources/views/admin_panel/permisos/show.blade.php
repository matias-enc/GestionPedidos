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
                            {{ $permiso->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Slug
                        </th>
                        <td>
                            {{ $permiso->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Descripcion
                        </th>
                        <td>
                            {{ $permiso->description }}
                        </td>
                    </tr>


                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
