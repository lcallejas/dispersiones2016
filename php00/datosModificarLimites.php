<?php
        ob_start(); 
	session_start();
	if($_SESSION){

		$permisos = $_SESSION['permisos'];

		//if($permisos != 4){

			date_default_timezone_set('America/Mexico_City');

			require('const.php');
			require('conexion.php');
			require('utiles.php');

			//Comienza actualización de la tabla movimiento.

			$tabla = "limites";

			//Comienza actualización de tabla limites.

			$empresa = $_POST['empresa'];
			$empresa = extrtae_id('empresas', $empresa);

			elimina($tabla, "origen", $empresa);

			$columna[0] = "id";
			$columna[1] = "origen";
			$columna[2] = "destino";
			$columna[3] = "limite";

			$destino = $_POST['empresaDestino'];
			$monto = $_POST['montoLimite'];

			$datos[0]="NULL";
			$datos[1]=$empresa;

			$registros = count($destino);

			for($i = 0; $i < $registros; $i++){
				$datos[2]=extrtae_id('empresas', $destino[$i]);
				$datos[3]=$monto[$i];

				alta($tabla, $datos, $columna);
			}

			//Finaliza actualización de tabla limites.
			
			header("Location: ../empresas/limites.php");		
		//}else{
			//header("Location: ../indexPrincipal.php");
		//}
	}else{
		header("Location: ../index.html");
	}
        ob_en_flush(); 
?>