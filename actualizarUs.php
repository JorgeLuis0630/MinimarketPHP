<?php

$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$dni=$_POST['DNI'];
$telefono=$_POST['telefono'];
$idcargo=$_POST['id_cargo'];
$usuario=$_POST['usuario'];
$contrasena=$_POST['password'];

$id=$_POST['id'];

include("conexion.php");

$solicitud="UPDATE usuario SET nombre='$nombres',apellidos='$apellidos',dni='$dni',telefono='$telefono',id_cargo='$idcargo',usuario='$usuario',password='$contrasena' WHERE id_usuario='$id'";

$resultado=mysqli_query($conexion,$solicitud);

header("location:personal.php");

?>