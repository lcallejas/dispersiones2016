<?php
        ob_start();
	session_start();

	require('const.php');
	require('conexion.php');
	require('utiles.php');
 
	$mysqli = conectar_db();
	selecciona_db($mysqli);

	$id = $_POST['valorId'];
	
	if($tmp_name = $_FILES["pdfPrestamo"]["tmp_name"]){
        $name = $_FILES["pdfPrestamo"]["name"];
        if(file_exists("../pdfsPrestamos/".$_FILES["pdfPrestamo"]["name"])){
			echo"<script>alert('El archivo ya existe');</script>";
		}else{
			if(move_uploaded_file($tmp_name, "../pdfsPrestamos/$name")){
				$tabla = "movimientoprestamo";

				$columna1 = "pdf";
				$columna2 = "realizado";


				$datos1 = "'../pdfsPrestamos/$name'";
				$datos2 = 1;

				$Consulta = "UPDATE $tabla SET $columna1 = $datos1 WHERE idMov = $id";
				consulta_tb($mysqli, $Consulta);
				$Consulta = "UPDATE $tabla SET $columna2 = $datos2 WHERE idMov = $id";
				consulta_tb($mysqli, $Consulta);
			}
		}
	}
	header("Location: ../movimientos/continuaProceso.php");
        ob_en_flush(); 
?>