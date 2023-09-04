<?php
	include("conexion.php");

	$id=$_GET['id'];

	$solicitud="UPDATE usuario SET activo=0 WHERE id_usuario=$id";
	$resultado=mysqli_query($conexion,$solicitud);

	header("location:personal.php");
?>