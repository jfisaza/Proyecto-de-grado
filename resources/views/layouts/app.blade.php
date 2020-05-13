<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/propuesta.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.13.0-web/css/all.css') }}">
    
</head>
<body>
<header>
        <input type="checkbox" name="btn-menu" id="btn-menu">
        <label for="btn-menu"><span class="fas fa-bars"></span></label>
        
        <article class="logo">
            <a href="{{ url('/') }}"><img class="img" src="{{ asset('img/uts-logo.png') }}" height="70px" width="110px"></a>
        </article>

        <nav class="menu">
            <ul>
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ action('BancoController@index') }}">Banco De Ideas</a></li>
                <li><a href="{{ action('EstudiantesController@index') }}">Estudiantes</a></li>
                <li><a href="{{ action('DocentesController@index') }}">Docentes</a></li>
                <li><a href="{{ action('AdministrativosController@index') }}">Administrativos</a></li>

                @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombres }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ url('/home') }}" id="logout">Mi Cuenta <span class="fas fa-user"></span></a>
                                    <a id="logout" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión <span class="fas fa-sign-out-alt"></span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                </li>
            </ul>
        </nav>
        </article>
    </header>
    <div class="contenedor">
        @yield('content')
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
