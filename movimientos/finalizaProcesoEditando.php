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
        <!-- Scripts para el boton de agregar fila nueva en la tabla. -->
        <script type="text/javascript" src="../js/agregarFilaTabla2.js"></script>
        <script language="JavaScript" type="text/javascript">
            function validar(){
                if(document.getElementById("disperciones").value == 1){
                    var table=document.getElementById("myTableFin");
                    var rowCount=table.rows.length;
                    for(var i=0;i<rowCount;i++){
                        var row=table.rows[i];
                        var disabd=row.cells[5].childNodes[0];
                        if(null!=disabd&&true==disabd.disabled){
                            disabd.disabled = false;
                        }
                    }
                    document.formulario.action = "../php/datosProceso.php";
                    document.formulario.submit();
                }else{
                    alert('Existen dispersiones inconclusas para este movimiento.');
                }
            }
        </script>
    </head>
    <body onload="setTotal();">
        <div id="principal">
            <div id="cabecera">
                <?php require('../php/menu.php'); ?>
            </div>
            <div id="contenido">
                <?php
                    require('../php/const.php');
                    require('../php/conexion.php');
                    require('../php/utiles.php');

                    $valor = $_POST['valor'];

                    $mysqli = conectar_db();
                    selecciona_db($mysqli);

                    $Consulta = "SELECT a.fecha, a.hora, a.origen, a.monto, a.realizado FROM movimiento a WHERE a.id = $valor";
                    $pConsulta = consulta_tb($mysqli, $Consulta);
                    $row = mysqli_fetch_array($pConsulta);
                ?>
                <form method="POST" name="formulario" id="formulario" enctype="multipart/form-data">
                    <div id="entrada">
                        <div class="izquierda">
                            <?php
                                echo "<h1>Continuar Movimiento: ";
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
            
                        <table id="myTableFin" name="myTableFin" border="1">
                            <tr>
                                <td><strong>Empresa</strong></td>
                                <td><strong>Tipo</strong></td>
                                <td><strong>Monto</strong></td>
                                <td><strong>Banco</strong></td>
                                <td><strong>Cuenta</strong></td>
                                <td class='botnMov'><strong>PDF</strong></td>
                            </tr>
                            <?php
                                tabla_mov_incompletos3($valor);
                            ?>
                        </table>
            
                        <br><br>
            
                        <?php
                            disperciones_existentes($valor);
                        ?>
                        <input type="hidden" name="accion" id="accion" value="finalizar">
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