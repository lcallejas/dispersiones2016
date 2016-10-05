<?php

	require('../php/const.php');
	require('../php/conexion.php');
	require('../php/utiles.php');
 
	$mysqli = conectar_db();
	selecciona_db($mysqli);

	$cliente = $_POST['cliente'];
	$nombre = $_POST['nombre'];

	if(isset($_POST['valorId'])){

		$direccionPDF = $_POST['direccionPDF'];
		if(unlink($direccionPDF)){
			$tabla = "pdfNominas";
			$columna = "id";
			$id = $_POST['valorId'];
			elimina($tabla, $columna, $id);
		}
	}

	$Consulta = "SELECT (SELECT b.cliente FROM clientesNominas b WHERE b.id = $cliente), (SELECT c.nombre FROM nombreNominas c WHERE c.id = $nombre), a.archivo, a.pdf, a.id FROM pdfNominas a WHERE a.cliente = $cliente AND a.nombre = $nombre";
	$pConsulta = consulta_tb($mysqli, $Consulta);

	echo "<table border='1'>
		<tr><td>Cliente</td><td>Nombre</td><td>Archivo</td><td>PDF</td><td>Eliminar</td></tr>";
	if($pConsulta){
		while($row = mysqli_fetch_array($pConsulta)){
			echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td><a target=\"_blank\" href=\"$row[3]\" title=\"\">Descargar</a></td><td><input type='button' onClick='verificaEliminaPDF(".$row[4].", \"$row[3]\")' value='Borrar'></td></tr>";
		}
		echo "</table>";
	}
	echo "<br><input type='hidden' name='clienteHidden' id='clienteHidden' value='".$cliente."'>";
	echo "<br><input type='hidden' name='nombreHidden' id='nombreHidden' value='".$nombre."'>";
?>