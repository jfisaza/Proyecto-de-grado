<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registrar</title>
    <link rel="icon" href="{{ asset('img/uts-logo.png') }}">
    <link rel="stylesheet" type="text/css" href="css/registrar.css">
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Marck+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@700&family=Oswald:wght@500&display=swap" rel="stylesheet">
</head>

<body>
        <!-- preloader -->
        <div id="contenedor_carga">
            <div id="carga"></div>
        </div>

        <!-- menu -->

        <div class="pagina">
            <div class="formulario">
                <h2>Registrarse</h2>
                <p>Crea tu cuenta y facilita tu trabajo de grado</p>
                <form method="POST" action="{{ route('register') }}" class="form">
                    {{ csrf_field() }}
                    <input class="input" type="number" min="0" max="2000000000" name="documento" value="{{ old('documento') }}" autofocus id="documento" required placeholder="Documento">
                    @error('documento')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    <div class="names">
                        <input class="input" type="text" name="nombres" value="{{ old('nombres') }}" autofocus id="nombre" required placeholder="&#128100;   Nombres">
                        @error('nombres')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <input class="input" type="text" name="apellidos" value="{{ old('apellidos') }}" id="apellidos" placeholder="   Apellidos" required>
                        @error('apellidos')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <input class="input" type="text" name="telefono" id="telefono" required placeholder="   Telefono" value="{{ old('telefono') }}">
                    @error('telefono')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    <select class="ciudad" name="ciudad">
                        <option value="">Seleccionar Sede</option>
                        <option value="BUCARAMANGA">BUCARAMANGA</option>
                        <option value="REGIONAL BARRANCABERMEJA">REGIONAL BARRANCABERMEJA</option>
                        <option value="REGIONAL VELEZ">REGIONAL VÉLEZ</option>
                        <option value="REGIONAL PIEDECUESTA">REGIONAL PIEDECUESTA</option>
                    </select>
                    @error('ciudad')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <select class="programa" name="programa" required>
                        <option selected value="">Programa</option>
                        @foreach($programas as $pro)
                        <option value="{{ $pro->pro_id }}">{{ $pro->pro_nombre }}</option>
                        @endforeach
                    </select>


                    @error('programa')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <input class="input" type="email" name="email" id="correo" required placeholder="   Correo" value="{{ old('email') }}" autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    <input class="input" type="password" name="password" id="contraseña" required placeholder="&#9919; Contraseña">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
                    <br>
                    @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <div class="botom">
                        <input id="registrar" type="submit" value="Registrarse">
                    </div>
                </form>

            </div>

        </div>


        <script src="js/script.js"></script>


    </body>

</html>