<table id="table_id" class="display cell-border">
    <thead>
        <tr>
            {{-- <th>Folio</th> --}}
            <th>Mes</th>
            {{-- <th>Total de horas</th> --}}
            <th>Municipio</th>
            <th>Calendario</th>
            <th>Reporte Entrada y Salida</th>
            <th>GPS</th>
            @if (Auth::user()->tipoUsuario == 1)
                <th>Opciones</th>    
            @endif
        </tr>
    </thead>
    <tbody class="bodyList">
        @foreach ($modelList as $data)
        <tr>
            {{-- <td>{{ $data->folio }}</td> --}}
            <td>{{ $data->fechaInicioMes }}</td>
            {{-- <td>{{ $data->totalHoras }}</td> --}}
            <td>{{ $data->municipio->nombre }}</td>
            <td>
                @if ($data->checkCalendario() > 0)
                    <a target="_blank" href="{{ route('get.listImg', ['registro' => $data, 'tipo' => 1]) }}"><i class="material-icons">visibility</i></a>    
                @endif
            </td>
            <td>
                @if ($data->checkReporte() > 0)
                    <a target="_blank" href="{{ route('get.listImg', ['registro' => $data, 'tipo' => 2]) }}"><i class="material-icons">visibility</i></a>
                @endif
            </td>
            <td>
                @if ($data->checkGps() > 0)
                    <a target="_blank" href="{{ route('get.listImg', ['registro' => $data, 'tipo' => 3]) }}"><i class="material-icons">visibility</i></a>
                @endif
            </td>
            @if (Auth::user()->tipoUsuario == 1)
                <td>
                    <a target="_blank" href="{{ route('get.editRegistro', ['registro' => $data]) }}"><i class="material-icons">edit</i></a>
                    <a title="Eliminar" data-formtarget="form{{ $data->id }}"><i class="material-icons">delete</i></a>
                    <form id="form{{ $data->id }}" action="{{ route('post.registroEliminar',['registro' => $data->id]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </td>
            @endif
            </tr> 
        @endforeach
    </tbody>
</table>