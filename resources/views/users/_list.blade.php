<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Nivel Usuario</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($userList as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->tipoUsuario }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.user.edit', ['user' => $item]) }}">Editar</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No hay ningun usuario... espera, como es que uedes estar  aqui..</td>
            </tr>
        @endforelse
    </tbody>
</table>