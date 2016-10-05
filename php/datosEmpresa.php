<?php
        ob_start(); 
	session_start();
	if($_SESSION){

		$permisos = $_SESSION['permisos'];

		//if($permisos == 1){

			date_default_timezone_set('America/Mexico_City');

			require('const.php');
			require('conexion.php');
			require('utiles.php');

			$accion = $_POST['accion'];
			$tabla = "empresas";
			$tablaReg="acciones";

			//Columnas de tabla acciones
			$columnaReg[0] = "id";
			$columnaReg[1] = "tabla";
			$columnaReg[2] = "idTabla";
			$columnaReg[3] = "descripcion";
			$columnaReg[4] = "usuario";
			$columnaReg[5] = "fecha";
			$columnaReg[6] = "hora";
		
			if($accion == 'alta'){
				$columna[0] = "id";
				$columna[1] = "nombre";
				$columna[2] = "dispersor";
				$columna[3] = "activo";

				$datos[0]="NULL";
				$datos[1]="'".$_POST['nombre']."'";
				if($_POST["tipo"]) $numero = 1;
    			else $numero = 0;
	    		$datos[2]=$numero;
    			$datos[3]=1;

				alta($tabla, $datos, $columna);

				//Guardado de registro en acciones
				$datosReg[0]="NULL";
				$datosReg[1]="'empresas'";
				$datosReg[2]=extrae_ultimo_id("empresas");
				$datosReg[3]="'Se dio de alta a la empresa con id: ".extrae_ultimo_id("empresas")."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);

				header("Location: ../empresas/nuevaEmpresa.php");
			}else if($accion == 'baja'){
				$dato = $_POST['listado'];
		
				baja($tabla, $dato);

				//Guardado de registro en acciones
				$datosReg[0]="NULL";
				$datosReg[1]="'empresas'";
				$datosReg[2]=$dato;
				$datosReg[3]="'Se dio de baja a la empresa con id: ".$dato."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);

				header("Location: ../empresas/eliminarEmpresa.php");
			}else if($accion == 'modificar'){
				$id = $_POST['idEmpresa'];

				$columna[0] = "nombre";
				$columna[1] = "dispersor";

				$datos[0]="'".$_POST['nombre']."'";
				if($_POST['tipo']) $numero = 1;
    			else $numero = 0;
    			$datos[1]=$numero;
	    		
				actualiza($tabla, $datos, $columna, $id);

				//Guardado de registro en acciones
				$datosReg[0]="NULL";
				$datosReg[1]="'empresas'";
				$datosReg[2]=$id;
				$datosReg[3]="'Se modifico la empresa con id: ".$id."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);

				header("Location: ../empresas/modificarEmpresas.php");
			}else{
				echo "No cuentas con los permisos necesarios para realizar esta acción";
			}

		/*}else{
			header("Location: ../index.html");
		}*/
	}else{
		header("Location: ../indexhtml");
	}
        ob_en_flush();
?>