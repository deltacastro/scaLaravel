@extends('layouts.form.formGeneral')

@section('styles')
    <style>
        #cont {
            margin-top: 10%;
        }

        .container {
            /* left: 300px; */
            right: 0px;
            position: absolute;
            width: 40%;
        }

        .responsive-img{
            width: 100% !important;
            margin-bottom: 20px;
        }

        .card-content p {
            font-size: 20px;
        }
    </style>
@endsection

@section('form-body')
<div class="container">
    <div class="row">
        <div class="animated fadeIn delay-1s" id="cont">
            <div class="row">
                <h5>{{ $title }}</h5>
                <br>
                <div class="divider"></div>
                <br>
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
                            <p><b>Nombre del archivo:</b>  {{ $evidencia->nombre }}</p>
                            <p><b>Fecha:</b> {{ $evidencia->fecha }}</p>
                        </div>
                    </div>
                @empty
                    No hay evidencias.
                @endforelse
                <br>
            </div>
        </div>
    </div>
</div>
@endsection