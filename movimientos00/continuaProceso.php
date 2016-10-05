<?php
    session_start();
    if($_SESSION){

        if(!isset($_SESSION['mesSeguimiento'])){
            $_SESSION['mesSeguimiento'] = 0;
            $_SESSION['anioSeguimiento'] = 0;
        }

        if (isset($_POST['meses'])){
            $_SESSION['mesSeguimiento'] = $_POST['meses'];
            $_SESSION['anioSeguimiento'] = $_POST['anio'];
        }

        $meses = array('Mes','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
?>

<html>
    <head>
        <title>Sistema de dispersiones</title>
        <!-- Etilos generales -->
		<link rel="stylesheet" type="text/css" href="../css/body_style.css" />
		<!-- Estilos menu -->
		<link rel="stylesheet" type="text/css" href="../css/menu.css" />
        <script type="text/javascript" src="../js/limites.js"></script>
        <script language="JavaScript" type="text/javascript">
            function validar(valor, tabla){
                if(tabla == 1){
                    var tipo = document.getElementById("tabla_incompletos_directos").rows[valor].cells[4].innerText;
                    var id = document.getElementById("tabla_incompletos_directos").rows[valor].cells[0].innerText;
                }else if(tabla == 2){
                    var tipo = document.getElementById("tabla_incompletos_nominas").rows[valor].cells[4].innerText;
                    var id = document.getElementById("tabla_incompletos_nominas").rows[valor].cells[0].innerText;
                }else if(tabla == 4){
                    var tipo = document.getElementById("tabla_incompletos_prestamos").rows[valor].cells[4].innerText;
                    var id = document.getElementById("tabla_incompletos_prestamos").rows[valor].cells[0].innerText;
                }else{
                    var tipo = document.getElementById("tabla_incompletos_simples").rows[valor].cells[4].innerText;
                    var id = document.getElementById("tabla_incompletos_simples").rows[valor].cells[0].innerText;
                }
                    document.getElementById('valor').value = id;
                if(tipo == "<-----NÓMINA----->"){
                    document.formulario.action = "../movimientos/continuaNominaEditando.php";
                    document.formulario.submit();
                }else if(tipo == "----->SÍMPLE<-----"){
                    document.formulario.action = "../movimientos/continuaSimpleEditando.php";
                    document.formulario.submit();
                }else if(tipo == "----->PRESTAMO<-----"){
                    document.formulario.action = "../movimientos/continuaPrestamoEditando.php";
                    document.formulario.submit();
                }else{
                    document.formulario.action = "../movimientos/continuaProcesoEditando.php";
                    document.formulario.submit();
                }
            }
            function validar2(valor, tabla){
                if(tabla == 1){
                    var tipo = document.getElementById("tabla_incompletos_directos").rows[valor].cells[4].innerText;
                    var id = document.getElementById("tabla_incompletos_directos").rows[valor].cells[0].innerText;
                }else if(tabla == 2){
                    var tipo = document.getElementById("tabla_incompletos_nominas").rows[valor].cells[4].innerText;
                    var id = document.getElementById("tabla_incompletos_nominas").rows[valor].cells[0].innerText;
                }else if(tabla == 4){
                    var tipo = document.getElementById("tabla_incompletos_prestamos").rows[valor].cells[4].innerText;
                    var id = document.getElementById("tabla_incompletos_prestamos").rows[valor].cells[0].innerText;
                }else{
                    var tipo = document.getElementById("tabla_incompletos_simples").rows[valor].cells[4].innerText;
                    var id = document.getElementById("tabla_incompletos_simples").rows[valor].cells[0].innerText;
                }
                document.getElementById('valor').value = id;
                if(tipo == "----->PRESTAMO<-----"){
                    document.formulario.action = "../movimientos/finalizaPrestamoEditando.php";
                    document.formulario.submit();
                }else{
                    if(!id){
                        alert('El monto de entrada es menor que el monto depositado.');
                    }else{
                        document.formulario.action = "../movimientos/finalizaProcesoEditando.php";
                        document.formulario.submit();
                    }
                }
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
                    <h1>Seguimiento</h1>
                    <select name="meses" id="meses">
                        <?php
                            for ($i=0; $i<=12; $i++) {
                                echo "<option value='$i'";
                                if($i == $_SESSION['mesSeguimiento']){
                                    echo "selected";
                                }
                                echo ">$meses[$i]</option>";
                            }
                        ?> 
                    </select>
                    <select name="anio" id="anio">
                        <option value="0">Año</option>
                        <?php
                            for ($i=2015; $i<=2050; $i++) {
                                echo "<option value='$i'";
                                if($i == $_SESSION['anioSeguimiento']){
                                    echo "selected";
                                }
                                echo ">$i</option>";
                            }
                        ?> 
                    </select>
                    <input type="button" value="Aceptar"  onClick="visualizar('Seguimiento')">
                    <h2>Movimientos Directos:</h2>
                    <?php
                        echo "<table id='tabla_incompletos_directos' border=1>";
                            tabla_mov_incompletos_directos($_SESSION['mesSeguimiento'], $_SESSION['anioSeguimiento']);
                        echo"</table>";
                    ?>
                    <br><br>
                    <h2>Movimientos de Nóminas:</h2>
                    <?php
                        echo "<table id='tabla_incompletos_nominas' border=1>";
                            tabla_mov_incompletos_nominas($_SESSION['mesSeguimiento'], $_SESSION['anioSeguimiento']);
                        echo"</table>";
                    ?>
                    <br><br>
                    <h2>Movimientos Simples:</h2>
                    <?php
                        echo "<table id='tabla_incompletos_simples' border=1>";
                            tabla_mov_incompletos_simples($_SESSION['mesSeguimiento'], $_SESSION['anioSeguimiento']);
                        echo"</table>";
                    ?>
                    <br><br>
                    <h2>Movimientos Prestamos:</h2>
                    <?php
                        echo "<table id='tabla_incompletos_prestamos' border=1>";
                            tabla_mov_incompletos_prestamos($_SESSION['mesSeguimiento'], $_SESSION['anioSeguimiento']);
                        echo"</table>";
                    ?>

                    <input type="hidden" name="valor" id="valor" value="">
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