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
        <script language="JavaScript" type="text/javascript">
            function validar(){
                var pdf = document.getElementById("pdfPrestamo").value;
                if(pdf == ""){
                    alert("Debes agregar un pdf antes de guardar el movimiento.");
                }else{
                    document.formulario.action = "../php/finalizaPrestamo.php";
                    document.formulario.submit();
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

                    $Consulta = "SELECT a.fecha, a.hora, a.origen, a.empresa, a.monto, a.banco, a.cuenta, a.realizado, a.pdf FROM movimientoprestamo a WHERE a.idMov = $valor";
                    $pConsulta = consulta_tb($mysqli, $Consulta);
                    $row = mysqli_fetch_array($pConsulta);
                ?>
                <form method="POST" name="formulario" id="formulario" enctype="multipart/form-data">
                    <div id="entrada">
                        <div class="izquierda">
                            <?php
                                echo "<h1>Continuar Movimiento Prestamo: ";
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

                        <table id="myTable" name="myTable" border="1">
                            <tr>
                                <td><strong>Quien</strong></td>
                                <td><strong>A</strong></td>
                                <td><strong>Monto</strong></td>
                                <td><strong>Origen</strong></td>
                                <td><strong>Destino</strong></td>
                                <td><strong>Realizado</strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                        echo "<label name='quienSalida' id='quienSalida' >";
                                            echo $row[2];
                                        echo"</label>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo "<label name='quienEntrada' id='quienEntrada' >";
                                            echo $row[3];
                                        echo"</label>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo "<label name='montoEntrada' id='montoEntrada' >";
                                            echo $row[4];
                                        echo"</label>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo "<label name='bancoOrigen' id='bancoOrigen' >";
                                            echo $row[5];
                                        echo"</label>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo "<label name='bancoDestino' id='bancoDestino' >";
                                            echo $row[6];
                                        echo"</label>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($row[7] == 0){
                                            echo "<input type='file' name='pdfPrestamo' id='pdfPrestamo'>";
                                        }else{
                                            echo "<a target='_blank' href='$row[8]' title=''>Comprobante de Devolucion</a>";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
            
                        <br><br>

                        <?php
                            if($row[7] == 0){
                        ?>
                            <input type="hidden" name="accion" id="accion" value="finalizar">
                            <input type="button" value="Registrar Movimiento"  onClick="validar()">
                        <?php
                            }else{
                        ?>
                            <input type="hidden" name="accion" id="accion" value="finalizar">
                        <?php
                            }
                        ?>
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