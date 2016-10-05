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

			$quienSalida = $_POST['quienSalida'];
			$quienEntrada = $_POST['quienEntrada'];
			$montoEntrada = $_POST['montoEntrada'];
			$bancoOrigen = $_POST['bancoOrigen'];
			$bancoDestino = $_POST['bancoDestino'];
			if(isset($_POST['check'])){
				$check = 1;
			}else{
				$check = 0;
			}
			$pdfControl = $_POST['pdfControl'];

			$tabla = "movimiento";
			$tabla2 = "movimientoprestamo";

			$columna[0] = "origen";
			$columna[1] = "empresa";
			$columna[2] = "monto";
			$columna[3] = "banco";
			$columna[4] = "cuenta";
			$columna[5] = "realizado";

			$columna2[0] = "id";
			$columna2[1] = "idMov";
			$columna2[2] = "origen";
			$columna2[3] = "empresa";
			$columna2[4] = "monto";
			$columna2[5] = "banco";
			$columna2[6] = "cuenta";
			$columna2[7] = "realizado";
			$columna2[8] = "folio";
			$columna2[9] = "fecha";
			$columna2[10] = "hora";
			$columna2[11] = "pdf";

			$id = $_POST['valorId'];

			//Comienza actualización de la tabla movimiento.

			$datos[0] = "'".$quienSalida."'";
			$datos[1] = "'".$quienEntrada."'";
			$datos[2] = $montoEntrada;
			$datos[3] = "'".$bancoOrigen."'";
			$datos[4] = "'".$bancoDestino."'";
			$datos[5] = $check;

			actualiza($tabla, $datos, $columna, $id);

			//Finaliza actualización de la tabla movimiento.

			//Comienza actualización de la tabla movimientoPrestamo.

			elimina($tabla2, $columna2[1], $id);

			$datos2[0]="NULL";
			$datos2[1]=$id;
			$datos2[2]="'".$quienSalida."'";
			$datos2[3]="'".$quienEntrada."'";
			$datos2[4]=$montoEntrada;
			$datos2[5]="'".$bancoOrigen."'";
			$datos2[6]="'".$bancoDestino."'";
			$datos2[7]="'".$check."'";
			$datos2[8]="''";
			$datos2[9]="'".$_POST['fechaEntrada']."'";
			$datos2[10]="'".$_POST['horaEntrada']."'";
			$datos2[11]="''";

			alta($tabla2, $datos2, $columna2);

			$idPDFPrest = extrae_ultimo_id("movimientoprestamo");

			if($tmp_name = $_FILES["pdfPrestamo"]["tmp_name"]){
   				$name = "$idPDFPrest.pdf";
   				if(move_uploaded_file($tmp_name, "../pdfsPrestamos/$name")){
   					$columna3[0]="pdf";
   					$datos3[0]="'../pdfsPrestamos/$name'";
   					$columna4[0]="realizado";
   					$datos4[0]=1;
    				actualiza($tabla2, $datos3, $columna3, $idPDFPrest);
					actualiza($tabla2, $datos4, $columna4, $idPDFPrest);
   				}
   			}else{
   				$columna3[0]="pdf";
				$datos3[0]="'".$pdfControl."'";
				actualiza($tabla2, $datos3, $columna3, $idPDFPrest);
				if($pdfControl == ""){
   					$columna4[0]="realizado";
   					$datos4[0]=0;
					actualiza($tabla2, $datos4, $columna4, $idPDFPrest);
				}else{
   					$columna4[0]="realizado";
   					$datos4[0]=1;
					actualiza($tabla2, $datos4, $columna4, $idPDFPrest);
				}
   			}

			//Finaliza actualización de la tabla movimientoPrestamo.
			
			header("Location: ../movimientos/modificaProceso.php");		
		/*}else{
			header("Location: ../index.html");
		}*/
	}else{
		header("Location: ../index.html");
	}
        ob_en_flush(); 
?>