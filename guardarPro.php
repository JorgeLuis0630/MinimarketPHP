<?php
	include("conexion.php");

	$nombre=$_POST['nombre'];
	$stock=$_POST['stock'];
	$precio=$_POST['precio'];
	$categoria=$_POST['cat'];
	$presen=$_POST['pre'];
	$descripcion=$_POST['descripcion'];

	$solicitud="INSERT INTO producto(nombrePro,stock,precio,id_categoria,id_unidadProd,descripcion,activo) VALUES ('$nombre','$stock','$precio','$categoria','$presen','$descripcion',1)";

	$resultado=mysqli_query($conexion,$solicitud);

	header("location:producto.php");
?>