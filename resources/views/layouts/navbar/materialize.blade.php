<div class="navbar-fixed">
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
        <li>
            <a class="black-text" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar Sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        <li class="divider"></li>
        <li>
            <a class="waves-effect" href="{{ route('get.index') }}"><i class="material-icons">record_voice_over</i>
                Listado perifoneo
            </a>
        </li>
        <li>
            @if (Auth::user()->tipoUsuario == 1)
                <a class="waves-effect" href="{{ route('get.calendario') }}"><i class="material-icons">playlist_add</i>
                    Nuevo perifoneo
                </a>
            @endif
        </li>
    </ul>
    <nav class="white animated fadeInDownBig">
        <div class="nav-wrapper">
            <ul id="nav-mobile" class="right">
                <li>
                    <a class="dropdown-trigger black-text" href="#!" data-target="dropdown1">
                        {{ Auth::user()->email }}
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
            </ul>

        </div>
        <div class="navbar-fixed">
            <div class="progress">
                <div id="determinate" class="determinate" style="width: 0%"></div>
            </div>
        </div>
    </nav>
</div>