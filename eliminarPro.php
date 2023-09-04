<?php
	include("conexion.php");

	$id=$_GET['id'];

	$solicitud="UPDATE producto SET activo=0 WHERE id_producto=$id";
	$resultado=mysqli_query($conexion,$solicitud);

	header("location:producto.php");

?>