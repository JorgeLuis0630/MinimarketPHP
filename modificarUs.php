<?php  
	session_start();

	$idUser=$_SESSION['login']; 

	if (!isset($_SESSION['cargo'])) {
		header('location:index.php');
	}
	else if ($_SESSION['cargo']!=1) {
		header('location:index.php');
	}		
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
			<h2>Actualizar Personal</h2>
			<div class="sala">
				<?php
					include("conexion.php");

					
					$id=$_GET['id'];

					$solicitud="SELECT *FROM usuario WHERE id_usuario=$id";
					$resultado=mysqli_query($conexion,$solicitud);
				?>
				<form method="POST" action="actualizarUs.php"><?php
					while($fila=mysqli_fetch_array($resultado)){
						echo "<fieldset style='padding:20px;'>
							<legend>Datos Personales</legend>";
						echo "Nombres <br> <input style='width:300px; padding: 5px 10px 8px 5px;' type='text' name='nombres' value='".$fila['nombre']."'><br><br>";
						echo "Apellidos <br> <input style='width:300px; padding: 5px 10px 8px 5px;' type='text' name='apellidos' value='".$fila['apellidos']."'><br><br>";
						echo "DNI <br> <input style='width:300px; padding: 5px 10px 8px 5px;' type='text' name='DNI' value='".$fila['dni']."'><br><br>";
						echo "Telefono <br> <input style='width:300px; padding: 5px 10px 8px 5px;' type='text' name='telefono' value='".$fila['telefono']."'><br><br>";
						echo "Cargo <br> <select name='id_cargo' id='id_cargo' style='width:300px; padding: 8px 10px 8px 5px;'>";
						echo "<option value="."0".">Seleccionar Cargo</option>";
							
						include("conexion.php");
						$solicitud2="SELECT *FROM tipo_usuario";
						$resultado2=mysqli_query($conexion,$solicitud2);
						$fila2=mysqli_fetch_array($resultado2);
						while($fila2 = $resultado2->fetch_assoc()) { ?>
							<option value="<?php echo $fila2['id_tipoU']; ?>"><?php echo $fila2['descripcion']; ?></option>
						<?php 
								}
							echo "</select><br><br><br>";
								?>
						
									
							<?php echo "Usuario <br><input  type='text' name='usuario' value='".$fila['usuario']."'><br><br>";?>
							<?php echo "Password <br> <input type='password' name='password' value='".$fila['password']."'><br><br>";?>
						<?php echo "<input type='hidden' name='id' value='".$fila['id_usuario']."'><br>"; ?>
						<center><input style="width:200px; padding: 10px 10px 10px 5px;background: #0600bf;color:#fff;border-radius: 10px;cursor: pointer;" type="submit" name="ENVIAR" value="ACTUALIZAR"></center>
				        <?php echo "</fieldset>"; ?>        
					<?php } ?>
					
				</form>	
			</div>
		</div>

</body>	
</html>