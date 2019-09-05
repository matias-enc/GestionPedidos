@extends('admin_panel.index')

@section('content')
{{-- <div class="card col-6 offset-3">
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
</div> --}}

<div class="card card-primary card-outline col-md-3 offset-4">
    <div class="card-body box-profile">
      <div class="text-center">
        {{-- <img class="profile-user-img img-fluid img-circle"
             src="../../dist/img/user4-128x128.jpg"
             alt="User profile picture"> --}}
      </div>

      <h3 class="profile-username text-center">{{$user->name}}</h3>

      <p class="text-muted text-center">Software Engineer</p>

      <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
          <b>{{$user->email}}</b>
        </li>
        <li class="list-group-item">
            <td>
                @foreach($user->roles as $roles)
                    <span class="badge badge-info">{{ $roles->name }}</span>
                @endforeach
            </td>
        </li>
      </ul>

      <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-block"><b>Editar Usuario</b></a>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection
