<?php

	require('../php/const.php');
	require('../php/conexion.php');
	require('../php/utiles.php');
 
	$mysqli = conectar_db();
	selecciona_db($mysqli);

	$categoria = $_POST['categoria'];

	if($categoria == "clientes"){
 		$tabla = "clientesNominas";

 		$columna[0] = "id";
 		$columna[1] = "cliente";
 		$columna[2] = "activo";

 		$datos[0] = "NULL";
 		$datos[1] = "'".$_POST['cliente']."'";
 		$datos[2] = 1;

		alta($tabla, $datos, $columna);
	}else if($categoria == "nombres"){
		$tabla = "nombreNominas";

		$columna[0] = "id";
		$columna[1] = "cliente";
		$columna[2] = "nombre";
		$columna[3] = "finalizado";
		$columna[4] = "activo";

		$datos[0] = "NULL";
		$datos[1] = $_POST['cliente'];
		$datos[2] = "'".$_POST['nombre']."'";
		$datos[3] = 0;
		$datos[4] = 1;

		alta($tabla, $datos, $columna);
	}else if($categoria == "borraPDF"){
		$tabla = "pdfNominas";

		$columna = "id";

		$id = $_POST['valorId'];

		elimina($tabla, $columna, $id);
	}

	cerrar_db($mysqli);
?>