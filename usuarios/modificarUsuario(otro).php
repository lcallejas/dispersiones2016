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
            	document.formulario.action = "../php/datosUsuario.php";
                document.formulario.submit();
            }
            function rellenarFormulario(){
            	if(document.getElementById("listado1").value != 'Seleccion'){
                	document.formulario.action = "../usuarios/modificarUsuario.php";
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
    					$usuario = $_POST['listado1'];
    					if($usuario <> 'Seleccion'){
    						$mysqli = conectar_db();
    						selecciona_db($mysqli);

    						$Consulta = "SELECT * FROM usuarios WHERE id = $usuario";
    						$pConsulta = consulta_tb($mysqli, $Consulta);
    						$row = mysqli_fetch_array($pConsulta);
    						$id = $row[0];
    						$nombre = $row[1];
    						$user = $row[2];
    						$pass = $row[3];
    						if($row[4] == 1){
    							$tipo = "Contador";
    						}else if($row[4] == 2){
    							$tipo = "Dispersor";
    						}else if($row[4] == 3){
    							$tipo = "Administrador";
    						}else{
    							$tipo = "Visitante";
    						}
    						$activo = $row[5];
    					}
					}else{
						$id = "";
    					$nombre = "";
    					$user = "";
    					$pass = "";
    					$tipo = "";
    					$activo = "";
					}
				?>
	    		<div id="modificarUsuario">
					<h1>Modificar Usuario</h1>
					<form name="formulario" method="post">
						<?php
            				echo "<select name='listado1' id='listado1' >";
        						listado("id","nombre","usuarios");
        					echo"</select>";
						?>
						<br><br>
						<input type="button" value="Aceptar" onClick="rellenarFormulario()"><br><br><br><br>
						<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $id; ?>">
						<input type="text" placeholder="Usuario" name="usuario" id="usuario" maxlength="50" onKeyUp="aMayusculas(this.value,this.id)" value="<?php echo $user; ?>"><br><br>
						<input type="password" placeholder="pass" name="pass" id="pass" maxlength="50" onKeyUp="aMayusculas(this.value,this.id)" value="<?php echo $pass; ?>"><br><br>
						<select name="permisos" id="permisos">
							<option>Seleccion</option>
							<option <?php if($tipo=="Administrador") echo "selected='Administrador'"; ?>>Administrador</option>
							<option <?php if($tipo=="Contador") echo "selected='Contador'"; ?>>Contador</option>
							<option <?php if($tipo=="Disperciones") echo "selected='Dispersor'"; ?>>Dispersor</option>
							<option <?php if($tipo=="Visitante") echo "selected='Visitante'"; ?>>Visitante</option>
						</select>
						<br><br><br><br>

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