<?php
	session_start();
	if($_SESSION){
?>

<html>
    <head>
        <title>Sistema de dispersiones</title>
        <!-- Etilos generales -->
		<link rel="stylesheet" type="text/css" href="../css/body_style.css" />
		<!-- Estilos menu -->
		<link rel="stylesheet" type="text/css" href="../css/menu.css" />
        <script language="JavaScript" type="text/javascript">
            function validar(){
            	document.formulario.action = "../php/datosEmpresa.php";
                document.formulario.submit();
            }
            function rellenarFormulario(){
            	if(document.getElementById("listado1").value != 'Seleccion'){
                	document.formulario.action = "../empresas/modificarEmpresa.php";
                	document.formulario.submit();
                }
            }
            function aMayusculas(obj,id){
                obj = obj.toUpperCase();
                document.getElementById(id).value = obj;
            }
        </script>
	</head>
    <body>
    	<div id="principal">
    		<div id="cabecera">
        	    <?php require('../php/menu.php'); ?>
	    	</div>
	    	<div id="contenido">
	    		<?php
					require('../php/const.php');
					require('../php/conexion.php');
					require('../php/utiles.php');

					if (isset($_POST['listado1'])){
    					$idEmpresa = $_POST['listado1'];
    					if($idEmpresa){
    						$mysqli = conectar_db();
    						selecciona_db($mysqli);

    						$Consulta = "SELECT * FROM empresas WHERE id = $idEmpresa";
    						$pConsulta = consulta_tb($mysqli, $Consulta);
    						$row = mysqli_fetch_array($pConsulta);
    						$id = $row[0];
    						$nombre = $row[1];
    						if($row[2] == 1){
    							$tipo = "checked='checked'";
    						}else{
    							$tipo = "";
    						}
    						$activo = $row[3];
    					}
					}else{
						$id = "";
    					$nombre = "";
    					$tipo = "";
    					$activo = "";
					}
				?>

	    		<div id="modificarEmpresa">
					<h1>Modificar Empresa</h1>
					<form name="formulario" method="post">
						<?php
            				echo "<select name='listado1' id='listado1' >";
        						listado("id","nombre","empresas");
        					echo"</select>";
						?>
						<br><br>
						<input type="button" value="Aceptar" onClick="rellenarFormulario()"><br><br><br><br>
						<input type="hidden" name="idEmpresa" id="idEmpresa" value="<?php echo $id; ?>">
						<input type="text" placeholder="Nombre" name="nombre" id="nombre" maxlength="50" onKeyUp="aMayusculas(this.value,this.id)" value="<?php echo $nombre; ?>"><br><br>
						<input type="checkbox" name="tipo" id="tipo" value="Dispersor" <?php echo $tipo; ?>> Dispersor <br><br><br><br>

						<input type="hidden" name="accion" id="accion" value="modificar">
						<input type="button" value="Modificar" onClick="validar()">
					</form>
				</div>
	    	</div>
	    	<div id="pie">
	        	<p>&copy; 2015 by R-Net Systems. Sitio creado por Luis Eduardo Callejas.</p>
	    	</div>
		</div>
    </body>
</html>

<?php
	}else{
		header("Location: ../index.html");
	}
?> 