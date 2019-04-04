<table class="table">
    <thead>
        <tr>
            <th>Horas</th>
            <th>Fechas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calendarioAll as $data)
            <tr>
                <td>{{ $data->hora }}</td>
                <td>{{ $data->fecha }}</td>
                <td>
                    <a class="btn btn-default eliminar" title="Eliminar" data-formtarget="form{{ $data->id }}"><i class="fa fa-trash-alt"></i></a>
                    <form id="form{{ $data->id }}" action="{{ route('post.calendarioEliminar',['calendario' => $data]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>