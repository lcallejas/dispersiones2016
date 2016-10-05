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

			$tabla = "movimiento";
			$tabla2 = "movimientoNominas";
			$tabla3 = "disperciones";
			$tablaReg="acciones";


			$datos[0] = "'".$_POST['empresaEntrada']."'";
			$datos[1] = $_POST['totalNominas'];

			$columna[0] = "origen";
			$columna[1] = "monto";

			$id = $_POST['valorId'];

			actualiza($tabla, $datos, $columna, $id);

			//Finaliza actualización de la tabla movimiento.

			//Comienza actualización de la tabla movimientoNominas.

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
			$columna2[11] = "comentario";
			$columna2[12] = "pdf";

			elimina($tabla2, $columna2[1], $id);

			$datos2[0]="NULL";
			$datos2[1]=$id;
			$datos2[2]="'".$_POST['empresaEntrada']."'";
			    $idEmp = $_POST['idEmp'];
				$montoEnt = $_POST['montoEnt'];
				$bancoEnt = $_POST['bancoEnt'];
				$cuentaEnt = $_POST['cuentaEnt'];
				$realizadoEnt = $_POST['realizadoEnt'];
				$comentarioEnt = $_POST['comentarioEnt'];
			$datos2[8]="''";
			$datos2[9]="'".$_POST['fechaEntrada']."'";
			$datos2[10]="'".$_POST['horaEntrada']."'";
			$datos2[12]="''";

			$registros = count($idEmp);

			for($i = 0; $i < $registros; $i++){
				$datos2[3]=$idEmp[$i];
				$datos2[4]=$montoEnt[$i];
				$datos2[5]="'".$bancoEnt[$i]."'";
				$datos2[6]="'".$cuentaEnt[$i]."'";
				$datos2[7]=$realizadoEnt[$i];
				$datos2[11]="'".$comentarioEnt[$i]."'";
				
				alta($tabla2, $datos2, $columna2);
			}

			//Finaliza actualización de la tabla movimientoNominas.

			//Comienza actualización de tabla disperciones.

			elimina($tabla3, "idMov", $id);

			$columna3[0] = "id";
			$columna3[1] = "idMov";
			$columna3[2] = "origen";
			$columna3[3] = "empresa";
			$columna3[4] = "monto";
			$columna3[5] = "banco";
			$columna3[6] = "cuenta";
			$columna3[7] = "realizado";
			$columna3[8] = "folio";
			$columna3[9] = "pdf";
			$columna3[10] = "cuentaFinal";
			$columna3[11] = "fecha";
			$columna3[12] = "hora";

			$empresa = $_POST['empresaDest'];
			$origen = $_POST['origenDest'];
			$monto = $_POST['montoDest'];
			$banco = $_POST['bancoDest'];
			$cuenta = $_POST['cuentaDest'];
			$cuentaFinal = $_POST['cuentaFinalDest'];
			$realizadoDest = $_POST['realizadoDest'];
			$folio = $_POST['folio'];
			$pdfAnteriorDisp = $_POST['pdfAntDisp'];

			$datos3[0]="NULL";
			$datos3[1]=$id;
			$datos3[11]="'".date("Y-m-d")."'";
			$datos3[12]="'".date("H:i:s")."'";

			$registros = count($empresa);

			$columna7[0]="pdf";
			$columna8[0] = "realizado";

			for($i = 0; $i < $registros; $i++){
				$datos3[2]=extrtae_id('empresas', $origen[$i]);
				$datos3[3]=extrtae_id('empresas', $empresa[$i]);
				$datos3[4]=$monto[$i];
				$datos3[5]="'".$banco[$i]."'";
				$datos3[6]="'".$cuenta[$i]."'";
				$datos3[7]="'".$realizadoDest[$i]."'";
				$datos3[8]="'".$folio[$i]."'";
				$datos3[9]="'".$pdfAnteriorDisp[$i]."'";
				$datos3[10]=$cuentaFinal[$i];

				alta($tabla3, $datos3, $columna3);

				$idPDFDisp = extrae_ultimo_id("disperciones");
				if($tmp_name = $_FILES["pdfDisp"]["tmp_name"][$i]){
					echo "Si entra";
       				$name = "$idPDFDisp.pdf";
       				if(move_uploaded_file($tmp_name, "../pdfsDispersiones/$name")){
       					$datos7[0]="'../pdfsDispersiones/$name'";
       					$datos8[0]=1;
        				actualiza($tabla3, $datos7, $columna7, $idPDFDisp);
						actualiza($tabla3, $datos8, $columna8, $idPDFDisp);
       				}
       			}
			}

			//Finaliza actualización de tabla disperciones.
			
			header("Location: ../movimientos/modificaProceso.php");
		/*}else{
			header("Location: ../index.html");
		}*/
	}else{
		header("Location: ../index.html");
	}
        ob_en_flush(); 
?>