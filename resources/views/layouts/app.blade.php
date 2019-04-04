<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SCA') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/dataTables.min.css') }}">
    <link href="{{ asset('css/icon.css') }}" rel="stylesheet">
    <style>
        #table_id_wrapper {
            margin-top: 5%;
        }
        #cover {
            background-color: rgba(91, 91, 91, .5);
            position: absolute;
            height: 100%;
            width: 100%;
        }
    </style>
    @yield('styles')
</head>
<body>
    <header>
        @auth
            @include('layouts.navbar.materialize')
        @endauth
    </header>
        <div id="cover"></div>
        <!-- rest of the page... -->
        @auth
            @include('layouts.navbar.aside')
        @endauth
        @yield('content')
        {{-- <div id="app">
            @include('layouts.navbar.general')
        <div>
            @yield('content')
        </div>
    </div> --}}

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/materialize.min.js') }}"></script>
    <script src="{{ ('/js/dataTables.min.js') }}"></script>
    <script type="text/javascript">
        $(window).on('load', function(){
            $('#cover').fadeOut(1000);
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var delay = ( function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };
        })();
        $(document).ajaxStart(function() {
                $('#cover').fadeIn(1000);
                let determinate = document.getElementById('determinate');
                determinate.style.width = '50%'
            })
            .ajaxStop(function() {
                $('#cover').fadeOut(1000);
                let determinate = document.getElementById('determinate');
                determinate.style.width = '100%'
                delay(function(){
                    // determinate.hidden = true;
                    determinate.style.width = '0%'
                }, 500)
            }).ajaxComplete(function() {
                $('#cover').fadeOut(1000);
                let determinate = document.getElementById('determinate');
                determinate.style.width = '100%'
                delay(function(){
                    // determinate.hidden = true;
                    determinate.style.width = '0%'
                }, 500)
            });
    </script>
    @yield('javascript')
</body>
</html>
