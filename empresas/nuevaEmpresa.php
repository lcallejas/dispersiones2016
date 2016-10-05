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
	    		<div id="nuevaEmpresa">
					<h1>Nueva Empresa</h1>
					<form name="formulario" method="post">
						<input type="text" placeholder="Nombre" name="nombre" id="nombre" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
						<br><br>
						<input type="checkbox" name="tipo" id="tipo"> Dispersor 
						<br><br><br><br>
						<input type="hidden" name="accion" id="accion" value="alta">
						<input type="button" value="Alta" onClick="validar('NuevaEmpresa')">
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