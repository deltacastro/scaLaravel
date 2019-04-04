<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Link</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($evidenciasAll as $data)
            <tr>    
                <td>{{ $data->nombre }}</td>
                <td>
                    <a href="{{ asset('storage/'.$data->path) }}"">Mirame</a>
                </td>
                <td>{{ $data->id }}</td>
            </tr>
        @endforeach
    </tbody>
</table>