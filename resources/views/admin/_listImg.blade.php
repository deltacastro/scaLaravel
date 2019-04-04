@extends('layouts.form.formGeneral')

@section('styles')
    <style>
        #cont {
            margin-top: 10%;
        }

        .container {
            left: 300px;
            right: 0px;
            position: absolute;
            width: 40%;
        }

        .responsive-img{
            width: 100% !important;
            margin-bottom: 20px;
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
                    <h6>{{ $evidencia->fecha }}</h6>
                    @if ($evidencia->extension == 'pdf')
                        <embed height="400px" src="{{ asset('storage/' . $evidencia->path) }}" type="" width="100%">
                    @else
                        <img class="responsive-img z-depth-4" src="{{ asset('storage/' . $evidencia->path) }}" alt="">
                    @endif
                @empty
                    si vz esto, ago malo debe estar pasando!
                    <a src="{{ asset('storage/' . $evidencia->path) }}">Descargame</a>
                @endforelse
                <br>
            </div>
        </div>
    </div>
</div>
@endsection