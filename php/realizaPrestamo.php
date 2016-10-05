<?php

	require('../php/const.php');
	require('../php/conexion.php');
	require('../php/utiles.php');
 
	$mysqli = conectar_db();
	selecciona_db($mysqli);
 
	$id=$_POST['id'];
	$tabla=$_POST['tabla'];

 	$Consulta = "UPDATE $tabla SET realizado = IF(realizado > 0, 0, IF(realizado < 1, 1, realizado)) WHERE id = $id";
	consulta_tb($mysqli, $Consulta);

	cerrar_db($mysqli);
?>