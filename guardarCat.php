<?php
	include("conexion.php");

	$nombre=$_POST['nombre'];

	$solicitud="INSERT INTO categoria(nombreCat,activo) VALUES ('$nombre',1)";

	$resultado=mysqli_query($conexion,$solicitud);

	header("location:categoria.php");
?>