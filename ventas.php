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
			<h2>Gestion de Ventas</h2>
			<div style="width: 50%;margin: 50px auto;">
				<?php
				include("conexion.php");
				$solicitud="SELECT *FROM venta";
				$resultado=mysqli_query($conexion,$solicitud);
				?>
				<table border='1' cellspacing="0">
					<thead>
						<tr>
							<td>ID</td><td>FECHA</td><td>MONTO</td><td>ACCION</td>
						</tr>
					</thead>
				<?php			
						
				while ($fila=mysqli_fetch_array($resultado)) {
					?>
					<tr>
						<td><?php echo $fila['id_Venta']; ?></td>
						<td><?php echo $fila['fecha']; ?></td>							
						<td><?php echo $fila['total']; ?></td>
						<td><a href="resumenDet.php?id= <?php echo $fila['id_Venta']; ?>">Ver Detalle</a></td>
					</tr>
				<?php 	} ?>
				</table><br><br>
			</div>
			<form method="POST" action="generarPed.php">
				<center><input style="width:240px; padding: 10px 10px 10px 5px;background: #0600bf;color:#fff" type="submit" name="GUARDAR" value="GENERAR VENTA"></center><br><br>
				<input type='hidden' name='idUsuario' value='<?php echo $idUser; ?>'><br><br>
			</form>
		</div>

</body>	
</html>