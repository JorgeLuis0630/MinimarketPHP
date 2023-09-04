<?php
	include("conexion.php");

	$id=$_GET['id'];

	$solicitud="UPDATE categoria SET activo=0 WHERE id_categoria=$id";
	$resultado=mysqli_query($conexion,$solicitud);

	header("location:categoria.php");

?>