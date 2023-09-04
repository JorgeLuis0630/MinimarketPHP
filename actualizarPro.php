<?php

$nombre=$_POST['nombre'];
$stock=$_POST['stock'];
$precio=$_POST['precio'];
$descripcion=$_POST['descripcion'];
$idcategoria=$_POST['id_categoria'];
$idpresent=$_POST['id_presen'];

$id=$_POST['id'];

include("conexion.php");

$solicitud="UPDATE `producto` SET `nombrePro`='$nombre',`stock`='$stock',`precio`='$precio',`descripcion`='$descripcion',`id_categoria`='$idcategoria',`id_unidadProd`='$idpresent' WHERE `id_producto`=$id";
$resultado=mysqli_query($conexion,$solicitud);

header("location:producto.php");

?>