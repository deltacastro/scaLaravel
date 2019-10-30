@extends('layouts.form.formGeneral')

@section('styles')
    <style>
        #table_id_wrapper {
            margin-top: 5%;
            text-align: center;
        }

        .container{
            left: 300px;
            right: 0px;
            position: absolute;
        }
    </style>
@endsection

@section('form-body')
    <div class="container">
        <div class="row">
            <div class="animated fadeIn delay-1s loadTable">
                @include('users._list')
            </div>
        </div>
    </div>
@endsection


@section('form-footer')
    
@endsection

@section('javascript')
    <script>
    </script>
@endsection