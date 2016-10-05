<?php
    session_start();
    if($_SESSION){
        if(isset($_SESSION['clienteSESSION'])){
            $cliente = $_SESSION['clienteSESSION'];
            $nombre = $_SESSION['nombreSESSION'];
            $clienteText = $_SESSION['clienteSESSIONText'];
            $nombreText = $_SESSION['nombreSESSIONText'];
        }else{
            $cliente = "";
            $nombre = "";
            $clienteText = "";
            $nombreText = "";
        }
?>

<html>
    <head>
        <title>Sistema de dispersiones</title>
        <!-- Etilos generales -->
        <link rel="stylesheet" type="text/css" href="../css/body_style.css" />
        <!-- Estilos menu -->
        <link rel="stylesheet" type="text/css" href="../css/menu.css" />
        <script type="text/javascript" src="../js/limites.js"></script>
        <script type="text/javascript" src="../js/ajaxNominas.js"></script>
        <!-- <script type="text/javascript" src="../js/ajaxNominas.js"></script> -->
        <script language="JavaScript" type="text/javascript">
            function verificaCliente(){
                var cliente = document.getElementById("nuevoCliente").value;
                if(cliente == ""){
                    alert("Agrega un cliente válido.");
                }else{
                    agregarNuevoCliente(cliente);
                    document.getElementById("nuevoCliente").value = "";
                }
                document.formulario.action = "../php/altaPDFNominas.php";
                document.formulario.submit();
            }

            function verificaNombre(){
                var cliente = document.getElementById("listadoClientes1").value;
                var nombre = document.getElementById("nuevoNombre").value;
                if(cliente == "Seleccion"){
                    alert("Selecciona un cliente válido.");
                }else if(nombre == ""){
                    alert("Agrega un nombre válido.");
                }else{
                    agregarNuevoNombre(cliente, nombre);
                    document.getElementById("listadoClientes1").value = "Seleccion";
                    document.getElementById("nuevoNombre").value = "";
                }
                document.formulario.action = "../php/altaPDFNominas.php";
                document.formulario.submit();
            }

            function verificaListado(){
                var cliente = document.getElementById("listadoClientes2").value;
                var nombre = document.getElementById("listadoNombres1").value;
                var combo1 = document.getElementById("listadoClientes2");
                var clienteText = combo1.options[combo1.selectedIndex].text;
                var combo2 = document.getElementById("listadoNombres1");
                var nombreText = combo2.options[combo2.selectedIndex].text;
                document.getElementById("clienteTextHidden").value = cliente;
                document.getElementById("nombreTextHidden").value = nombre;
                document.getElementById("clienteText").value = clienteText;
                document.getElementById("nombreText").value = nombreText;
                if(cliente == "Seleccion"){
                    alert("Selecciona un cliente válido.");
                }else if(nombre == "Seleccion"){
                    alert("Selecciona un nombre válido.");
                }else{
                    visualizarPDFs(cliente, nombre);
                }
            }

            function verificaSelect(){
                var cliente = document.getElementById("listadoClientes2").value;
                visualizarSelect(cliente);
            }

            function verificaFile(){
                if(!document.getElementById("clienteHidden")){
                    alert("No haz visualizado ni una tabla.");
                }else if(document.getElementById("nombreArchivo") == ""){
                    alert("El archivo no tiene nombre");
                }else{
                    archivo = document.getElementById("nuevoPDF").value;
                    if(archivo == ""){
                        alert("No haz seleccionado ni un archivo.");
                    }else{
                        var cliente = document.getElementById("clienteHidden");
                        var nombre = document.getElementById("nombreHidden");
                        agregarNuevoPDF(cliente, nombre);
                    }
                }
            }

            function verificaEliminaPDF(valorId, direccionPDF){
                var cliente = document.getElementById("clienteTextHidden").value;
                var nombre = document.getElementById("nombreTextHidden").value;
                if(cliente == "Seleccion"){
                    alert("Selecciona un cliente válido.");
                }else if(nombre == "Seleccion"){
                    alert("Selecciona un nombre válido.");
                }else{
                    eliminaPDF(valorId, direccionPDF, cliente, nombre);
                }
            }

            function cargaContenido(){
                var cliente = document.getElementById("clienteTextHidden").value;
                var nombre = document.getElementById("nombreTextHidden").value;
                if(cliente == "Seleccion"){
                    alert("Selecciona un cliente válido.");
                }else if(nombre == "Seleccion"){
                    alert("Selecciona un nombre válido.");
                }else{
                    visualizarPDFs(cliente, nombre);
                }
            }
        </script>
    </head>
    <body onLoad="cargaContenido()">
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
                <form method="POST" name="formulario" id="formulario" enctype="multipart/form-data">
                    <h1>Nóminas PDF</h1>
                    <input type="text" name="nuevoCliente" id="nuevoCliente" placeholder="Nuevo Cliente">
                    <input type="submit" value="Agregar" onClick="verificaCliente()">
                    <br>
                        <hr>
                    <br>

                    <?php
                        echo "<select name='listadoClientes1' id='listadoClientes1' >";
                            listado("id","cliente","clientesNominas");
                        echo"</select>";
                    ?>
                    <input type="text" name="nuevoNombre" id="nuevoNombre" placeholder="Nuevo Nombre">
                    <input type="button" value="Agregar" onClick="verificaNombre()">
                    <br>
                        <hr>
                    <br>

                    <?php 
                        echo "<select name='listadoClientes2' id='listadoClientes2' onChange='verificaSelect()'>";
                            listado("id","cliente","clientesNominas");
                        echo"</select>"; 
                    ?>
                    <?php
                        echo "<select name='listadoNombres1' id='listadoNombres1' ><option value='0'> Seleccion</option>";

                        echo"</select>";
                    ?>
                    <input type="button" value="Desplegar listado" onClick="verificaListado()">
                    <br>
                        <hr>
                    <br>
                    <?php echo "<input type='hidden' id='clienteTextHidden' name='clienteTextHidden' value='".$cliente."' placeholder='Cliente'>"; ?>
                    <?php echo "<input type='hidden' id='nombreTextHidden' name='nombreTextHidden' value='".$nombre."' placeholder='Nombre'>"; ?>
                    <?php echo "<input type='text' id='clienteText' name='clienteText' value='".$clienteText."' placeholder='Cliente' disabled>"; ?>
                    <?php echo "<input type='text' id='nombreText' name='nombreText' value='".$nombreText."' placeholder='Nombre' disabled>"; ?>
                    <input type="text" name="nombreArchivo" id="nombreArchivo" placeholder="Nombre de archivo">
                    <input type="file" name="nuevoPDF" id="nuevoPDF">
                    <input type="button" value="Agregar" onClick="verificaFile()">
                    <br>
                        <hr>
                    <br>

                    <div id="resultado"></div>
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