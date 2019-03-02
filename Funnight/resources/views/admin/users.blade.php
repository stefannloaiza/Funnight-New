

<table class="table">
        <tr>
            <th class="text-center">Tipo de Usuario</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Apellido</th>
            <th class="text-center">Usuario</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Acciones</th>
            {{-- SELECT COUNT(likes.id),users.name FROM `likes`,`users` WHERE users.id=likes.user_id GROUP BY user_id --}}
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>
                @if( $user->role == 2 )
                    Usuario
                @else
                    Establecimiento
                @endif
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->surname }}</td>
            <td>{{ $user->nick }}</td>
            <td>
                @if( $user->userActive == 1 )
                    Activo
                @else
                    Inactivo
                @endif
            </td>
            <td>
                @if( $user->userActive == 1 )
                    {{-- <button type="button" class="btn btn-primary">Inactivar</button> --}}
                    <a name="userActive" id="userActive" class="btn btn-primary" href="{{ route('user.inactive',['user_id'=>$user->id]) }}" role="button">Inactivar</a>
                @else
                    <a name="userActive" id="userActive" class="btn btn-success" href="{{ route('user.active',['user_id'=>$user->id]) }}" role="button">Activar</a>
                @endif
            </td>
        </tr>
        @endforeach
</table>