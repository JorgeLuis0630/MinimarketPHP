<?php
	include("conexion.php");

	$idProducto=$_POST['idPro'];
	$precio=$_POST['precio'];
	$cantidad=$_POST['cantidad'];

	$stock=$_POST['stock'];

	$subTot=($precio*$cantidad);

	$rs = mysqli_query($conexion,"SELECT MAX(id_Venta) AS id FROM venta");
	if ($row = mysqli_fetch_row($rs)) {
		$idVenta = trim($row[0]);
	}

	if ($cantidad<=$stock){
		$solicitud="INSERT INTO detalle_venta(cantidad,precio,id_Venta,id_producto) VALUES ('$cantidad','$subTot','$idVenta','$idProducto')";

		$resultado=mysqli_query($conexion,$solicitud);

		$stockNuevo=$stock-$cantidad;	

		$solicitud2="UPDATE producto SET stock = $stockNuevo WHERE id_producto = $idProducto;";
		$resultado2=mysqli_query($conexion,$solicitud2);

		header("location:detalleVen.php");
	}else{
		echo "<script>
				alert('El stock de este menú es insuficiente');window.location.href='detalleVen.php';
			  </script>";
	}
?>