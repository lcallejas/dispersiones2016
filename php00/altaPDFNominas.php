<?php
        ob_start();
	session_start();

	require('const.php');
	require('conexion.php');
	require('utiles.php');
	
	if($tmp_name = $_FILES["nuevoPDF"]["tmp_name"]){
        $name = $_FILES["nuevoPDF"]["name"];
        if(file_exists("../pdfsNominas/".$_FILES["nuevoPDF"]["name"])){
			echo"<script>alert('El archivo ya existe');</script>";
		}else{
			if(move_uploaded_file($tmp_name, "../pdfsNominas/$name")){
				$tabla2 = "pdfNominas";

				$columna2[0] = "id";
				$columna2[1] = "cliente";
				$columna2[2] = "nombre";
				$columna2[3] = "archivo";
				$columna2[4] = "pdf";
				$columna2[5] = "activo";

				$datos2[0]="NULL";
				$datos2[1]=$_POST['clienteHidden'];
				$datos2[2]=$_POST['nombreHidden'];
				$datos2[3]="'".$_POST['nombreArchivo']."'";
				$datos2[4]="'../pdfsNominas/$name'";
				$datos2[5]=1;

				alta($tabla2, $datos2, $columna2);

				$_SESSION['clienteSESSIONText'] = $_POST['clienteText'];
				$_SESSION['nombreSESSIONText'] = $_POST['nombreText'];
				$_SESSION['clienteSESSION'] = $_POST['clienteTextHidden'];
				$_SESSION['nombreSESSION'] = $_POST['nombreTextHidden'];

				echo $_POST['clienteText'];
			}
		}
	}
	header("Location: ../nominas/nominaspdf.php");
        ob_en_flush(); 
?>