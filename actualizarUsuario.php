<?php
include("conexion.php");

$usuario=$_POST['usuario'];
$contrasena=$_POST['password'];
$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$dni=$_POST['DNI'];
$telefono=$_POST['telefono'];

$id=$_POST['id'];



$solicitud="UPDATE usuario SET usuario='$usuario',password='$contrasena',nombre='$nombres',apellidos='$apellidos',dni='$dni',telefono='$telefono' WHERE id_usuario='$id'";

$resultado=mysqli_query($conexion,$solicitud);

header("location:ventas.php");

?>