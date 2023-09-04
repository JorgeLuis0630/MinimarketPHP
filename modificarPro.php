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
			<h2>Modificar Producto</h2><br>
			<div class="sala">
				<?php
					include("conexion.php");

					$id=$_GET['id'];

					$solicitud="SELECT *FROM producto WHERE id_producto=$id";
					$resultado=mysqli_query($conexion,$solicitud);
				?>

				<form method="POST" action="actualizarPro.php">
				<?php
					while($fila=mysqli_fetch_array($resultado)){
						echo "Nombre<br> <input style='width:260px; padding: 5px 10px 8px 5px;' type='text' name='nombre' value='".$fila['nombrePro']."'><br><br>";
						echo "Stock<br> <input style='width:260px; padding: 5px 10px 8px 5px;' type='number' name='stock' value='".$fila['stock']."'><br><br>";
						echo "Precio<br> <input style='width:260px; padding: 5px 10px 8px 5px;' type='number' name='precio' value='".$fila['precio']."'><br><br>";
						echo "Descripcion<br> <input style='width:260px; padding: 5px 10px 8px 5px;' type='text' name='descripcion' value='".$fila['descripcion']."'><br><br>";
						echo "Categoria <br> <select name='id_categoria' style='width:200px; padding: 8px 10px 8px 5px;'>";
						echo "<option value="."0".">Seleccionar Categoria</option>";
							
						include("conexion.php");
						$solicitud2="SELECT *FROM categoria";
						$resultado2=mysqli_query($conexion,$solicitud2);
						$fila2=mysqli_fetch_array($resultado2);
						while($fila2 = $resultado2->fetch_assoc()) { ?>
							<option value="<?php echo $fila2['id_categoria']; ?>"><?php echo $fila2['nombreCat']; ?></option>
						
						<?php 
					    }
							echo "</select><br><br><br>";

						echo "Presentacion <br> <select name='id_presen' style='width:200px; padding: 8px 10px 8px 5px;'>";
						echo "<option value="."0".">Seleccionar Presentacion</option>";
							
						include("conexion.php");
						$solicitud2="SELECT *FROM unidad_medida";
						$resultado2=mysqli_query($conexion,$solicitud2);
						$fila2=mysqli_fetch_array($resultado2);
						while($fila2 = $resultado2->fetch_assoc()) { ?>
							<option value="<?php echo $fila2['id_unidadProd']; ?>"><?php echo $fila2['descripcion']; ?></option>
						
						<?php 
					    }
							echo "</select><br><br><br>";
						?>

						<?php 
							echo "<input type='hidden' name='id' value='".$fila['id_producto']."'><br>";
						?>
					<center><input style="width:240px; padding: 10px 10px 10px 5px;background: #0600bf;color:#fff;border-radius: 10px;cursor: pointer;" type="submit" name="ENVIAR" value="ACTUALIZAR"></center>
				<?php } ?>
				</form>	
			</div>
		</div>

</body>	
</html>