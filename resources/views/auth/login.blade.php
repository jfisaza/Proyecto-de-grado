<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Leckerli+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Bitter:wght@700&family=Oswald:wght@500&display=swap" rel="stylesheet">
</head>

<body>
	
		<!-- menu -->

		<div class="pagina">
			<div class="formulario">
				<h2>Login</h2>
				<p>Trabajo de Grado</p>
				<form method="POST" action="{{ route('login') }}" class="form">
                    {{ csrf_field() }}
					<input type="text" name="email" id="usuario" required placeholder="&#128100;   Correo">
					@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					<input type="password" name="password" id="contraseña" required placeholder="&#9919; Contraseña">
					@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
								@enderror
							
					
										
					<input id="ingresar" type="submit" value="Ingresar">
					
				</form>

			</div>

		</div>


	

</body>

</html>