<?php
	include("conexion.php");

	$id=$_POST['idVent'];
	$total=$_POST['total'];


	$solicitud2="UPDATE venta SET total = '$total' WHERE id_Venta = $id;";
	$resultado2=mysqli_query($conexion,$solicitud2);

	header("location:ventas.php");
?>