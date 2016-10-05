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
			$tabla2 = "movimientoDirecto";
			$tabla3 = "disperciones";
			$tabla4 = "movimientoFinal";
			$tablaReg="acciones";


			$datos[0] = "'".$_POST['empresaEntrada']."'";
			$datos[1] = $_POST['totalNominas'];

			$columna[0] = "origen";
			$columna[1] = "monto";

			$id = $_POST['valorId'];

			actualiza($tabla, $datos, $columna, $id);

			//Finaliza actualización de la tabla movimiento.

			//Comienza actualización de la tabla movimientoDirecto.

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

			elimina($tabla2, $columna2[1], $id);

			$datos2[0]="NULL";
			$datos2[1]=$id;
			$datos2[2]="'".$_POST['empresaEntrada']."'";
			    $idEmp = $_POST['idEmp'];
				$montoEnt = $_POST['montoEnt'];
				$bancoEnt = $_POST['bancoEnt'];
				$cuentaEnt = $_POST['cuentaEnt'];
				$realizadoEnt = $_POST['realizadoEnt'];
			$datos2[8]="''";
			$datos2[9]="'".$_POST['fechaEntrada']."'";
			$datos2[10]="'".$_POST['horaEntrada']."'";
			$datos2[11]="''";

			$registros = count($idEmp);
			echo "Movimientos Directos";
			echo $registros;

			for($i = 0; $i < $registros; $i++){
				$datos2[3]=$idEmp[$i];
				$datos2[4]=$montoEnt[$i];
				$datos2[5]="'".$bancoEnt[$i]."'";
				$datos2[6]="'".$cuentaEnt[$i]."'";
				$datos2[7]=$realizadoEnt[$i];
				
				alta($tabla2, $datos2, $columna2);
			}

			//Finaliza actualización de la tabla movimientoDirecto.

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

			//Comienza actualización de tabla movimientoFinal.

			elimina($tabla4, "idMov", $id);

			$columna4[0] = "id";
			$columna4[1] = "idMov";
			$columna4[2] = "empresa";
			$columna4[3] = "tipoTrans";
			$columna4[4] = "monto";
			$columna4[5] = "banco";
			$columna4[6] = "cuenta";
			$columna4[7] = "realizado";
			$columna4[8] = "tipo";
			$columna4[9] = "pdf";
			$columna4[10] = "fecha";
			$columna4[11] = "hora";
			$columna4[12] = "comentario";
			$columna4[13] = "dispersora";

			$datos4[0]="NULL";
			$datos4[1]=$id;
				$idFinal = $_POST['idParaDestino'];
			    $paraDestino = $_POST['paraDestino'];
				$tipoTransDestino = $_POST['tipoTransDestino'];
				$montoDestino = $_POST['montoDestino'];
				$dispersoraDestino = $_POST['dispersoraDestino'];
				$bancoDestino = $_POST['bancoDestino'];
				$cuentaDestino = $_POST['cuentaDestino'];
				$comentarioDestino = $_POST['comentarioDestino'];
				$pdfAnterior = $_POST['pdfAnt'];
			$datos4[8]=0;
			$datos4[10]="'".date("Y-m-d")."'";
			$datos4[11]="'".date("H:i:s")."'";

			$registros = count($paraDestino);
			echo $registros;

			$columna5[0]="pdf";
			$columna6[0] = "realizado";

			for($i = 0; $i < $registros; $i++){
				$datos4[2]="'".$paraDestino[$i]."'";
				$datos4[3]=$tipoTransDestino[$i];
				$datos4[4]=$montoDestino[$i];
				$datos4[13]="'".$dispersoraDestino[$i]."'";
				$datos4[5]="'".$bancoDestino[$i]."'";
				$datos4[6]="'".$cuentaDestino[$i]."'";
				if($pdfAnterior[$i] != ""){
					$datos4[7]=1;
				}else{
					$datos4[7]=0;
				}
				$datos4[9]="'".$pdfAnterior[$i]."'";
				$datos4[12]="'".$comentarioDestino[$i]."'";
				alta($tabla4, $datos4, $columna4);

				$idPDF = extrae_ultimo_id("movimientoFinal");
				if($tmp_name = $_FILES["pdf"]["tmp_name"][$i]){
					echo "Si entra";
       				$name = "$idPDF.pdf";
       				if(move_uploaded_file($tmp_name, "../pdfsFinales/$name")){
       					$datos5[0]="'../pdfsFinales/$name'";
       					$datos6[0]=1;
        				actualiza($tabla4, $datos5, $columna5, $idPDF);
						actualiza($tabla4, $datos6, $columna6, $idPDF);
       				}
       			}
			}
			
			header("Location: ../movimientos/modificaProceso.php");		
		/*}else{
			header("Location: ../index.html");
		}*/
	}else{
		header("Location: ../index.html");
	}
        ob_en_flush(); 
?>