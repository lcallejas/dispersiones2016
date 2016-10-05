<?php

	require('../php/const.php');
	require('../php/conexion.php');
	require('../php/utiles.php');
 
	$mysqli = conectar_db();
	selecciona_db($mysqli);

	$origenNom = $_POST['origen'];
	$origen = extrtae_id('empresas', $origenNom);
	$destinoNom = $_POST['destino'];
	$destino = extrtae_id('empresas', $destinoNom);

	$Consulta = "SELECT limite FROM limites WHERE origen = $origen AND destino = $destino";
	$pConsulta = consulta_tb($mysqli, $Consulta);

	if($pConsulta){
		while($row = mysqli_fetch_array($pConsulta)){
			echo $row[0];
		}
	}else{
		echo 0;
	}
?>