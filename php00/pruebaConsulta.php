<?php

	require('../php/const.php');
	require('../php/conexion.php');
	require('../php/utiles.php');
 
	$mysqli = conectar_db();
	selecciona_db($mysqli);

	$Consulta = "SHOW CREATE TABLE movimiento";
	$pConsulta = consulta_tb($mysqli, $Consulta);

	if($pConsulta){
		while($row = mysqli_fetch_array($pConsulta)){
			echo $row[1];
		}
	}else{
		echo 0;
	}
?>