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
	    		<div id="nuevoUsuario">
					<h1>Nuevo Usuario</h1>
					<form name="formulario" method="post">
						<input type="text" placeholder="Nombre" name="nombre" id="nombre" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)"><br><br>
						<input type="text" placeholder="Usuario" name="usuario" id="usuario" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)"><br><br>
						<input type="password" placeholder="pass" name="pass" id="pass" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)"><br><br>
<!--						
						<select name="permisos" id="permisos">
							<option>Seleccion</option>
							<option value="3">Administrador</option>
							<option value="1">Contador</option>
							<option value="2">Dispersor</option>
							<option value="4">Visitante</option>
						</select><br><br><br><br>
-->						
						<select name="permisos" id="permisos">
							<option>Seleccion</option>
							<option value="1">Administrador</option>
							<option value="2">Director</option>
							<option value="3">Gerente</option>
							<option value="4">Dispersora</option>
							<option value="5">Capturista</option>
							<option value="6">Aux. Dirección</option>
						</select><br><br><br><br>
						<input type="hidden" name="accion" id="accion" value="alta">
						<input type="button" value="Alta" onClick="validar('NuevoUsuario')">
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