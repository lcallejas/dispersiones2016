<?php
        ob_start(); 
	session_start();
	if($_SESSION){

		$permisos = $_SESSION['permisos'];

		//if($permisos == 3){

			require('const.php');
			require('conexion.php');
			require('utiles.php');

			date_default_timezone_set('America/Mexico_City');

			$accion = $_POST['accion'];
			$tabla = "usuarios";
			$tablaReg="acciones";

			//Columnas de tabla accion
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
				$columna[2] = "usuario";
				$columna[3] = "pass";
				$columna[4] = "tipo";
				$columna[5] = "activo";
				$columna[6] = "root";

				$datos[0]="NULL";
				$datos[1]="'".$_POST['nombre']."'";
	    		$datos[2]="'".$_POST['usuario']."'";
    			$datos[3]="'".$_POST['pass']."'";
	    		$datos[4]=$_POST['permisos'];
				$datos[5]=1;
				$datos[6]=0;

				alta($tabla, $datos, $columna);

				//Guardado de registro en acciones
				$datosReg[0]="NULL";
				$datosReg[1]="'usuarios'";
				$datosReg[2]=extrae_ultimo_id("usuarios");
				$datosReg[3]="'Se dio de alta al usuario con id: ".extrae_ultimo_id("usuarios")."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);

				header("Location: ../usuarios/nuevoUsuario.php");
			}else if($accion == 'baja'){
				$dato = $_POST['listado'];
				
				baja($tabla, $dato);

				//Guardado de registro en acciones
				$datosReg[0]="NULL";
				$datosReg[1]="'usuarios'";
				$datosReg[2]=$dato;
				$datosReg[3]="'Se dio de baja al usuario con id: ".$dato."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);

				header("Location: ../usuarios/eliminarUsuario.php");
			}else if($accion == 'modificar'){
				$id = $_POST['idUsuario'];

				$columna[0] = "nombre";
				$columna[1] = "usuario";
				$columna[2] = "pass";
				$columna[3] = "tipo";

				$datos[0]="'".$_POST['nombre']."'";
	    		$datos[1]="'".$_POST['usuario']."'";
    			$datos[2]="'".$_POST['pass']."'";
	    		$datos[3]=$_POST['permisos'];

				actualiza($tabla, $datos, $columna, $id);

				//Guardado de registro en acciones
				$datosReg[0]="NULL";
				$datosReg[1]="'usuarios'";
				$datosReg[2]=$id;
				$datosReg[3]="'Se modifico el usuario con id: ".$id."'";
				$datosReg[4]=$_SESSION['usuario'];
				$datosReg[5]="'".date("Y-m-d")."'";
				$datosReg[6]="'".date("H:i:s")."'";

				alta($tablaReg, $datosReg, $columnaReg);

				header("Location: ../usuarios/modificarUsuarios.php");
			}else{
				echo "No cuentas con los permisos necesarios para realizar esta acción";
			}

		/*}else{
			header("Location: ../index.html");
		}*/
	}else{
		header("Location: ../index.html");
	}
        ob_en_flush(); 
?>