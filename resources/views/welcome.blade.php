

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('img/uts-logo.png') }}">
        <title>Trabajos de grado UTS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Exo&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url(../public/img/UTS.jpg);
	            background-size:cover;
	            background-attachment: fixed;
                color: wheat;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            #contenedor_carga{
    background-color: rgba(250, 240, 245, 0.9);
    height: 100%;
    width: 100%;
    position: fixed;
    -webkit-transition: all 1s ease;
    -o-transition: all  1s ease;
    transition: all  1s ease;
    z-index: 10000;
}
#carga{
    border: 15px solid #ccc;
    border-top-color: rgb(33, 107, 156);
    border-top-style: groove;
    height: 100px;
    width: 100px;
    border-radius: 100%;

    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    -webkit-animation: girar 1.5s linear infinite;
    -o-animation: girar 1.5s linear infinite;
    animation: girar 1.5s linear infinite;
}
@keyframes girar{
from{transform: rotate(0deg);}
to{transform: rotate(360deg);}

}
        .pagina:before{
	        content:"";
	        width: 100%;
	        height:100%;
	        background-color:black;
	        position: absolute;
	        opacity: 0.7;

        }
        .frase{
            font-family: 'Exo', sans-serif;
            padding: 0 25px;
            font-size: 25px;
        }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                color:#F0F0F0;
            }

            .title {
                font-size: 84px;
                font-family: 'Courgette', cursive;
            }

            .links > a {
                color: #BCEC79;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            a:hover{
                color:#878070;
                 
            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <!-- preloader -->
        <div id="contenedor_carga">
            <div id="carga"></div>
        </div>
        <div class="pagina">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                    
                        <a href="{{ route('login') }}">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Trabajos de grado
                </div>
                <p class="frase">Facilita tu proceso creando tu cuenta</p>

                <div class="links">
                    <a href="https://www.dropbox.com/sh/op8bmnpioxnutkq/AAA3aYa4B9loRyLJkkcaX3Sma/DOCUMENTOS%20DE%20GRADO?dl=0&subfolder_nav_tracking=1">Documentos de grado</a>
                    <a href="http://www.uts.edu.co/sitio/">UTS</a>
                    <a href="http://www.uts.edu.co/sitio/wp-content/uploads/normatividad/reglamento_trabajo_grado.pdf">Reglamento Trabajos de grado</a>
                    <a href="{{ action('BancoController@index') }}">Banco de ideas y prácticas</a>
                </div>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>

    </body>
</html>
