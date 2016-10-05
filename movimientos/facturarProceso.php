<?php
    session_start();
    if($_SESSION){
    
        require('../php/const.php');
        require('../php/conexion.php');
        require('../php/utiles.php');

        if(!isset($_SESSION['mesContador'])){
            $_SESSION['mesContador'] = 0;
            $_SESSION['anioContador'] = 0;
        }

        if (isset($_POST['meses'])){
            $_SESSION['mesContador'] = $_POST['meses'];
            $_SESSION['anioContador'] = $_POST['anio'];
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
    </head>
    <body>
    	<div id="principal">
    		<div id="cabecera">
        	    <?php require('../php/menu.php'); ?>
	    	</div>
	    	<div id="contenido">
                <form method="POST" name="formulario" id="formulario" enctype="multipart/form-data">
                    <br><br>
                    <select name="meses" id="meses">
                        <?php
                            for ($i=0; $i<=12; $i++) {
                                echo "<option value='$i'";
                                if($i == $_SESSION['mesContador']){
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
                                if($i == $_SESSION['anioContador']){
                                    echo "selected";
                                }
                                echo ">$i</option>";
                            }
                        ?> 
                    </select>
                    <input type="button" value="Aceptar"  onClick="visualizar('Contador')">
                    <h2>Procesos Directos:</h2>
                    <?php
                        echo "<table id='tabla_incompletos_directo' border=1>";
                            tabla_mov_incompletos_directos_facturar($_SESSION['mesContador'], $_SESSION['anioContador']);
                        echo"</table>";
                    ?>
                    <br><br>
                    <h2>Procesos Nominas:</h2>
                    <?php
                        echo "<table id='tabla_incompletos_nominas' border=1>";
                            tabla_mov_incompletos_nominas_facturar($_SESSION['mesContador'], $_SESSION['anioContador']);
                        echo"</table>";
                    ?>
                    <br><br>
                    <h2>Procesos Simples:</h2>
                    <?php
                        echo "<table id='tabla_incompletos_simples' border=1>";
                            tabla_mov_incompletos_simples_facturar($_SESSION['mesContador'], $_SESSION['anioContador']);
                        echo"</table>";
                    ?>
                    <br><br>
                    <input type="hidden" name="accion" id="accion" value="facturar">
                    <input type="button" value="Registrar Movimiento"  onClick="validar('FacturarProcesoContador')">
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