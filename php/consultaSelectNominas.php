<?php

	require('../php/const.php');
	require('../php/conexion.php');
	require('../php/utiles.php');
 
	$mysqli = conectar_db();
	selecciona_db($mysqli);

	$cliente = $_POST['cliente'];

	$Consulta = "SELECT id, nombre FROM nombreNominas WHERE cliente = $cliente";
	$pConsulta = consulta_tb($mysqli, $Consulta);

	if($pConsulta){
		while($row = mysqli_fetch_array($pConsulta)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		echo "</table>";
	}
?>