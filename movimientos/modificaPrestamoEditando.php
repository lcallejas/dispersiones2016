<?php
    session_start();
    if($_SESSION){
                    
        require('../php/const.php');
        require('../php/conexion.php');
        require('../php/utiles.php');

        $valor = $_POST['valor'];

        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT a.fecha, a.hora, a.origen, a.empresa, a.monto, a.banco, a.cuenta, a.realizado, b.realizado, b.pdf FROM movimiento a, movimientoprestamo b WHERE a.id = $valor AND b.idMov = $valor";
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
        <script type="text/javascript" src="../js/limites.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
    </head>
    <body>
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

                        <table id="myTable" name="myTable" border="1">
                            <tr>
                                <td><strong>Quien</strong></td>
                                <td><strong>A</strong></td>
                                <td><strong>Monto</strong></td>
                                <td><strong>Origen</strong></td>
                                <td><strong>Destino</strong></td>
                                <td><strong>Realizado</strong></td>
                                <td><strong>Comprobante</strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                        echo "<input type='text' name='quienSalida' id='quienSalida' onKeyUp='soloMayusculas(this.value,this.id)' placeholder='Quien deposita' value='".$row[2]."'>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo "<input type='text' name='quienEntrada' id='quienEntrada' onKeyUp='soloMayusculas(this.value,this.id)' placeholder='Quien deposita' value='".$row[3]."'>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo "<input type='text' name='montoEntrada' id='montoEntrada' onkeypress='return soloNumeros(event);' placeholder='Monto Entrada' value='".$row[4]."'>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo "<input type='text' name='bancoOrigen' id='bancoOrigen' onKeyUp='soloMayusculas(this.value,this.id)' placeholder='Banco/Cuenta Origen' maxlength='50' value='".$row[5]."'>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo "<input type='text' name='bancoDestino' id='bancoDestino' onKeyUp='soloMayusculas(this.value,this.id)' placeholder='Banco/Cuenta Destino' maxlength='50' value='".$row[6]."'>";
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                        if($row[7] == 0){
                                            echo "<input type='checkbox' id='check' name='check'>";
                                        }else{
                                            echo "<input type='checkbox' id='check' name='check' checked>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($row[8] == 0){
                                            echo "<input type='text' name='pdfControl' id='pdfControl' value='' hidden><input type='file' name='pdfPrestamo' id='pdfPrestamo'>";
                                        }else{
                                            echo "<input type='text' name='pdfControl' id='pdfControl' value='$row[9]' hidden><input type='file' name='pdfPrestamo' id='pdfPrestamo'><br><a target='_blank' href='$row[9]' title=''>Comprobante de Devolucion</a>";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
            
                        <br><br>
            
                        <input type="hidden" name="accion" id="accion" value="modificar">
                        <input type="button" name="registrarButton" value="Registrar Movimiento"  onClick="validar('ModificarPrestamoCompleto')">

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