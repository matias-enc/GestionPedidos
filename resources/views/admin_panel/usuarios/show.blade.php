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
                            Id
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nombre
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Email
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Roles
                        </th>
                        <td>
                            @foreach($user->roles as $roles)
                                <span class="badge badge-info">{{ $roles->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
