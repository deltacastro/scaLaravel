<aside>
    <ul id="slide-out" class="sidenav sidenav-fixed animated fadeInLeftBig">
        <li>
            <div class="user-view">
                <div class="background">
                    <!-- <img src="images/office.jpg"> -->
                </div>
                <a href="#user"><img class="circle" src="default-user.jpg"></a>
                <a href="#name"><span class="black-text name">{{ Auth::user()->name }}</span></a>
                <a href="#email"><span class="black-text email">{{ Auth::user()->email }}</span></a>
            </div>
        </li>
        <li>
            <div class="divider"></div>
        </li>
        <li>
            <a class="waves-effect" href="{{ route('get.index') }}"><i class="material-icons">record_voice_over</i>
                Listado perifoneo
            </a>
        </li>
        <li>
            <a class="waves-effect" href="{{ route('get.calendario') }}"><i class="material-icons">record_voice_over</i>
                Nuevo perifoneo
            </a>
        </li>
    </ul>
</aside>