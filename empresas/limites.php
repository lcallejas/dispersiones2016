<?php
	session_start();
	if($_SESSION){

    require('../php/const.php');
    require('../php/conexion.php');
    require('../php/utiles.php');

    if (isset($_POST['listado1'])){
        $idEmpresa = $_POST['listado1'];
        if($idEmpresa){
            $row = rellenaFormulario("empresas", $idEmpresa);
            $id = $row[0];
            $nombre = $row[1];
        }
    }else{
        $id = "";
        $nombre = "";
    }
?>

<html>
    <head>
        <title>Sistema de dispersiones</title>
        <!-- Etilos generales -->
		<link rel="stylesheet" type="text/css" href="../css/body_style.css" />
		<!-- Estilos menu -->
		<link rel="stylesheet" type="text/css" href="../css/menu.css" />
        <!-- Límites de los campos de texto -->
        <script type="text/javascript" src="../js/limites.js"></script>
        <script type="text/javascript" src="../js/agregarFilaTablaLimites.js"></script>
	</head>
    <body>
    	<div id="principal">
    		<div id="cabecera">
        	    <?php require('../php/menu.php'); ?>
	    	</div>

	    	<div id="contenido">
	    		<div id="modificarEmpresa">
					<h1>Editar Límites</h1>
					<form name="formulario" method="post">
						<?php
            				echo "<select name='listado1' id='listado1' >";
        						listado("id","nombre","empresas");
        					echo"</select>";
						?>
						<br><br>
						<input type="button" value="Aceptar" onClick="procesaLimites()">
                        <br><br>
                        <div id="limites">
                            <div class="izquierda">
                                <h2>De:</h2>
                                <input type="text" name="empresa" id="empresa" placeholder="Empresa Origen" onkeypress="return soloNumeros(event);" disabled value="<?php echo $nombre; ?>">
                            </div>
                            <div class="izquierda">
                                <h2>Para:</h2>
                                <?php
                                    echo "<select name='listado' id='listado' >";
                                        listado("dispersor","nombre","empresas");
                                    echo"</select>";
                                ?>
                            </div>
                            <div class="izquierda">
                                <h2>Límite:</h2>
                                <input type="text" name="montoLimite" id="montoLimite" placeholder="Monto Limite" onkeypress="return soloNumeros(event);">
                            </div>
                            <br><br>
                            <div class="derecha">
                                <button onclick="myCreateFunction()" name="agregarFila" id="agregarFila" type="button">Agregar</button>
                                <button onclick="myDeleteFunction()" type="button">Eliminar</button>
                            </div>
                        </div>

                        <br><br><br><br>
            
                        <table id="myTable" name="myTable" border="1">
                            <tr>
                                <td><strong>Origen</strong></td>
                                <td><strong>Destino</strong></td>
                                <td><strong>Límite</strong></td>
                                <td><strong>Eliminar</strong></td>
                            </tr>
                            <?php
                                tabla_limites($id);
                            ?>
                        </table>

                        <br><br><br><br>

						<input type="hidden" name="accion" id="accion" value="modificar">
						<input type="button" value="Guardar" onClick="validar('ModificarLimites')">
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