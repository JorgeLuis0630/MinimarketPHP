<?php  
	session_start();

	$idUser=$_SESSION['login']; 

	if (!isset($_SESSION['cargo'])) {
		header('location:index.php');
	}
	/*else if ($_SESSION['cargo']!=1) {
		header('location:index.php');
	}*/	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrador del Sistema</title>
	<script src="https://kit.fontawesome.com/a78ae6acc4.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/estilos-admin.css">
</head>
<body>

	<div class="general">
		<div class="lateral">

				<img src="img/logooficial.png" width="180" height="100" >

			<ul>
				<li><a href="ventas.php"><i class="fas fa-home"></i>Inicio</a></li>
				<li><a href="perfil.php?id= <?php echo $idUser; ?>"><i class="fas fa-user"></i>Perfil</a></li>
				<?php if ($_SESSION['cargo']==1 || $_SESSION['cargo']==2 || $_SESSION['cargo']==3) { ?><li><a href="ventas.php"><i class="fas fa-shopping-cart"></i>Ventas</a></li><?php } ?>
				<?php if ($_SESSION['cargo']==1 || $_SESSION['cargo']==3) { ?><li><a href="producto.php"><i class="fas fa-box"></i>Producto</a></li><?php } ?>
				<?php if ($_SESSION['cargo']==1 || $_SESSION['cargo']==2) { ?><li><a href="categoria.php"><i class="fas fa-clipboard-list"></i>Categoria</a></li><?php } ?>
				<?php if ($_SESSION['cargo']==1 || $_SESSION['cargo']==2) { ?><li><a href="personal.php"><i class="fas fa-users"></i>Personal</a></li><?php } ?>
				<?php if ($_SESSION['cargo']==1 || $_SESSION['cargo']==2) { ?><li><a href="reporte.php"><i class="fas fa-chart-line"></i>Reporte</a></li><?php } ?>
				<li><a href="cerrar.php"><i class="fas fa-sign-out-alt"></i>Cerrar</a></li>
			</ul>

			<div class="social_media">
				<a href="#"><i class="fab fa-facebook-f"></i></a>
				<a href="#"><i class="fab fa-whatsapp"></i></a>
				<a href="#"><i class="fab fa-instagram"></i></a>
			</div>
		</div>

		<div class="informacion">
			<h3><?php
					$cargo=$_SESSION['cargo'];

					include("conexion.php");

					$solicitud="SELECT *FROM tipo_usuario where id_tipoU=$cargo";
					$resultado=mysqli_query($conexion,$solicitud);
					$fila=mysqli_fetch_array($resultado);
					echo $fila['descripcion'];
				?></h3>
			<a href="#">
				<i class="fa fa-user"></i>
					<?php 
						echo $_SESSION['usuario']; 
					?>
			</a>
		</div><br>
		<div class="contacto">
			<ul class="nav">
				<li>
					<a href="#"><i class="far fa-plus-circle"></i></a>
				</li>
			</ul>
		</div>
			
		<div class="conte">
			<h2>Listado de Personal</h2>
			<div style="width: 90%;margin: 50px auto;">
				<?php
				include("conexion.php");
				$solicitud="SELECT *FROM usuario WHERE activo=1";
				$resultado=mysqli_query($conexion,$solicitud);
				?>
				<table border='1' cellspacing="0">
					<thead>
						<tr>
							<td>APELLIDOS</td><td>NOMBRES</td><td>DNI</td><td>TELEFONO</td><td>USUARIO</td><td>CARGO</td><td colspan='2'>ACCIONES</td>
						</tr>
					</thead>
				<?php
					$solicitud2="SELECT  * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipoU = usuario.id_tipoU";
					$resultado2=mysqli_query($conexion,$solicitud2);
							
						
				while ($fila=mysqli_fetch_array($resultado)) {
					?>
					<tr>
						<td><?php echo $fila['apellidos']; ?></td>
						<td><?php echo $fila['nombre']; ?></td>							
						<td><?php echo $fila['dni']; ?></td>
						<td><?php echo $fila['telefono']; ?></td>
						<td><?php echo $fila['usuario']; ?></td>
						<td><?php 
							$fila2=mysqli_fetch_array($resultado2);
							if($fila2['id_tipoU']==$fila['id_tipoU'])
								echo $fila2['descripcion']; 									
							?></td>
						<td><a href="eliminarUs.php?id= <?php echo $fila['id_usuario']; ?>"><i class="far fa-trash-alt"></i></a></td>
						<td><a href="modificarUs.php?id=<?php echo $fila['id_usuario']; ?>"><i class="far fa-edit"></i></a></td>
					</tr>
				<?php 	} ?>
				</table><br><br>
			</div>	
				
			<h2>Registro de Personal</h2>
			<?php 
				include("conexion.php");
				$solicitud="SELECT *FROM usuario";
				$resultado=mysqli_query($conexion,$solicitud);
				$fila=mysqli_fetch_array($resultado);
				
			 ?>
			<div class="formu">
			<form method="POST" action="guardarUs.php">
				<fieldset style="width: 300px;padding-left: 20px;">
					<legend>Datos Personales</legend><br>
					Nombres <br> <input style='width:240px; padding: 5px 10px 8px 10px;' type='text' name='nombres'><br><br>
					Apellidos <br> <input style='width:240px; padding: 5px 10px 8px 10px;' type='text' name='apellidos'><br><br>
					DNI <br> <input style='width:240px; padding: 5px 10px 8px 10px;' type='text' name='DNI'><br><br>
					Telefono <br> <input style='width:240px; padding: 5px 10px 8px 10px;' type='text' name='telefono'><br><br>
					<div>Cargo <br> <select style='width:200px;height: 30px;' name="id_cargo" id="id_cargo">
					<option value="0">Seleccionar Cargo</option>
						<?php 
							include("conexion.php");
							$solicitud2="SELECT *FROM tipo_usuario";
							$resultado2=mysqli_query($conexion,$solicitud2);
							$fila2=mysqli_fetch_array($resultado2);
							while($fila2 = $resultado2->fetch_assoc()) { ?>
								<option value="<?php echo $fila2['id_tipoU']; ?>"><?php echo $fila2['descripcion']; ?></option>
						<?php } ?></select></div><br>
				</fieldset>	<br>	

				<fieldset style="width: 300px;padding-left: 20px;">				
					<legend>Datos de Usuario</legend><br>
					Usuario <br> <input style='width:240px; padding: 5px 10px 8px 10px;' type='text' name='usuario'><br><br>
					Password <br> <input style='width:240px; padding: 5px 10px 8px 10px;' type="password" name="password" class="form-control"><br><br>
					<input style="width:240px; padding: 10px 10px 10px 5px;background: #0600bf;color:#fff" type="submit" name="GUARDAR" value="REGISTRAR"><br><br>
				</fieldset>	<br>

			</form>
			</div>
			
		</div>

</body>	
</html>