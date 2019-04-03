@extends('layouts.form.formGeneral')

@section('style')
    <style>
        #cont {
            margin-top: 5%;
        }

        .container {
            width: 60%;
        }

        .responsive-img{
            width: 50% !important;
        }
    </style>
@endsection

@section('form-body')
<div class="container">
    <div class="row">
        <div class="col offset-l4 l8 animated fadeIn delay-1s" id="cont">
            <div class="row">
                <h5>{{ $title }}</h5>
                <br>
                <div class="divider"></div>
                @forelse ($evidencias as $evidencia)
                    @if ($evidencia->extension == 'img')
                        <img class="responsive-img" src="{{ asset('storage/' . $evidencia->path) }}" alt="">
                    @elseif ($evidencia->extension == 'pdf')
                        <embed src="{{ asset('storage/' . $evidencia->path) }}" type="" width="100%">
                    @else
                            <label for="">No reconozco tu extension, pero te envio una liga</label>
                        <a href=""></a>
                    @endif
                @empty
                    si vz esto, ago malo debe estar pasando!
                @endforelse
                <br>
            </div>
        </div>
    </div>
</div>
@endsection