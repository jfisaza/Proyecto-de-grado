<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('img/uts-logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome-free-5.13.0-web/css/all.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2&display=swap" rel="stylesheet">

    <title>Trabajo de grado - Unidades Tecnológicas de Santander</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
<div id="contenedor_carga">
    <div id="carga"></div>
</div>

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
                <li><a href="{{ url('/ayuda') }}">Ayuda</a></li>
                <li><a href="https://www.dropbox.com/sh/op8bmnpioxnutkq/AAA3aYa4B9loRyLJkkcaX3Sma/DOCUMENTOS%20DE%20GRADO?dl=0&subfolder_nav_tracking=1">Documentos de grado</a></li>
                <li><a href="http://www.uts.edu.co/sitio/">UTS</a></li>
                <li><a href="http://www.uts.edu.co/sitio/wp-content/uploads/normatividad/reglamento_trabajo_grado.pdf">Reglamento Trabajos de grado</a></li>

                @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombres }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ url('/home') }}" id="logout">Mi Cuenta <span class="fas fa-user"></span></a>
                                    @if(auth()->user()->hasRole('estudiante'))
                                    <a href="{{ action('EstudiantesController@index') }}" id="logout">Trabajo <span class="fas fa-arrow-right"></span></a>
                                    @endif
                                    @if(auth()->user()->hasRole('docente'))
                                    <a href="{{ route('docentes.index') }}" id="logout" >Trabajo <span class="fas fa-arrow-right"></span></a>
                                    @endif
                                    @if(auth()->user()->hasRole('administrativo'))
                                    <a href="{{ route('administrativos.index') }}" id="logout">Trabajo <span class="fas fa-arrow-right"></span></a>
                                    @endif
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
    <script src="js/app.js"></script>
    <script src="js/script.js"></script>
    <script src="js/main.js"></script>

</body>
</html>