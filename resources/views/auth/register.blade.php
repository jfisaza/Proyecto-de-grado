<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Registrar</title>
	<link rel="stylesheet" type="text/css" href="css/registrar.css">
	<link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Leckerli+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Bitter:wght@700&family=Oswald:wght@500&display=swap"
		rel="stylesheet">
</head>

<body>

	<!-- menu -->

	<div class="pagina">
		<div class="formulario">
			<h2>Registrarse</h2>
			<p>Crea tu cuenta y facilita tu trabajo de grado</p>
			<form method="POST" action="{{ route('register') }}" class="form">
                {{ csrf_field() }}
                <input class="input" type="text" name="documento" value="{{ old('documento') }}" autocomplete="documento" autofocus id="documento" required placeholder="Documento">
                @error('documento')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
                <div class="names">
				    <input class="input" type="text" name="nombres" value="{{ old('nombres') }}" autocomplete="nombres" autofocus id="nombre" required placeholder="&#128100;   Nombres">
                    @error('nombres')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    <input class="input" type="text" name="apellidos" value="{{ old('apellidos') }}" id="apellidos"  placeholder="   Apellidos" required>
                    @error('apellidos')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
				</div>
				
                <input class="input" type="text" name="telefono" id="telefono" required placeholder="   Telefono" value="{{ old('telefono') }}">
                @error('telefono')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <select class="ciudad" name="ciudad">
					<option value="">Seleccionar Ciudad</option>
					<option value="BUCARAMANGA">Bucaramanga</option>
					<option value="BOGOTA">Bogota</option>
					<option value="CARTAGENA">Cartagena</option>
					<option value="SANTA MARTA">Santa Marta</option>
				</select>				
				@error('ciudad')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <select class="programa" name="programa">
					<option value="">Seleccionar Programa</option>
					<option value="1">Sistemas</option>
					<option value="2">Ambiental</option>
					<option value="3">Modas</option>
					<option value="4">Deportiva</option>
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




</body>

</html>