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
			<h2>Reporte de Ventas</h2>
				<div style="width: 85%;margin: 50px auto;">
					<form method="POST" action="buscarVen.php">
						<b style="font-size: 1.3em;font-family: calibri;">F. INICIO <input type="date" name="f1" style="width: 200px;height: 30px;">&nbsp&nbsp&nbsp&nbsp F. FINAL <input type="date" name="f2" style="width: 200px;height: 30px;"></b>&nbsp&nbsp&nbsp&nbsp 
						<input style="width:130px; padding: 10px 10px 10px 5px;background: #0600bf;font-weight:bold;color:#fff;font-family: calibri;font-size: 1.2em; border-radius: 1.5em;" type="submit" name="ENVIAR" value="BUSCAR">
					</form><br>

					<?php
						include("conexion.php");
						$fechaI=date("Y-m-d", strtotime($_POST['f1']));
						$fechaF=date("Y-m-d", strtotime($_POST['f2']));

						/*if (!empty($fechaF)) {
							$fechaF=$fechaI;
						}
						if (!empty($fechaI)) {
							$fechaI=$fechaF;
						}*/
						if ($fechaI>$fechaF) {
							echo "<script>
									alert('Fechas incorrectas o es posible que no haya ingresado una fecha ');window.location.href='reporte.php';
								  </script>";	
						}
						
						$solicitud="SELECT *FROM venta where fecha Between '$fechaI' and '$fechaF'";
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
								<td>S/ <?php echo $fila['total']; ?>.00</td>
								<td><a href="resumenDet.php?id= <?php echo $fila['id_Venta']; ?>">Ver Detalle</a></td>
							</tr>
					<?php 	} ?>
						</table><br><br>
				</div>
			
		</div>

</body>	
</html>
