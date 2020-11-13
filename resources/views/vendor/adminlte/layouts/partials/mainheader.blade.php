<header class="main-header">
    <a href="{{ url('/') }}" class="logo">
        <span class="logo-mini"><b>A</b>NB</span>
        <span class="logo-lg"><b>Naive</b>  Bayes</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">Documentación</a></li>
                    <li><a href="{{ url('/login') }}">Cerrar Sesión</a></li>
                @else
                    <li class="dropdown user user-menu" id="user_menu" style="max-width: 280px;white-space: nowrap;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="max-width: 280px;white-space: nowrap;overflow: hidden;overflow-text: ellipsis">
                            <img src="{{ asset('/img/sin_foto.png') }}" class="user-image" alt="User Image"/>
                            <span class="hidden-xs" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header" style="height: 190px;">
                                <img src="{{ asset('/img/sin_foto.png') }}" class="img-circle" alt="User Image" />
                                <p>
                                    <span data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</span>
                                </p>
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    <input type="submit" value="logout" style="display: none;">
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
