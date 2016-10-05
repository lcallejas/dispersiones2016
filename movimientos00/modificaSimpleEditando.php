<?php
    session_start();
    if($_SESSION){
                    
        require('../php/const.php');
        require('../php/conexion.php');
        require('../php/utiles.php');

        $valor = $_POST['valor'];

        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT fecha, hora, origen FROM movimiento WHERE id = $valor";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        $row = mysqli_fetch_array($pConsulta);
?>

<html>
    <head>
        <title>Sistema de dispersiones</title>
        <!-- Etilos generales -->
        <link rel="stylesheet" type="text/css" href="../css/body_style.css" />
        <!-- Estilos menu -->
        <link rel="stylesheet" type="text/css" href="../css/menu.css" />
        <!-- Scripts para el boton de agregar fila nueva en la tabla. -->
        <script type="text/javascript" src="../js/agregarFilaTabla8.js"></script>
        <script type="text/javascript" src="../js/limites.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
    </head>
    <body onload="setTotalSimple();setTotal();setTotalFinal();">
        <div id="principal">
            <div id="cabecera">
                <?php require('../php/menu.php'); ?>
            </div>
            <div id="contenido">
                <form method="POST" name="formulario" id="formulario" enctype="multipart/form-data">
                    <div id="entrada">
                        <div class="izquierda">
                            <?php
                                echo "<h1>Modificar Movimiento Simple: ";
                                    echo "<input type='hidden' name='valorId' value='".$valor."'>".$valor;
                                echo"</h1>";
                            ?>
                        </div>
                        <div class="derecha">
                            <?php
                                echo "<h2><label><input type='hidden' name='horaEntrada' value='".$row[1]."'>".$row[1]."</label></h2>";
                            ?>
                        </div>
                        <div class="derecha">
                            <?php
                                echo "<h2><label><input type='hidden' name='fechaEntrada' value='".$row[0]."'>".date_format(date_create($row[0]), 'd / m / Y')."</label></h2>";
                            ?>
                        </div>
                        <br><br><br><br><br>
                        <div id="formNuevaEmpresa">
                            <div class="izquierda">
                                <h2>De:</h2>
                                <?php
                                    echo "<input type='text' name='empresaEntrada' id='empresaEntrada' onKeyUp='soloMayusculas(this.value,this.id)' placeholder='Quien deposita' value='".$row[2]."'>";
                                ?>
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
                            <br><br>
                            <div>
                                <button onclick="myCreateFunctionSimple()" type="button">Agregar</button>
                                <button onclick="myDeleteFunctionSimple()" type="button">Eliminar</button>
                            </div>
                        </div>
                        <br><br><br>
            
                        <table id="myTableSimple" name="myTableSimple" border="1">
                            <tr>
                                <td><strong>Empresa</strong></td>
                                <td><strong>Monto</strong></td>
                                <td><strong>Banco</strong></td>
                                <td><strong>Cuenta</strong></td>
                                <td><strong>Realizado</strong></td>
                                <td><strong>Eliminar</strong></td>
                            </tr>
                            <?php
                                tabla_mov_incompletos_simple_modific($valor);
                            ?>
                        </table>
            
                        <table id="myTableTotalSimple" border="1">
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

                        <h2>Dispersiones</h2>

                        <br>
                        <div id="salidas">
                            <div class="izquierda">
                                <h2>De:</h2>
                                <?php
                                    echo "<select name='origenSalida' id='origenSalida' >";
                                        listado("dispersor","nombre","empresas");
                                    echo"</select>";
                                ?>
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
                                <h2>Monto:</h2>
                                <input type="text" name="montoSalida" id="montoSalida" placeholder="Monto Destino" onkeypress="return soloNumeros(event);">
                            </div>
                            <div class="izquierda">
                                <h3>Banco/Cuenta<br>Origen:</h3>
                                <input type="text" name="bancoSalida" id="bancoSalida" placeholder="Banco/Cuenta Origen" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h3>Banco/Cuenta<br>Destino:</h3>
                                <input type="text" name="cuentaSalida" id="cuentaSalida" placeholder="Banco/Cuenta Destino" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <br><br><br>
                            <div class="izquierda">
                                <input type="checkbox" name="checkCuentaFinal" id="checkCuentaFinal"> Cuenta Final
                            </div>
                            <br><br>
                            <div class="derecha">
                                <button onclick="myCreateFunction()" name="agregarFila" id="agregarFila" type="button">Agregar</button>
                                <button onclick="myDeleteFunction()" type="button">Eliminar</button>
                            </div>
                        </div>

                        <br><br><br>
            
                        <table id="myTable" name="myTable" border="1">
                            <tr>
                                <td><strong>Origen</strong></td>
                                <td><strong>Destino</strong></td>
                                <td><strong>Monto</strong></td>
                                <td><strong>Origen</strong></td>
                                <td><strong>Destino</strong></td>
                                <td><strong>Cuenta Final</strong></td>
                                <td><strong>Realizado</strong></td>
                                <td><strong>Folio</strong></td>
                                <td class='botonFile'><strong>PDF</strong></td>
                                <td><strong>Eliminar</strong></td>
                            </tr>
                            <?php
                                tabla_mov_incompletos_simple_modific_dispersiones($valor);
                            ?>
                        </table>
            
                        <table id="myTableTotal" border="1">
                            <tr>
                                <td><label></label></td>
                                <td><strong>Total en Dispersora:</strong></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td class='botonFile'><label></label></td>
                                <td><label></label></td>
                            </tr>
                        </table>
                        <br><br>

                        <h2>Finales</h2>

                        <br>
                        <div id="salidas">
                            <div class="izquierda">
                                <h2>Para:</h2>
                                <input type="text" name="paraFinal" id="paraFinal" placeholder="Destino Final" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Tipo:</h2>
                                <select name="tipoTransFinal" id="tipoTransFinal">
                                    <option>Seleccion</option>
                                    <option value="0">Transferencia</option>
                                    <option value="1">Efectivo</option>
                                    <option value="2">Nómina</option>
                                </select>
                            </div>
                            <div class="izquierda">
                                <h2>Monto:</h2>
                                <input type="text" name="montoFinal" id="montoFinal" placeholder="Monto Destino" onkeypress="return soloNumeros(event);">
                            </div>
                            <div class="izquierda">
                                <h2>Banco:</h2>
                                <input type="text" name="bancoFinal" id="bancoFinal" placeholder="Banco Destino" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Cuenta:</h2>
                                <input type="text" name="cuentaFinal" id="cuentaFinal" placeholder="Cuenta Destino" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h2>Comentario:</h2>
                                <input type="text" name="comentarioFinal" id="comentarioFinal" placeholder="Comentario" maxlength="450" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <br><br>
                            <div>
                                <button onclick="myCreateFunctionFinal()" type="button">Agregar</button>
                                <button onclick="myDeleteFunctionFinal()" type="button">Eliminar</button>
                            </div>
                        </div>

                        <br><br><br><br>
            
                        <table id="myTableFinal" name="myTableFinal" border="1">
                            <tr>
                                <td><strong>Destino</strong></td>
                                <td><strong>Tipo</strong></td>
                                <td><strong>Monto</strong></td>
                                <td><strong>Banco</strong></td>
                                <td><strong>Cuenta</strong></td>
                                <td><strong>Comentario</strong></td>
                                <td class='botonFile'><strong>Realizado</strong></td>
                                <td><strong>Eliminar</strong></td>
                            <?php
                                tabla_mov_incompletos_simple_modific_finales($valor);
                            ?>
                            </tr>
                        </table>
            
                        <table id="myTableTotalFinal" border="1">
                            <tr>
                                <td><strong></strong></td>
                                <td><strong>Monto Total:</strong></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td class='botonFile'><label></label></td>
                                <td><label></label></td>
                            </tr>
                        </table>
            
                        <br><br>
            
                        <input type="hidden" name="accion" id="accion" value="modificar">
                        <input type="button" name="registrarButton" value="Registrar Movimiento"  onClick="validar('ModificarSimpleCompleto')">

                        <br><br><br>
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