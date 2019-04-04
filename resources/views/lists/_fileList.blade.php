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
            <a href="#" class="btn red white-text guardar" data-action="" data-target="calendario">
                <i class="large material-icons">delete_forever</i>
            </a>
        </div>
    </div>
@empty
    Sin registros
@endforelse