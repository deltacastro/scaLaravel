<div class="navbar-fixed">
    <nav class="white animated fadeInDownBig">
        <div class="nav-wrapper">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a class="black-text" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
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