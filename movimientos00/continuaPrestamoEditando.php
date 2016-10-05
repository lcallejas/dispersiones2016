<?php
    session_start();
    if($_SESSION){

        require('../php/const.php');
        require('../php/conexion.php');
        require('../php/utiles.php');

        $valor = $_POST['valor'];

        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT fecha, hora, origen, empresa, monto, banco, cuenta, realizado FROM movimiento WHERE id = $valor";
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
        <script type="text/javascript" src="../js/agregarFilaTabla4.js"></script>
        <script type="text/javascript" src="../js/limites.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
    </head>
    <body onload="setTotalNominas();setTotal();desactivar();">
        <div id="principal">
            <div id="cabecera">
                <?php require('../php/menu.php'); ?>
            </div>
            <div id="contenido">
                <form method="POST" name="formulario" id="formulario">
                    <div id="entrada">
                        <div class="izquierda">
                            <?php
                                echo "<h1>Continuar Movimiento Prestamo: ";
                                    echo "<input type='hidden' name='valorId' id='valorId' value='".$valor."'>".$valor;
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
                                            echo "<input type='checkbox' onClick='checkRealizado();' id='check'>";
                                        }else{
                                            echo "<input type='checkbox' checked disabled>";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <div id="pie">
                <p>&copy; 2015 by R-Net Systems. Sitio creado por Luis Eduardo Callejas.</p>
            </div>
        </div>

        <script type="text/javascript">
            function checkRealizado(){
                document.getElementById("check").disabled = true;
                var id = document.getElementById("valorId").value;
                $.ajax({
                    url: '../php/realizaPrestamo.php',
                    type: 'POST',               
                    data: {id: id,
                            tabla: "movimiento"},
                })

                .done(function(respuesta) {
                    
                });
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