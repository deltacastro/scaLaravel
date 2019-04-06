@forelse ($evidencias as $evidencia)
    <div class="card">
        <div class="card-image">
            @if ($evidencia->extension == 'pdf')
                <embed height="400px" src="{{ asset('storage/' . $evidencia->path) }}" type="" width="100%">
            @else
                <img src="{{ asset('storage/' . $evidencia->path) }}" alt="">
            @endif
            <span class="card-title">{{ $evidencia->nombre }}</span>
        </div>
        <div class="card-content">
            <p>{{ $evidencia->nombre }}</p>
            <p>{{ $evidencia->fecha }}</p>
        </div>
        <div class="card-action right-align">
            <a class="btn red eliminar" title="Eliminar" data-formtarget="form{{ $evidencia->id }}"><i class="large material-icons">delete_forever</i></a>
            <form id="form{{ $evidencia->id }}" action="{{ route('post.calendarioEliminar',['evidencia' => $evidencia->id]) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
            </form>
        </div>
    </div>
@empty
    Sin registros
@endforelse