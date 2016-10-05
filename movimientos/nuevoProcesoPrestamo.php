<?php
    session_start();
    if($_SESSION){

        require('../php/const.php');
        require('../php/conexion.php');
        require('../php/utiles.php');
?>

<html>
    <head>
        <title>Sistema de dispersiones</title>
        <!-- Etilos generales -->
		<link rel="stylesheet" type="text/css" href="../css/body_style.css" />
		<!-- Estilos menu -->
		<link rel="stylesheet" type="text/css" href="../css/menu.css" />
		<!-- Scripts para el boton de agregar fila nueva en la tabla. -->
        <script type="text/javascript" src="../js/agregarFilaTabla5.js"></script>
        <script type="text/javascript" src="../js/limites.js"></script>
    </head>
    <body>
    	<div id="principal">
    		<div id="cabecera">
        	    <?php require('../php/menu.php'); ?>
	    	</div>
	    	<div id="contenido">
                <form method="POST" name="formulario" id="formulario">
                    <div id="entrada">
                        <?php
                            echo "<h1>Movimiento Prestamo: ";
                                echo extrae_ultimo_id('movimiento') + 1;
                            echo"</h1>";
                        ?>
                        <br>
                        <div id="formNuevaEmpresa">
                            <div class="izquierda">
                                <h2>Quien:</h2>
                                <input type="text" name="quienSalida" id="quienSalida" placeholder="Quien Presta" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>A:</h2>
                                <input type="text" name="quienEntrada" id="quienEntrada" placeholder="Quien Recibe" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Monto:</h2>
                                <input type="text" name="montoEntrada" id="montoEntrada" placeholder="Monto de Entrada" onkeypress="return soloNumeros(event);">
                            </div>
                            <div class="izquierda">
                                <h3>Banco/Cuenta<br>Dispersora:</h3>
                                <input type="text" name="bancoOrigen" id="bancoOrigen" placeholder="Banco/Cuenta Dispersora" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h3>Banco/Cuenta:<br>Destino</h3>
                                <input type="text" name="bancoDestino" id="bancoDestino" placeholder="Banco/Cuenta Destino" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Comentario:</h2>
                                <input type="text" name="comentarioDestino" id="comentarioDestino" placeholder="Comentario" maxlength="450" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                        </div>
                        <br><br><br><br><br><br><br><br>
            
                        <input type="hidden" name="accion" id="accion" value="alta">
                        <input type="button" value="Registrar Movimiento"  onClick="validar('NuevoProcesoPrestamo')">
                    </div>
                </form>
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