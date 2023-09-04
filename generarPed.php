<?php  
	include("conexion.php");

	$id=$_POST['idUsuario'];

	$fecha_actual = date("Y-m-d");

	$solicitud="INSERT INTO venta(fecha,id_usuario) VALUES ('$fecha_actual','$id')";
	$resultado=mysqli_query($conexion,$solicitud);

	header("location:detalleVen.php");
?>