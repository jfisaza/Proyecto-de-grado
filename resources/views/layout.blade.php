<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2&display=swap" rel="stylesheet">
    <title>Trabajo de grado - Unidades Tecnológicas de Santander</title>
</head>
<body>
    <header>
        <input type="checkbox" name="btn-menu" id="btn-menu">
        <label for="btn-menu"><span class="fas fa-bars"></span></label>
        
        <article class="logo">
            <a href="{{ url('/') }}"><img src="img/uts-logo.png" height="70px" width="110px"></a>
        </article>

        <nav class="menu">
            <ul>
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="#">Banco De Ideas</a></li>
                <li><a href="#">Estudiantes</a></li>
                <li><a href="#">Docentes</a></li>
                <li><a href="">Administrativos</a></li>
                <li class="login"><a href=""><span class="fas fa-user"></span> Login</a>
                </li>
            </ul>
        </nav>
        </article>
    </header>
    <div class="contenedor">
        @yield('content')
    </div>
    <script src="js/app.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>