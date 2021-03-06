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
        <script type="text/javascript" src="../js/agregarFilaTabla3.js"></script>
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
                            echo "<h1>Movimiento Nominas: ";
                                echo extrae_ultimo_id('movimiento') + 1;
                            echo"</h1>";
                        ?>
                        <br>
                        <div id="formNuevaEmpresa">
                            <div class="izquierda">
                                <h2>Quien:</h2>
                                <input type="text" name="quienEntrada" id="quienEntrada" placeholder="Quien Deposita" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>A:</h2>
                                <?php
                                    echo "<select name='listado1' id='listado1' >";
                                        listado("id","nombre","empresas");
                                    echo"</select>";
                                ?>
                            </div>
                            <div class="izquierda">
                                <h2>Monto:</h2>
                                <input type="text" name="montoEntrada" id="montoEntrada" placeholder="Monto de Entrada" onkeypress="return soloNumeros(event);">
                            </div>
                            <div class="izquierda">
                                <h2>Banco:</h2>
                                <input type="text" name="bancoEntrada" id="bancoEntrada" placeholder="Banco" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Cuenta:</h2>
                                <input type="text" name="cuentaEntrada" id="cuentaEntrada" placeholder="Cuenta" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Comentario:</h2>
                                <input type="text" name="comentarioEntrada" id="comentarioEntrada" placeholder="Comentario" maxlength="450" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <br><br>
                            <div>
                                <button onclick="myCreateFunctionNominas()" type="button">Agregar</button>
                                <button onclick="myDeleteFunctionNominas()" type="button">Eliminar</button>
                            </div>
                        </div>
                        <br><br><br><br>
            
                        <table id="myTableNominas" name="myTableNominas" border="1">
                            <tr>
                                <td><strong>Empresa</strong></td>
                                <td><strong>Monto</strong></td>
                                <td><strong>Banco</strong></td>
                                <td><strong>Cuenta</strong></td>
                                <td><strong>Comentario</strong></td>
                                <td><strong>Eliminar</strong></td>
                            </tr>
                        </table>
            
                        <table id="myTableTotalNominas" border="1">
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                            </tr>
                        </table>
            
                        <br><br>
            
                        <input type="hidden" name="accion" id="accion" value="alta">
                        <input type="button" value="Registrar Movimiento"  onClick="validar('NuevoProcesoNominas')">
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