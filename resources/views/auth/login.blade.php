@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col l4 offset-l4 m8 offset-m2 s12 z-depth-2 animated fadeIn fast white">
            <h5 class="center-align">Inicio de sesión</h5>
            <br>
            <form method="post">
                {{ csrf_field() }}
                <div class="input-field">
                    <label for="user">Usuario</label>
                    <input type="text" name="email" id="user" autocomplete="off">
                </div>
                <div class="input-field">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="password" id="pass">
                </div>
                <div class="cont-btn">
                    <br>
                    <input type="submit" class="btn center-align animated fadeIn" value="Ingresar">
                </div>
            </form>
        </div>
    </div>
    <div id="cont-logo" class="row center-align">
        <div class="col l4 offset-l4 m8 offset-m2 s12">
            <img src="{% static 'images/logo.png' %}" alt="" class="responsive-img animated fadeIn">
        </div>
    </div>
</div>
@endsection
