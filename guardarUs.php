<?php
	include("conexion.php");

	$nombres=$_POST['nombres'];
	$apellidos=$_POST['apellidos'];
	$dni=$_POST['DNI'];
	$telefono=$_POST['telefono'];
	$cargo=$_POST['id_cargo'];
	$usuario=$_POST['usuario'];
	$contrasena=$_POST['password'];

	$solicitud="INSERT INTO usuario (usuario,password,id_tipoU,nombre,apellidos,dni,telefono,activo) VALUES ('$usuario','$contrasena','$cargo','$nombres','$apellidos','$dni','$telefono',1)";

	$resultado=mysqli_query($conexion,$solicitud);

	header("location:personal.php");
?>