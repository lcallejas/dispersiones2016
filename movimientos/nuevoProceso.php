<?php
    session_start();
    if($_SESSION){
?>

<html>
    <head>
        <title>Sistema de disperciones</title>
        <!-- Etilos generales -->
		<link rel="stylesheet" type="text/css" href="../css/body_style.css" />
		<!-- Estilos menu -->
		<link rel="stylesheet" type="text/css" href="../css/menu.css" />
		<!-- Scripts para el boton de agregar fila nueva en la tabla. -->
        <script type="text/javascript" src="../js/agregarFilaTabla.js"></script>
        <script type="text/javascript" src="js/limites.js"></script>
        <script language="JavaScript" type="text/javascript">
            function validar(){
                var montoEntrada = document.getElementById("montoEntrada").value;
                var total = parseFloat(document.getElementById("myTableTotal").rows[0].cells[2].innerText);
                if(montoEntrada == total){
                    document.formulario.action = "../php/datosProceso.php";
                    document.formulario.submit();
                }else{
                    alert('El monto de entrada no es igual al monto total depositado.');
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
                ?>
                <form method="POST" name="formulario" id="formulario">
                    <div id="entrada">
                        <?php
                            echo "<h1>Movimiento: ";
                                echo extrae_ultimo_id('movimiento') + 1;
                            echo"</h1>";
                        ?>
                        <br>
                        <div id="formNuevaEmpresa">
                            <div class="izquierda">
                                <h2>Quien:</h2>
                                <input type="text" name="quienEntrada" id="quienEntrada" placeholder="Quien Deposita" maxlength="50" onKeyUp="aMayusculas(this.value,this.id)">
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
                                <input type="text" name="montoEntrada" id="montoEntrada" placeholder="Monto de Entrada" onkeypress="return justNumbers(event);">
                            </div>
                            <div class="izquierda">
                                <h2>Banco:</h2>
                                <input type="text" name="bancoEntrada" id="bancoEntrada" placeholder="Banco" maxlength="50" onKeyUp="aMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Cuenta:</h2>
                                <input type="text" name="cuentaEntrada" id="cuentaEntrada" placeholder="Cuenta" maxlength="50" onKeyUp="aMayusculas(this.value,this.id)">
                            </div>
                        </div>
                        <br><br><br><br><br><br><br>
                        <div id="salidas">
                            <div class="izquierda">
                                <h2>Para:</h2>
                                <input type="text" name="paraDestino" id="paraDestino" placeholder="Destino Final" maxlength="50" onKeyUp="aMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Tipo:</h2>
                                <select name="tipoTransDestino" id="tipoTransDestino">
                                    <option>Seleccion</option>
                                    <option value="0">Transferencia</option>
                                    <option value="1">Efectivo</option>
                                </select>
                            </div>
                            <div class="izquierda">
                                <h2>Monto:</h2>
                                <input type="text" name="montoDestino" id="montoDestino" placeholder="Monto Destino" onkeypress="return justNumbers(event);">
                            </div>
                            <div class="izquierda">
                                <h2>Banco:</h2>
                                <input type="text" name="bancoDestino" id="bancoDestino" placeholder="Banco Destino" maxlength="50" onKeyUp="aMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Cuenta:</h2>
                                <input type="text" name="cuentaDestino" id="cuentaDestino" placeholder="Cuenta Destino" maxlength="50" onKeyUp="aMayusculas(this.value,this.id)">
                            </div>
                            <br><br>
                            <div>
                                <button onclick="myCreateFunction()" type="button">Agregar</button>
                                <button onclick="myDeleteFunction()" type="button">Eliminar</button>
                            </div>
                        </div>

                        <br><br><br><br><br><br><br>
            
                        <table id="myTable" name="myTable" border="1">
                            <tr>
                                <td><strong>Destino</strong></td>
                                <td><strong>Tipo</strong></td>
                                <td><strong>Monto</strong></td>
                                <td><strong>Banco</strong></td>
                                <td><strong>Cuenta</strong></td>
                                <td><strong>Eliminar</strong></td>
                            </tr>
                        </table>
            
                        <table id="myTableTotal" border="1">
                            <tr>
                                <td><strong></strong></td>
                                <td><strong>Monto Total:</strong></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                            </tr>
                        </table>
            
                        <br><br>
            
                        <input type="hidden" name="accion" id="accion" value="alta">
                        <input type="button" value="Registrar Movimiento"  onClick="validar()">
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