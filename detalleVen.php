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
			<div style="width: 90%;margin: 50px auto;">
					<h2>Listado de Productos</h2>
					<?php
					include("conexion.php");

					$solicitud="SELECT *FROM producto p INNER JOIN categoria c on p.id_categoria=c.id_categoria";
					$resultado=mysqli_query($conexion,$solicitud);
					?>
				<div class="tabla" style="width: 90%;">
					<table border='1' cellspacing="0">
						<thead>
							<tr>
								<td>ID</td><td>PRODUCTO</td><td>STOCK</td><td>PRECIO</td><td>DESCRIPCION</td><td>CATEGORIA</td><td>ACCION</td>
							</tr>
						</thead>
				<?php
					while ($fila=mysqli_fetch_array($resultado)) {
						?>
						<tr>
							<td><?php echo $fila['id_producto']; ?></td>
							<td><?php echo $fila['nombrePro']; ?></td>
							<td><?php echo $fila['stock']; ?></td>
							<td>S/ <?php echo $fila['precio']; ?></td>
							<td><?php echo $fila['descripcion']; ?></td>
							<td><?php echo $fila['nombreCat']; ?></td>
							<td><a href="agregarPro.php?id= <?php echo $fila['id_producto']; ?>">Agregar</a></td>
						</tr>
					<?php 	} ?>
					</table><br><br>
					</div>	
				</div>

				<div style="width: 90%;margin: 50px auto;">
					<h2>Detalle</h2>
					<?php
					include("conexion.php");

					$rs = mysqli_query($conexion,"SELECT MAX(id_Venta) AS id FROM venta");
					if ($row = mysqli_fetch_row($rs)) {
						$idVenta = trim($row[0]);
					}
					
					$solicitud="SELECT *FROM producto P INNER JOIN detalle_venta DV on P.id_producto=DV.id_producto WHERE DV.id_Venta=$idVenta";
					$resultado=mysqli_query($conexion,$solicitud);

					$total=0;
					?>
				<div class="tabla" style="width: 80%;">
					<table border='1' cellspacing="0">
						<thead>
							<tr>
								<td>ID</td><td>PRODUCTO</td><td>CANTIDAD</td><td>SUBTOTAL</td><td>ACCION</td>
							</tr>
						</thead>
					<?php
						while ($fila=mysqli_fetch_array($resultado)) {
							?>
							<tr>
								<td><?php echo $fila['id_detalle']; ?></td>
								<td> <?php echo $fila['nombrePro']; ?></td>
								<td><?php echo $fila['cantidad']; ?></td>
								<td>S/ <?php echo $fila['precio']; ?></td>
								<?php 
									$total=$total+$fila['precio'];
								?>
								<?php 
									$idVen=$fila['id_Venta'];
								 ?>
								<td><a href="eliminarDet.php?id= <?php echo $fila['id_detalle']; ?>"><i class="far fa-trash-alt"></i></a></td>
							</tr>
					<?php 	} ?>
					</table><br>
					<center>TOTAL: <label>S/ <?php echo $total; ?></label></center>
				</div>
					<form method="POST" action="finalizar.php"><br>
						<input type='hidden' name='idVent' value='<?php echo $idVen; ?>'><br><br>
						<center><input style="width:180px; padding: 5px 5px 5px 5px;background: #d23131;color:#fff;font-size: 18px;border-radius: 15px;cursor: pointer;" type="submit" name="ENVIAR" value="FINALIZAR VENTA"></center>
						<input type='hidden' name='total' value='<?php echo $total; ?>'><br><br>
					</form>
				</div>
			
		</div>

</body>	
</html>