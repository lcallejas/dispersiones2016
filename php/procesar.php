<?php
        ob_start();
	require('const.php');
	require('conexion.php');
	require('utiles.php');
    
    $mysqli = conectar_db();
    selecciona_db($mysqli);

	$nombre=$_POST["nom_usuario"];
	$pass=$_POST["pass"];

    $Consulta = "SELECT * FROM usuarios WHERE usuario='$nombre' and pass='$pass'";
	$pConsulta = consulta_tb($mysqli, $Consulta);

	$datos = mysqli_fetch_array($pConsulta);

	$usuario = $datos[0];
	$permisos = $datos[4];
	if($datos[0] == NULL){
		echo"<script>alert ('Datos incorrectos');</script>";
		header("Location: ../index.html");
	}else{
		session_start();
		$datos = mysqli_fetch_array($pConsulta);
		$_SESSION['usuario']=$usuario;
		$_SESSION['permisos']=$permisos;
		header("Location: ../principal/indexPrincipal.php");
	}

	cerrar_db($mysqli);
        ob_en_flush(); 
?>