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

			$accion = $_POST['accion'];

			$tabla = "disperciones";
			$tablaReg="acciones";
		
			if($accion == 'facturar'){
				$id=$_POST['idMov'];
				$folio=$_POST['folio'];
				$folioAnt=$_POST['folioAnt'];

				$registros = count($id);

				for($i = 0; $i < $registros; $i++){
					$columna[0] = 'folio';
					$columna2[0] = 'pdf';
					
					if($folio[$i] && $folio[$i] <> $folioAnt[$i]){
						$datos[0]="'".strtoupper($folio[$i])."'";
						actualiza($tabla, $datos, $columna, $id[$i]);
					}

						$tmp_name = $_FILES["pdf"]["tmp_name"][$i];
        				$name = "$id[$i].pdf";
        				if(move_uploaded_file($tmp_name, "../pdfsDispersiones/$name")){
        					$datos2[0]="'../pdfsDispersiones/$name'";
        					actualiza($tabla, $datos2, $columna2, $id[$i]);
        				}
				}

				//Guardado de registro en acciones
				$tablaReg="acciones";

				$columnaReg[0] = "id";
				$columnaReg[1] = "tabla";
				$columnaReg[2] = "idTabla";
				$columnaReg[3] = "descripcion";
				$columnaReg[4] = "usuario";
				$columnaReg[5] = "fecha";
				$columnaReg[6] = "hora";

				$datosReg[0]="NULL";
				$datosReg[1]="'movimientoFinal'";
				$datosReg[2]=0;
				$datosReg[3]="'Se realizo la actualizacion de facturas de dispersiones'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);
				//Termina guardado de registro en acciones

				header("Location: ../movimientos/facturarDispersiones.php");
			}else{
				echo "No cuentas con los permisos necesarios para esta acción";
			}
			
		/*}else{
			header("Location: ../index.html");
		}*/
	}else{
		header("Location: ../index.html");
	}
        ob_en_flush();
?>