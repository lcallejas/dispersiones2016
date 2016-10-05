<?php
    session_start();
    if($_SESSION){
        require('../php/const.php');
        require('../php/conexion.php');
        require('../php/utiles.php');

        $valor = $_POST['valor'];

        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT a.fecha, a.hora, a.origen, a.monto, a.realizado FROM empresas b, movimiento a WHERE a.id = $valor AND a.empresa = b.id";
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
        <script type="text/javascript" src="../js/agregarFilaTabla2.js"></script>
        <script type="text/javascript" src="../js/limites.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
    </head>
    <body onload="setTotalDirecto();setTotal();desactivar();">
        <div id="principal">
            <div id="cabecera">
                <?php require('../php/menu.php'); ?>
            </div>
            <div id="contenido">
                <form method="POST" name="formulario" id="formulario">
                    <div id="entrada">
                        <div class="izquierda">
                            <?php
                                echo "<h1>Continuar Movimiento Directo: ";
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
                                    echo "<label name='empresaEntrada' id='empresaEntrada' >";
                                        echo $row[2];
                                    echo"</label>";
                                ?>
                            </div>
                            <div class="izquierda">
                                <h2>Monto:</h2>
                                <?php
                                    echo "<label name='montoEntrada' id='montoEntrada' >";
                                        echo $row[3];
                                    echo"</label>";
                                ?>
                            </div>
                        </div>
                        <br><br><br><br><br><br><br>
            
                        <table id="myTableDirecto" name="myTableDirecto" border="1">
                            <tr>
                                <td><strong>Empresa</strong></td>
                                <td><strong>Monto</strong></td>
                                <td><strong>Banco</strong></td>
                                <td><strong>Cuenta</strong></td>
                                <td><strong>Realizado</strong></td>
                            </tr>
                            <?php
                                tabla_mov_incompletos6($valor);
                            ?>
                        </table>
            
                        <table id="myTableTotalDirecto" border="1">
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                                <td><label></label></td>
                            </tr>
                        </table>
                        <br><br><br>
                        <div id="salidas">
                            <div class="izquierda">
                                <h2>De:</h2>
                                <?php
                                    echo "<select name='origenSalida' id='origenSalida' onchange='limites()' >";
                                        listado("dispersor","nombre","empresas");
                                    echo"</select>";
                                ?>
                            </div>
                            <div class="izquierda">
                                <h2>Para:</h2>
                                <?php
                                    echo "<select name='listado' id='listado' onchange='limites()' >";
                                        listado("dispersor","nombre","empresas");
                                    echo"</select>";
                                ?>
                            </div>
                            <div class="izquierda" id="limiteSalidaDiv" hidden>
                                <h2>Limite:</h2>
                                <input type="text" name="limiteSalida" id="limiteSalida" placeholder="Limite Destino" onkeypress="return soloNumeros(event);">
                            </div>
                            <div class="izquierda">
                                <h2>Monto:</h2>
                                <input type="text" name="montoSalida" id="montoSalida" placeholder="Monto Destino" onkeypress="return soloNumeros(event);">
                            </div>
                            <div class="izquierda">
                                <h3>Banco/Cuenta<br>Dispersora:</h3>
                                <input type="text" name="bancoSalida" id="bancoSalida" placeholder="Banco/Cuenta Dispersora" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <div class="izquierda">
                                <h3>Banco/Cuenta<br>Destino:</h3>
                                <input type="text" name="cuentaSalida" id="cuentaSalida" placeholder="Banco/Cuenta Destino" maxlength="50" onKeyUp="soloMayusculas(this.value,this.id)">
                            </div>
                            <br><br>
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
                                <td><strong>Eliminar</strong></td>
                            </tr>
                            <?php
                                tabla_mov_incompletos2($valor);
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
                            </tr>
                        </table>
            
                        <br><br>
            
                        <input type="hidden" name="accion" id="accion" value="modificar">
                        <input type="button" name="registrarButton" value="Registrar Movimiento"  onClick="validar('SeguimientoDirecto')">

                        <br><br><br>
                    </div>
                    <div>
                        <table id="myTableMuestraFinales" border="1">
                        <?php
                            tabla_mostrar_finales_directos($valor);
                        ?>
                        </table>
                    </div>
                </form>
            </div>
            <div id="pie">
                <p>&copy; 2015 by R-Net Systems. Sitio creado por Luis Eduardo Callejas.</p>
            </div>
        </div>

        <script type="text/javascript">
            function limites(){
                var combo1 = document.getElementById("origenSalida"); 
                var comboOrigen = combo1.options[combo1.selectedIndex].text;

                var combo2 = document.getElementById("listado"); 
                var comboDestino = combo2.options[combo2.selectedIndex].text;

                if(comboOrigen != "Seleccion" && comboDestino != "Seleccion"){
                    $.ajax({
                        url: '../php/obtenLimite.php',
                        type: 'POST',               
                        data: {origen: comboOrigen,
                                destino: comboDestino},
                    })

                    .done(function(respuesta) {
                        respuesta = respuesta.trim();
                        $('#limiteSalida').val(respuesta);
                    });
                }
            }
        </script>
        <!-- Librería jQuery requerida por los plugins de JavaScript -->
        <script src="../js/jquery.js"></script>
    </body>
</html>

<?php
    }else{
        header("Location: ../index.html");
    }
?> 