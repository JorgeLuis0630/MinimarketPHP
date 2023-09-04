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
	<?php 
		if ($_SESSION['cargo']==1){
	 ?>	
		<div class="agregar">
			<h2>Registrar Producto</h2>
			<div class="select">
				<form method="POST" action="guardarPro.php">
					Nombre <br> <input type="text" name="nombre" class="input-100"><br><br>
					Stock <br> <input type="number" name="stock" class="input-100"><br><br>
					Precio <br> <input type="number" name="precio" class="input-100"><br><br>
					Categoria <br>
					<select name="cat" style='width:200px;height: 30px;'>
				        <option value="0">Seleccione Categoria:</option>
				        <?php
				          include("conexion.php");

							$solicitud="SELECT *FROM categoria";
							$resultado=mysqli_query($conexion,$solicitud);
				          while ($valores = mysqli_fetch_array($resultado)) {
				            echo '<option value="'.$valores[id_categoria].'">'.$valores[nombreCat].'</option>';
				          }
				        ?>
				    </select><br><br>
				    Presentacion <br>
					<select name="pre" style='width:200px;height: 30px;'>
				        <option value="0">Seleccione Presentacion:</option>
				        <?php
				          include("conexion.php");

							$solicitud="SELECT *FROM unidad_medida";
							$resultado=mysqli_query($conexion,$solicitud);
				          while ($valores = mysqli_fetch_array($resultado)) {
				            echo '<option value="'.$valores[id_unidadProd].'">'.$valores[descripcion].'</option>';
				          }
				        ?>
				    </select><br><br>
					Descripcion<br><textarea name="descripcion" rows="6" cols="30"></textarea><br><br><br>
					<center><input class="btn" type="submit" name="ENVIAR" value="REGISTRAR"></center>
				</form>
			</div>
		</div>

		<div class="lista">
			<h2>Listado de Productos</h2>
			
			<div class="tabla">
				<?php
				include("conexion.php");

				$solicitud="SELECT *FROM producto WHERE activo=1";
				$resultado=mysqli_query($conexion,$solicitud);
				?>
				<table border='1' cellspacing="0">
					<thead>
						<tr>
							<td>NOMBRE</td><td>STOCK</td><td>PRECIO</td><td>DESCRIPCION</td><td colspan='2'>ACCIONES</td>
						</tr>
					</thead>
				<?php
					while ($fila=mysqli_fetch_array($resultado)) {
						?>
						<tr>
							<td><?php echo $fila['nombrePro']; ?></td>
							<td><?php echo $fila['stock']; ?></td>
							<td>S/ <?php echo $fila['precio']; ?></td>
							<td><?php echo $fila['descripcion']; ?></td>
							<td><a href="eliminarPro.php?id= <?php echo $fila['id_producto']; ?>"><i class="far fa-trash-alt"></i></a></td>
							<td><a href="modificarPro.php?id=<?php echo $fila['id_producto']; ?>"><i class="far fa-edit"></i></a></td>
						</tr>
				<?php } ?>
				</table>	
			</div>		
		</div>
	<?php } else {?>
			<div class="conte">
			<h2>Listado de Productos</h2>
			
			<div class="tabla">
				<?php
				include("conexion.php");

				$solicitud="SELECT *FROM producto";
				$resultado=mysqli_query($conexion,$solicitud);
				?>
				<table border='1' cellspacing="0">
					<thead>
						<tr>
							<td>NOMBRE</td><td>STOCK</td><td>PRECIO</td><td>DESCRIPCION</td>
						</tr>
					</thead>
				<?php
					while ($fila=mysqli_fetch_array($resultado)) {
						?>
						<tr>
							<td><?php echo $fila['nombrePro']; ?></td>
							<td><?php echo $fila['stock']; ?></td>
							<td>S/ <?php echo $fila['precio']; ?></td>
							<td><?php echo $fila['descripcion']; ?></td>
						</tr>
				<?php } ?>
				</table>	
			</div>		
		</div>
	<?php } ?>

</body>	
</html>