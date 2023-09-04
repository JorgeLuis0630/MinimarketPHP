<?php
	include("conexion.php");

	$id=$_GET['id'];

	$solicitud="DELETE FROM detalle_venta WHERE id_detalle=$id";
	$resultado=mysqli_query($conexion,$solicitud);


	header("location:detalleVen.php");
?>