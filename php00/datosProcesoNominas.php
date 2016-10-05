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

			$tabla = "movimiento";
			$tabla2 = "movimientoFinal";
			$tabla3 = "disperciones";
			$tabla4 = "movimientoNominas";
			$tablaReg="acciones";
		
			if($accion == 'alta'){
				//Comienza alta en la tabla movimiento.
				$columna[0] = "id";
				$columna[1] = "origen";
				$columna[2] = "empresa";
				$columna[3] = "monto";
				$columna[4] = "banco";
				$columna[5] = "cuenta";
				$columna[6] = "activo";
				$columna[7] = "realizado";
				$columna[8] = "folio";
				$columna[9] = "tipo";
				$columna[10] = "fecha";
				$columna[11] = "hora";

				$datos[0]="NULL";
				$datos[1]="'".$_POST['quienEntrada']."'";
				$datos[2]="'1'";
	    		$datos[3]=$_POST['totalNominas'];
	    		$datos[4]="''";
	    		$datos[5]="''";
	    		$datos[6]=1;
	    		$datos[7]=0;
				$datos[8]="''";
				$datos[9]=2;
    			$datos[10]="'".date("Y-m-d")."'";
	    		$datos[11]="'".date("H:i:s")."'";

				alta($tabla, $datos, $columna);
				//Fin alta de tabla movimiento.

				//Guardado de registro en acciones.
				$columnaReg[0] = "id";
				$columnaReg[1] = "tabla";
				$columnaReg[2] = "idTabla";
				$columnaReg[3] = "descripcion";
				$columnaReg[4] = "usuario";
				$columnaReg[5] = "fecha";
				$columnaReg[6] = "hora";

				$datosReg[0]="NULL";
				$datosReg[1]="'movimiento'";
				$datosReg[2]=extrae_ultimo_id("movimiento");
				$datosReg[3]="'Se dio de alta el proceso con id: ".extrae_ultimo_id("movimiento")."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);
				//Termina guardado de registro en acciones.

				//Comienza alta en tabla movimientoNominas.
				$columna3[0] = "id";
				$columna3[1] = "idMov";
				$columna3[2] = "origen";
				$columna3[3] = "empresa";
				$columna3[4] = "monto";
				$columna3[5] = "banco";
				$columna3[6] = "cuenta";
				$columna3[7] = "realizado";
				$columna3[8] = "folio";
				$columna3[9] = "fecha";
				$columna3[10] = "hora";
				$columna3[11] = "comentario";
				$columna3[12] = "pdf";

				$datos3[0]="NULL";
				$datos3[1]=extrae_ultimo_id('movimiento');
				$datos3[2]="'".$_POST['quienEntrada']."'";
				    $empEnt = $_POST['empEnt'];
					$montoEnt = $_POST['montoEnt'];
					$bancoEnt = $_POST['bancoEnt'];
					$cuentaEnt = $_POST['cuentaEnt'];
					$comentarioEnt = $_POST['comentarioEnt'];
				$datos3[7]=0;
				$datos3[8]="''";
				$datos3[9]="'".date("Y-m-d")."'";
				$datos3[10]="'".date("H:i:s")."'";
				$datos3[12]="''";


				$registros = count($empEnt);

				for($i = 0; $i < $registros; $i++){
					$datos3[3]="'".$empEnt[$i]."'";
					$datos3[4]=$montoEnt[$i];
					$datos3[5]="'".$bancoEnt[$i]."'";
					$datos3[6]="'".$cuentaEnt[$i]."'";
					$datos3[11]="'".$comentarioEnt[$i]."'";
				
					alta($tabla4, $datos3, $columna3);
				}
				//Fin alta en tabla movimientoNominas.

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
				$datosReg[1]="'movimientoNominas'";
				$datosReg[2]=extrae_ultimo_id("movimiento");
				$datosReg[3]="'Se dio de alta el proceso con id: ".extrae_ultimo_id("movimiento")."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);
				//Termina guardado de registro en acciones

				header("Location: ../movimientos/nuevoProcesoNominas.php");
			}else if($accion == 'baja'){
				$dato = $_POST['listado'];
		
				baja($tabla, $dato);

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
				$datosReg[1]="'movimiento'";
				$datosReg[2]=$dato;
				$datosReg[3]="'Se dio de baja el proceso con id: ".$dato."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);
				//Termina guardado de registro en acciones
			}else if($accion == 'modificar'){
				//Comienza actualización en tabla movimientoNominas.
				$id = $_POST['valorId'];

				$columna[0] = "realizado";

				$verificaRealizados[0] = 1;

				$idEnt=$_POST["idEnt"];
				$realizadoEnt=$_POST["realizadoEnt"];

				$registros = count($idEnt);

				for($i = 0; $i < $registros; $i++){
					$datos[0]=$realizadoEnt[$i];
					if($datos[0] == 0){
						$verificaRealizados[0] = 0;
					}

    				$idNom = $idEnt[$i];
				
					actualiza($tabla4, $datos, $columna, $idNom);
				}

				actualiza($tabla, $verificaRealizados, $columna, $id);
				//Finaliza actualización de movimientoNominas

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
				$datosReg[1]="'movimientoNominas'";
				$datosReg[2]=$id;
				$datosReg[3]="'Se actualizo el proceso con id: ".$id."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);
				//Termina guardado de registro en acciones

				//Comienza actualización de tabla disperciones
				elimina($tabla3, "idMov", $id);

				$columna2[0] = "id";
				$columna2[1] = "idMov";
				$columna2[2] = "origen";
				$columna2[3] = "empresa";
				$columna2[4] = "monto";
				$columna2[5] = "banco";
				$columna2[6] = "cuenta";
				$columna2[7] = "realizado";
				$columna2[8] = "folio";
				$columna2[9] = "pdf";
				$columna2[10] = "cuentaFinal";
				$columna2[11] = "fecha";
				$columna2[12] = "hora";

				$empresa = $_POST['empresaDest'];
				$origen = $_POST['origenDest'];
				$monto = $_POST['montoDest'];
				$banco = $_POST['bancoDest'];
				$cuenta = $_POST['cuentaDest'];
				$cuentaFinal = $_POST['cuentaFinalDest'];
				$realizadoDest = $_POST['realizadoDest'];

				$datos2[0]="NULL";
				$datos2[1]=$id;
				$datos2[8]="''";
				$datos2[9]="''";
				$datos2[11]="'".date("Y-m-d")."'";
				$datos2[12]="'".date("H:i:s")."'";

				$registros = count($empresa);

				for($i = 0; $i < $registros; $i++){
					$datos2[2]=extrtae_id('empresas', $origen[$i]);
					$datos2[3]=extrtae_id('empresas', $empresa[$i]);
					$datos2[4]=$monto[$i];
					$datos2[5]="'".$banco[$i]."'";
					$datos2[6]="'".$cuenta[$i]."'";
					$datos2[7]=$realizadoDest[$i];
					$datos2[10]=$cuentaFinal[$i];

					alta($tabla3, $datos2, $columna2);
				}
				//Finaliza actualización de tabla disperciones

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
				$datosReg[1]="'disperciones'";
				$datosReg[2]=$id;
				$datosReg[3]="'Se modifico el proceso con id: ".$id."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);
				//Termina guardado de registro en acciones

				header("Location: ../movimientos/continuaProceso.php");
			}else if($accion == 'finalizar'){
				$id = $_POST['valorId'];

				$columna3[0] = "realizado";

				$idFinal = $_POST['idFinal'];
				$realizadoFinal = $_POST['realizadoFinal'];

				$registros = count($realizadoFinal);
				echo $registros;

				for($i = 0; $i < $registros; $i++){
					$datos3[0]=$realizadoFinal[$i];

					actualiza($tabla2, $datos3, $columna3, $idFinal[$i]);
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
				$datosReg[2]=$id;
				$datosReg[3]="'Se modifico el proceso con id: ".$id."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);
				//Termina guardado de registro en acciones

				header("Location: ../movimientos/continuaProceso.php");
			}else if($accion == 'facturar'){
				$id=$_POST['idMov'];
				$folio=$_POST['folio'];
				$folioAnt=$_POST['folioAnt'];

				$registros = count($id);

				for($i = 0; $i < $registros; $i++){
					$columna4[0] = 'folio';
					
					if($folio[$i] && $folio[$i] <> $folioAnt[$i]){
						$datos4[0]=$folio[$i];
						actualiza($tabla, $datos4, $columna4, $id[$i]);
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
				$datosReg[1]="'movimientoDetalle'";
				$datosReg[2]=0;
				$datosReg[3]="'Se realizo la actualizacion de facturas'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);
				//Termina guardado de registro en acciones

				header("Location: ../movimientos/facturarProceso.php");
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