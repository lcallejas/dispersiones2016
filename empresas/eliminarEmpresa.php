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
        <!-- Límites de los campos de texto -->
        <script type="text/javascript" src="../js/limites.js"></script>
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
				?>
	    		<div id="eliminarEmpresa">
					<h1>Eliminar Empresa</h1>
					<form name="formulario" method="post">
						<?php
            				echo "<select name='listado' id='listado' >";
        						listado("id","nombre","empresas");
        					echo"</select>";
						?>
						<br><br><br><br>
						<input type="hidden" name="accion" id="accion" value="baja">
						<input type="button" value="Eliminar" onClick="validar('EliminarEmpresa')">
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