<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesion</title>
	<link rel="stylesheet" href="css/estilos.css">
	<meta charset="utf-8">
</head>
<body style="background-repeat: no-repeat;background-position: center center;background-size: cover;background-attachment: scroll;background-image: url(&quot;https://gondolasmetalicas.pe/wp-content/uploads/2020/07/bg.jpg&quot;);">
			<img src="img/logo1.png">
	<form method="POST" action="sesion.php">
			<div class="form">

				<h1>Iniciar Sesión</h1>
				<div class="datos">
					<input type="text" name="usuario" class="user" required>
					<span class="barra"></span>
					<label>Usuario</label><br>
				</div>
				<div class="datos">
					<input type="password" name="contrasena" class="pass" required>
					<span class="barra"></span>
					<label>Contraseña</label><br>

				</div>
				<button type="submit" name="enviar">Ingresar</button>			
			</div>
		

	</form>
</body>
</html>