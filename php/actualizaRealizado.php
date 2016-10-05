<?php

	require('../php/const.php');
	require('../php/conexion.php');
	require('../php/utiles.php');
 
	$mysqli = conectar_db();
	selecciona_db($mysqli);
 
	$id=$_POST['id'];
	$tabla=$_POST['tabla'];
	//$id=18;
	//$tabla="movimientoNominas";

 	$Consulta = "UPDATE $tabla SET realizado = IF(realizado > 0, 0, IF(realizado < 1, 1, realizado)) WHERE id = $id";
	consulta_tb($mysqli, $Consulta);

	$tabla2 = "movimiento";
	$columna[0] = "realizado";

	$Consulta3 = "SELECT idMov FROM $tabla WHERE id = $id";
	$pConsulta3 = consulta_tb($mysqli, $Consulta3);
	$row2 = mysqli_fetch_array($pConsulta3);

	$id2 = $row2[0];

	echo $id2;

	$Consulta4 = "SELECT * FROM movimientoNominas WHERE idMov = $id2 AND realizado = 0";
	$pConsulta4 = consulta_tb($mysqli, $Consulta4);
	$row3 = mysqli_fetch_array($pConsulta4);

	echo $row3[0];

	if($row3){
		$datos[0] = 0;
	}else{
		echo "Si entra";
		$datos[0] = 1;
	}

	actualiza($tabla2, $datos, $columna, $id2);

	cerrar_db($mysqli);
?>