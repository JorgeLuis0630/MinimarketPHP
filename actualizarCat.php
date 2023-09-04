<?php

$nombre=$_POST['nombre'];
$id=$_POST['id'];

include("conexion.php");

$solicitud="UPDATE categoria SET nombreCat='$nombre' WHERE id_categoria=$id";
$resultado=mysqli_query($conexion,$solicitud);

header("location:categoria.php");

?>