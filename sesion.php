<?php 
	$user=$_POST['usuario'];
	$pass=$_POST['contrasena'];
	
	include("conexion.php");
	$solicitud="SELECT *from usuario where usuario= '$user' and password= '$pass'";
	$resultado=mysqli_query($conexion,$solicitud);

	$fila=mysqli_fetch_array($resultado);

		if($fila['id_tipoU']==1){
			session_start();
			$_SESSION['usuario']=$user;
			$cargo=$fila['id_tipoU'];
			$_SESSION['cargo']=$cargo;

			$idUsuario=$fila['id_usuario'];
			$_SESSION['login']=$idUsuario;
			header('location:admin.php');
		}else if($fila['id_tipoU']==2){
			session_start();
			$_SESSION['usuario']=$user;
			$cargo=$fila['id_tipoU'];
			$_SESSION['cargo']=$cargo;

			$idUsuario=$fila['id_usuario'];
			$_SESSION['login']=$idUsuario;
			header('location:jefe.php');
		}else if($fila['id_tipoU']==3){
			session_start();
			$_SESSION['usuario']=$user;
			$cargo=$fila['id_tipoU'];
			$_SESSION['cargo']=$cargo;

			$idUsuario=$fila['id_usuario'];
			$_SESSION['login']=$idUsuario;
			header('location:vendedor.php');
		}else{
			echo "<script>
				alert('Su nombre de USUARIO o CONTRASEÑA es incorrecta, por favor intentelo nuevamente');window.location.href='index.php';
			  </script>";
			
		}
?>