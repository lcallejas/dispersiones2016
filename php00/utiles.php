<?php
    // registros en tablas de la bd
    function alta($tabla, $datos, $columna) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "INSERT INTO $tabla VALUES (";
        for ($i = 0; $i < count($datos); $i++) {
            $Consulta = $Consulta.$datos[$i];
            if ($i != count($datos) - 1)
                $Consulta.=",";
        }
        $Consulta.=")";
        echo $Consulta;
        $pConsulta = consulta_tb($mysqli, $Consulta);
        if (!$pConsulta) {
            echo"<script>alert ('No se completo el registro.');</script>";
        }
        cerrar_db($mysqli);
    }

    // registros en tablas de la bd
    function actualiza($tabla, $datos, $columna, $id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "UPDATE $tabla SET ";
        for ($i = 0; $i < count($datos); $i++) {
            $Consulta = $Consulta.$columna[$i].'='.$datos[$i];
            if ($i != count($datos) - 1)
                $Consulta.=",";
        }
        $Consulta.=" WHERE id=".$id;
        echo $Consulta;
        $pConsulta = consulta_tb($mysqli, $Consulta);
        if (!$pConsulta) {
            echo"<script>alert ('No se completo el registro.');</script>";
        }else{
            echo"<script>alert ('Se completo el registro.');</script>";
        }
        cerrar_db($mysqli);
    }

    // registros en tablas de la bd
    function factura($tabla, $datos, $columna) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        $Consulta = "UPDATE $tabla SET $columna=$datos[5] WHERE id=$datos[0] AND empresaPara=$datos[3] AND monto=$datos[4] LIMIT 1";
        echo $Consulta;
        $pConsulta = consulta_tb($mysqli, $Consulta);
        if (!$pConsulta) {
            echo"<script>alert ('No se completo el registro.');</script>";
        }else{
            echo"<script>alert ('Se completo el registro.');</script>";
        }
        cerrar_db($mysqli);
    }

    // registros en tablas de la bd
    function elimina($tabla, $columna, $id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "DELETE FROM $tabla WHERE $columna=$id";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        if (!$pConsulta) {
            echo"<script>alert ('No se completo el registro.');</script>";
        }else{
            echo"<script>alert ('Se completo el registro.');</script>";
        }
        cerrar_db($mysqli);
    }

    // extrae id a partir del nombre.
    function consulta_detalle($tabla, $nombre) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT id FROM $tabla WHERE nombre = '$nombre'";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        if (!$pConsulta) {
            return 0;
        }else{
            $row=mysqli_fetch_array($pConsulta);
            return $row[0];
        }
        cerrar_db($mysqli);
    }

    // extrae id a partir del nombre.
    function extrtae_id($tabla, $nombre) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT id FROM $tabla WHERE nombre = '$nombre'";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        if (!$pConsulta) {
            return 0;
        }else{
            $row=mysqli_fetch_array($pConsulta);
            return $row[0];
        }
        cerrar_db($mysqli);
    }

    //extrae el id del movimiento en curso.
    function extrae_ultimo_id($tabla){
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT id FROM $tabla ORDER BY id DESC LIMIT 1";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        if (!$pConsulta) {
            return 0;
        }else{
            $row=mysqli_fetch_array($pConsulta);
            return $row[0];
        }
        cerrar_db($mysqli);
    }

    //lista desplegable de los datos de la bd
    function listado($pk, $nombre, $tabla) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        if($tabla == 'usuarios'){
            $Consulta = "SELECT $pk, $nombre FROM $tabla WHERE activo = 1 AND root = 0 ORDER BY $nombre ASC";
        }else{
            $Consulta = "SELECT $pk, $nombre FROM $tabla WHERE activo = 1 ORDER BY $nombre ASC";
        }

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            echo "<option>",'Seleccion',"</option>";
            while($row=mysqli_fetch_array($pConsulta)){
                echo "<option value='$row[0]'>", $row[1],"</option>";
            }
        }
        cerrar_db($mysqli);
    }

    //lista desplegable de los datos de la bd
    function listado_seleccionado($pk, $nombre, $tabla, $seleccion) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        if($tabla == 'usuarios'){
            $Consulta = "SELECT $pk, $nombre FROM $tabla WHERE activo = 1 AND root = 0 ORDER BY $nombre ASC";
        }else{
            $Consulta = "SELECT $pk, $nombre FROM $tabla WHERE activo = 1 ORDER BY $nombre ASC";
        }

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            echo "<option>",'Seleccion',"</option>";
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[0] == $seleccion){
                    echo "<option value='$row[0]' selected>", $row[1],"</option>";    
                }else{
                    echo "<option value='$row[0]'>", $row[1],"</option>";
                }
            }
        }
        cerrar_db($mysqli);
    }

    //lista desplegable de los datos de la bd
    function listado_seleccionado_actualizado($pk, $nombre, $tabla, $seleccion, $cliente) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        if($tabla == 'usuarios'){
            $Consulta = "SELECT $pk, $nombre FROM $tabla WHERE activo = 1 AND root = 0 ORDER BY $nombre ASC";
        }else{
            $Consulta = "SELECT $pk, $nombre FROM $tabla WHERE activo = 1 AND cliente = $cliente ORDER BY $nombre ASC";
        }

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            echo "<option>",'Seleccion',"</option>";
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[0] == $seleccion){
                    echo "<option value='$row[0]' selected>", $row[1],"</option>";    
                }else{
                    echo "<option value='$row[0]'>", $row[1],"</option>";
                }
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_directos($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto FROM movimiento a, empresas b, movimientoFinal c WHERE a.activo = 1 AND a.empresa = b.id AND c.idMov = a.id AND c.realizado = 0 AND a.tipo = 1 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            $i = 1;
            echo "<tr><td id='noMov'><b>",'No.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td class='horaMov'><b>",'Hora',"</b></td>
            <td id='empOrig'><b>",'Origen',"</b></td>
            <td id='empMov'><b>",'Empresa',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='botnMov'><b>",'Detalles',"</b></td>
            <td class='botnMov'><b>",'Final',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                echo "<tr><td>", $row[0],"</td>
                    <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                    <td class='horaMov'>", $row[2],"</td>
                    <td>", $row[3],"</td>
                    <td><label><--->DIRECTO<---></label></td>
                    <td class='montMov'>", $row[5],"</td>
                    <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$i,", 1)'></td>
                    <td class='botnMov'><input type='button' value='Finalizar' onClick='validar2(",$i,", 1)'></td></tr>";
                    $i++;
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_nominas($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);


        //$Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a, movimientoNominas b WHERE a.activo = 1 AND b.idMov = a.id AND (b.realizado = 0 || a.realizado = 0 || (SELECT c.realizado FROM disperciones c WHERE c.realizado = 0 AND c.idMov = a.id LIMIT 1) = 0) AND a.tipo = 2 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a, movimientoNominas b WHERE a.activo = 1 AND b.idMov = a.id AND a.tipo = 2 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            $i = 1;
            echo "<tr><td id='noMov'><b>",'No.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td class='horaMov'><b>",'Hora',"</b></td>
            <td id='empOrig'><b>",'Origen',"</b></td>
            <td id='empMov'><b>",'Empresa',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='botnMov'><b>",'Detalles',"</b></td>
            <td class='botnMov'><b>",'Final',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                $Consulta2 = "SELECT * FROM disperciones WHERE idMov = $row[0]";
                $pConsulta2 = consulta_tb($mysqli, $Consulta2);
                $row4=mysqli_fetch_array($pConsulta2);
                if(!$row4){
                    if($row[6] == 2){
                        $row[4] = "<-----NÓMINA----->";
                    }else if($row[6] == 3){
                        $row[4] = "----->SÍMPLE<-----";
                    }
                    echo "<tr><td>", $row[0],"</td>
                        <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                        <td class='horaMov'>", $row[2],"</td>
                        <td>", $row[3],"</td>
                        <td>", $row[4],"</td>
                        <td class='montMov'>", $row[5],"</td>
                        <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$i,", 2)'></td>
                        <td class='botnMov'><input type='button' value='Finalizar' onClick='validar2(",$i,", 2)'></td></tr>";
                        $i++;
                }else{
                    $Consulta3 = "SELECT a.realizado, b.realizado FROM disperciones a, movimiento b WHERE a.idMov = $row[0] AND b.id = $row[0] AND (a.realizado = 0 || b.realizado = 0) LIMIT 1";
                    $pConsulta3 = consulta_tb($mysqli, $Consulta3);
		    if(!$pConsulta3){
		    
		    }else{
                        while($row2=mysqli_fetch_array($pConsulta3)){
                            if($row2[0] == 0 || $row2[1] == 0){
                                if($row[6] == 2){
                                    $row[4] = "<-----NÓMINA----->";
                                }else if($row[6] == 3){
                                    $row[4] = "----->SÍMPLE<-----";
                                }
                                echo "<tr><td>", $row[0],"</td>
                                    <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                                    <td class='horaMov'>", $row[2],"</td>
                                    <td>", $row[3],"</td>
                                    <td>", $row[4],"</td>
                                    <td class='montMov'>", $row[5],"</td>
                                    <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$i,", 2)'></td>
                                    <td class='botnMov'><input type='button' value='Finalizar' onClick='validar2(",$i,", 2)'></td></tr>";
                                    $i++;
                            }
			}
		    }
                }
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_simples($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a WHERE a.activo = 1 AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        
        //$Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a, movimientoFinal c, movimientoSimple d WHERE a.activo = 1 AND ((c.idMov = a.id AND c.realizado = 0) OR (d.idMov = a.id AND d.realizado = 0)) AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        //$row=mysqli_fetch_array($pConsulta);
        //if(!$row){
            //$Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a, movimientoFinal c WHERE a.activo = 1 AND c.idMov = a.id AND c.realizado = 0 AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
            //$pConsulta = consulta_tb($mysqli, $Consulta);
            //$row=mysqli_fetch_array($pConsulta);
            //if(!$row){
                //$Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a, movimientoSimple d WHERE a.activo = 1 AND d.idMov = a.id AND d.realizado = 0 AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
                //$pConsulta = consulta_tb($mysqli, $Consulta);
                //$row=mysqli_fetch_array($pConsulta);
            //}
        //}

            $control = 1;
            echo "<tr><td id='noMov'><b>",'No.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td class='horaMov'><b>",'Hora',"</b></td>
            <td id='empOrig'><b>",'Origen',"</b></td>
            <td id='empMov'><b>",'Empresa',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='botnMov'><b>",'Detalles',"</b></td>
            <td class='botnMov'><b>",'Final',"</b></td></tr>";
            $Consulta = $Consulta;
            $pConsulta = consulta_tb($mysqli, $Consulta);
            while($row=mysqli_fetch_array($pConsulta)){
                $Consulta2 = "SELECT realizado FROM disperciones WHERE idMov = $row[0]";
                $pConsulta2 = consulta_tb($mysqli, $Consulta2);
                if(mysqli_num_rows($pConsulta2)<1){
                    if($row[6] == 2){
                        $row[4] = "<-----NÓMINA----->";
                    }else if($row[6] == 3){
                        $row[4] = "----->SÍMPLE<-----";
                    }
                    echo "<tr><td>", $row[0],"</td>
                        <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                        <td class='horaMov'>", $row[2],"</td>
                        <td>", $row[3],"</td>
                        <td>", $row[4],"</td>
                        <td class='montMov'>", $row[5],"</td>
                        <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$control,", 3)'></td>
                        <td class='botnMov'><input type='button' value='Finalizar' onClick='validar2(",$control,", 3)'></td></tr>";
                        $control++;
                }else{
                    $Consulta2 = "SELECT realizado FROM disperciones WHERE idMov = $row[0] AND realizado = 0 LIMIT 1";
                    $pConsulta2 = consulta_tb($mysqli, $Consulta2);
                    $Consulta3 = "SELECT realizado FROM movimientoFinal WHERE idMov = $row[0] AND realizado = 0 LIMIT 1";
                    $pConsulta3 = consulta_tb($mysqli, $Consulta3);
                    if(mysqli_num_rows($pConsulta2)>0 || mysqli_num_rows($pConsulta3)>0){
                            if($row[6] == 2){
                                $row[4] = "<-----NÓMINA----->";
                            }else if($row[6] == 3){
                                $row[4] = "----->SÍMPLE<-----";
                            }
                            echo "<tr><td>", $row[0],"</td>
                                <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                                <td class='horaMov'>", $row[2],"</td>
                                <td>", $row[3],"</td>
                                <td>", $row[4],"</td>
                                <td class='montMov'>", $row[5],"</td>
                                <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$control,", 3)'></td>
                                <td class='botnMov'><input type='button' value='Finalizar' onClick='validar2(",$control,", 3)'></td></tr>";
                                $control++;
                    }
                }
                
            }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_prestamos($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a WHERE a.activo = 1 AND a.tipo = 4 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        
        //$Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a, movimientoFinal c, movimientoSimple d WHERE a.activo = 1 AND ((c.idMov = a.id AND c.realizado = 0) OR (d.idMov = a.id AND d.realizado = 0)) AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        //$row=mysqli_fetch_array($pConsulta);
        //if(!$row){
            //$Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a, movimientoFinal c WHERE a.activo = 1 AND c.idMov = a.id AND c.realizado = 0 AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
            //$pConsulta = consulta_tb($mysqli, $Consulta);
            //$row=mysqli_fetch_array($pConsulta);
            //if(!$row){
                //$Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.origen, a.monto, a.tipo FROM movimiento a, movimientoSimple d WHERE a.activo = 1 AND d.idMov = a.id AND d.realizado = 0 AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
                //$pConsulta = consulta_tb($mysqli, $Consulta);
                //$row=mysqli_fetch_array($pConsulta);
            //}
        //}

            $control = 1;
            echo "<tr><td id='noMov'><b>",'No.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td class='horaMov'><b>",'Hora',"</b></td>
            <td id='empOrig'><b>",'Origen',"</b></td>
            <td id='empMov'><b>",'Empresa',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='botnMov'><b>",'Detalles',"</b></td>
            <td class='botnMov'><b>",'Final',"</b></td></tr>";
            $Consulta = $Consulta;
            $pConsulta = consulta_tb($mysqli, $Consulta);
            while($row=mysqli_fetch_array($pConsulta)){
                $Consulta2 = "SELECT realizado FROM movimiento WHERE id = $row[0] AND realizado = 0 LIMIT 1";
                $pConsulta2 = consulta_tb($mysqli, $Consulta2);
                $Consulta3 = "SELECT realizado FROM movimientoprestamo WHERE idMov = $row[0] AND realizado = 0 LIMIT 1";
                $pConsulta3 = consulta_tb($mysqli, $Consulta3);
                if(mysqli_num_rows($pConsulta2)>0 || mysqli_num_rows($pConsulta3)>0){
                        if($row[6] == 2){
                            $row[4] = "<-----NÓMINA----->";
                        }else if($row[6] == 3){
                            $row[4] = "----->SÍMPLE<-----";
                        }else if($row[6] == 4){
                            $row[4] = "----->PRESTAMO<-----";
                        }
                        echo "<tr><td>", $row[0],"</td>
                            <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                            <td class='horaMov'>", $row[2],"</td>
                            <td>", $row[3],"</td>
                            <td>", $row[4],"</td>
                            <td class='montMov'>", $row[5],"</td>
                            <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$control,", 4)'></td>
                            <td class='botnMov'><input type='button' value='Finalizar' onClick='validar2(",$control,", 4)'></td></tr>";
                            $control++;
                }
            }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_directos_modificar($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto FROM movimiento a, empresas b, movimientoFinal c WHERE a.activo = 1 AND a.empresa = b.id AND a.tipo = 1 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            $i = 1;
            echo "<tr><td id='noMov'><b>",'No.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td class='horaMov'><b>",'Hora',"</b></td>
            <td id='empOrig'><b>",'Origen',"</b></td>
            <td id='empMov'><b>",'Empresa',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='botnMov'><b>",'Detalles',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                echo "<tr><td>", $row[0],"</td>
                    <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                    <td class='horaMov'>", $row[2],"</td>
                    <td>", $row[3],"</td>
                    <td><label><--->DIRECTO<---></label></td>
                    <td class='montMov'>", $row[5],"</td>
                    <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$i,", 1)'></td></tr>";
                    $i++;
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_nominas_modificar($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto, a.tipo FROM movimiento a, empresas b, movimientoNominas d WHERE a.activo = 1 AND a.empresa = b.id AND a.tipo = 2 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            $i = 1;
            echo "<tr><td id='noMov'><b>",'No.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td class='horaMov'><b>",'Hora',"</b></td>
            <td id='empOrig'><b>",'Origen',"</b></td>
            <td id='empMov'><b>",'Empresa',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='botnMov'><b>",'Detalles',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[6] == 2){
                    $row[4] = "<-----NÓMINA----->";
                }else if($row[6] == 3){
                    $row[4] = "----->SÍMPLE<-----";
                }
                echo "<tr><td>", $row[0],"</td>
                    <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                    <td class='horaMov'>", $row[2],"</td>
                    <td>", $row[3],"</td>
                    <td>", $row[4],"</td>
                    <td class='montMov'>", $row[5],"</td>
                    <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$i,", 2)'></td></tr>";
                    $i++;
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_simples_modificar($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        //$Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto, a.tipo FROM movimiento a, empresas b WHERE a.activo = 1 AND a.empresa = b.id AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto, a.tipo FROM movimiento a, empresas b WHERE a.activo = 1 AND a.empresa = b.id AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        /*$row=mysqli_fetch_array($pConsulta);
        if(count($row) < 1){
            $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto, a.tipo FROM movimiento a, empresas b, movimientoFinal c WHERE a.activo = 1 AND a.empresa = b.id AND c.idMov = a.id AND c.realizado = 0 AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
            $pConsulta = consulta_tb($mysqli, $Consulta);
            $row=mysqli_fetch_array($pConsulta);
            if(count($row) < 1){
                $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto, a.tipo FROM movimiento a, empresas b, movimientoSimple d WHERE a.activo = 1 AND a.empresa = b.id AND d.idMov = a.id AND d.realizado = 0 AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
                $pConsulta = consulta_tb($mysqli, $Consulta);
            }
        }*/

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            $i = 1;
            echo "<tr><td id='noMov'><b>",'No.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td class='horaMov'><b>",'Hora',"</b></td>
            <td id='empOrig'><b>",'Origen',"</b></td>
            <td id='empMov'><b>",'Empresa',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='botnMov'><b>",'Detalles',"</b></td>
            <td class='botnMov'><b>",'Final',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[6] == 2){
                    $row[4] = "<-----NÓMINA----->";
                }else if($row[6] == 3){
                    $row[4] = "----->SÍMPLE<-----";
                }
                echo "<tr><td>", $row[0],"</td>
                    <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                    <td class='horaMov'>", $row[2],"</td>
                    <td>", $row[3],"</td>
                    <td>", $row[4],"</td>
                    <td class='montMov'>", $row[5],"</td>
                    <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$i,", 3)'></td>
                    <td class='botnMov'><input type='button' value='Finalizar' onClick='validar2(",$i,", 3)'></td></tr>";
                    $i++;
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_prestamos_modificar($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        //$Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto, a.tipo FROM movimiento a, empresas b WHERE a.activo = 1 AND a.empresa = b.id AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, a.monto, a.tipo FROM movimiento a WHERE a.activo = 1 AND a.tipo = 4 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        /*$row=mysqli_fetch_array($pConsulta);
        if(count($row) < 1){
            $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto, a.tipo FROM movimiento a, empresas b, movimientoFinal c WHERE a.activo = 1 AND a.empresa = b.id AND c.idMov = a.id AND c.realizado = 0 AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
            $pConsulta = consulta_tb($mysqli, $Consulta);
            $row=mysqli_fetch_array($pConsulta);
            if(count($row) < 1){
                $Consulta = "SELECT a.id, a.fecha, a.hora, a.origen, b.nombre, a.monto, a.tipo FROM movimiento a, empresas b, movimientoSimple d WHERE a.activo = 1 AND a.empresa = b.id AND d.idMov = a.id AND d.realizado = 0 AND a.tipo = 3 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' GROUP BY a.id ORDER BY a.fecha, a.hora ASC";
                $pConsulta = consulta_tb($mysqli, $Consulta);
            }
        }*/

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            $i = 1;
            echo "<tr><td id='noMov'><b>",'No.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td class='horaMov'><b>",'Hora',"</b></td>
            <td id='empOrig'><b>",'Origen',"</b></td>
            <td id='empMov'><b>",'Empresa',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='botnMov'><b>",'Detalles',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[5] == 2){
                    $row[5] = "<-----NÓMINA----->";
                }else if($row[5] == 3){
                    $row[5] = "----->SÍMPLE<-----";
                }else if($row[5] == 4){
                    $row[5] = "----->PRESTAMO<-----";
                }
                echo "<tr><td>", $row[0],"</td>
                    <td class='fechaMov'>", date_format(date_create($row[1]), 'd / m / Y'),"</td>
                    <td class='horaMov'>", $row[2],"</td>
                    <td>", $row[3],"</td>
                    <td>", $row[5],"</td>
                    <td class='montMov'>", $row[4],"</td>
                    <td class='botnMov'><input type='button' value='Detalles' onClick='validar(",$i,", 4)'></td></tr>";
                    $i++;
            }
        }
        cerrar_db($mysqli);
    }


    //tabla de movimientos incompletos2
    function tabla_mov_incompletos2($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT (SELECT b.nombre FROM empresas b WHERE b.id = a.origen), b.dispersor, b.nombre, a.monto, a.banco, a.cuenta, a.cuentaFinal, a.realizado FROM disperciones a, empresas b, movimiento c WHERE a.idMov = $id AND b.id = a.empresa AND c.id = a.idMov AND c.activo = 1 ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[6]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                }else{
                    $checked = "";
                    $valorChecked = 0;
                }
                if($row[7]==1){
                    $checked2 = "checked='checked'";
                    $valorChecked2 = 1;
                    $desactivado = "disabled";
                }else{
                    $checked2 = "";
                    $valorChecked2 = 0;
                    $desactivado = "";
                }
                echo "<tr>
                    <td><input type='hidden' name='origenDest[]' value='", $row[0] ,"'><label>", $row[0] ,"</label></td>
                    <td><input type='hidden' name='dispersora[]' value='", $row[1] ,"'><input type='hidden' name='empresaDest[]' value='", $row[2] ,"'><label>", $row[2] ,"</label></td>
                    <td><input type='hidden' name='montoDest[]' value='", $row[3] ,"'><label>", $row[3] ,"</label></td>
                    <td><input type='hidden' name='bancoDest[]' value='", $row[4] ,"'><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='cuentaDest[]' value='", $row[5] ,"'><label>", $row[5] ,"</label></td>
                    <td><input type='hidden' name='cuentaFinalDest[]' value='", $valorChecked ,"'><input type='checkbox' onclick='cambiarValorCheck();' ", $checked ," disabled></td>
                    <td><input type='hidden' name='realizadoDest[]' value='", $valorChecked2 ,"'><input type='checkbox' name='checkRealizado[]' onclick='cambiarValorCheck();'  ", $checked2 ," ", $desactivado ,"></td>
                    <td><input type='checkbox' disabled></td>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos3($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT id, empresa, tipoTrans, monto, banco, cuenta, pdf FROM movimientoFinal WHERE idMov = $id ORDER BY id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[2] == 0){
                    $row[2] = "Transferencia";
                }else if($row[2] == 1){
                    $row[2] = "Efectivo";
                }else if($row[2] == 2){
                    $row[2] = "Nómina";
                }
                echo "<tr>
                    <td><input type='hidden' name='idFinal[]' value='", $row[0] ,"'><label>", $row[1] ,"</label></td>
                    <td><input type='hidden' name='tipoFinal[]' value='", $row[2] ,"'><label>", $row[2] ,"</label></td>
                    <td><label>", $row[3] ,"</label></td>
                    <td><label>", $row[4] ,"</label></td>
                    <td><label>", $row[5] ,"</label></td>";
                    if($row[6] == ""){
                        echo "<td class='botnMov'><input type='file' name='pdf[]'></td></tr>";
                    }else{
                        echo "<td class='botnMov'><input type='file' name='pdf[]' disabled><a target=\"_blank\" href=\"$row[6]\" title=\"\">Comprobante</a></td></tr>";
                    }
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos4($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, b.nombre, a.monto, a.banco, a.cuenta, a.realizado, a.comentario FROM movimientoNominas a, empresas b WHERE a.idMov = $id AND b.id = a.empresa ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[5]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                    $desactivado = "disabled";
                }else{
                    $checked = "";
                    $valorChecked = 0;
                    $desactivado = "";
                }
                echo "<tr>
                    <td><input type='hidden' name='idEnt[]' value='", $row[0] ,"'><label>", $row[1] ,"</label></td>
                    <td><label>", $row[2] ,"</label></td>
                    <td><label>", $row[3] ,"</label></td>
                    <td><label>", $row[4] ,"</label></td>
                    <td><label>", $row[6] ,"</label></td>
                    <td><input type='hidden' name='realizadoEnt[]' value='", $valorChecked ,"'><input type='checkbox' onclick='cambiarValorCheck2(); enviarRealizadoActualizado($row[0], \"movimientoNominas\"); disabled=true' ", $checked ," ", $desactivado ,"></td>
                    </tr>";
            }
        }
        cerrar_db($mysqli);
    }



    //tabla de movimientos incompletos2
    function tabla_mov_incompletos_nomina_modific($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.empresa, b.nombre, a.monto, a.banco, a.cuenta, a.realizado, a.comentario FROM movimientoNominas a, empresas b WHERE a.idMov = $id AND b.id = a.empresa ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[6]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                }else{
                    $checked = "";
                    $valorChecked = 0;
                }
                echo "<tr>
                    <td><input type='hidden' name='idEnt[]' value='", $row[0] ,"'><input type='hidden' name='idEmp[]' value='", $row[1] ,"'<label>", $row[2] ,"</label></td>
                    <td><input type='hidden' name='montoEnt[]' value='", $row[3] ,"'><label>", $row[3] ,"</label></td>
                    <td><input type='hidden' name='bancoEnt[]' value='", $row[4] ,"'><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='cuentaEnt[]' value='", $row[5] ,"'><label>", $row[5] ,"</label></td>
                    <td><input type='hidden' name='comentarioEnt[]' value='", $row[7] ,"'><label>", $row[7] ,"</label></td>
                    <td><input type='hidden' name='realizadoEnt[]' value='", $valorChecked ,"'><input type='checkbox' onclick='cambiarValorCheck2();' ", $checked ,"></td>
                    <td><input type='checkbox'</td>
                    </tr>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos_directo_modific($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.empresa, b.nombre, a.monto, a.banco, a.cuenta, a.realizado FROM movimientoDirecto a, empresas b WHERE a.idMov = $id AND b.id = a.empresa ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[6]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                }else{
                    $checked = "";
                    $valorChecked = 0;
                }
                echo "<tr>
                    <td><input type='hidden' name='idEnt[]' value='", $row[0] ,"'><input type='hidden' name='idEmp[]' value='", $row[1] ,"'<label>", $row[2] ,"</label></td>
                    <td><input type='hidden' name='montoEnt[]' value='", $row[3] ,"'><label>", $row[3] ,"</label></td>
                    <td><input type='hidden' name='bancoEnt[]' value='", $row[4] ,"'><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='cuentaEnt[]' value='", $row[5] ,"'><label>", $row[5] ,"</label></td>
                    <td><input type='hidden' name='realizadoEnt[]' value='", $valorChecked ,"'><input type='checkbox' onclick='cambiarValorCheck2();' ", $checked ,"></td>
                    <td><input type='checkbox'</td>
                    </tr>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos_simple_modific($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.empresa, b.nombre, a.monto, a.banco, a.cuenta, a.realizado FROM movimientoSimple a, empresas b WHERE a.idMov = $id AND b.id = a.empresa ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[6]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                }else{
                    $checked = "";
                    $valorChecked = 0;
                }
                echo "<tr>
                    <td><input type='hidden' name='idEnt[]' value='", $row[0] ,"'><input type='hidden' name='idEmp[]' value='", $row[1] ,"'<label>", $row[2] ,"</label></td>
                    <td><input type='hidden' name='montoEnt[]' value='", $row[3] ,"'><label>", $row[3] ,"</label></td>
                    <td><input type='hidden' name='bancoEnt[]' value='", $row[4] ,"'><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='cuentaEnt[]' value='", $row[5] ,"'><label>", $row[5] ,"</label></td>
                    <td><input type='hidden' name='realizadoEnt[]' value='", $valorChecked ,"'><input type='checkbox' onclick='cambiarValorCheck2();' ", $checked ,"></td>
                    <td><input type='checkbox'</td>
                    </tr>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos_nomina_modific_dispersiones($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT (SELECT b.nombre FROM empresas b WHERE b.id = a.origen), b.dispersor, b.nombre, a.monto, a.banco, a.cuenta, a.cuentaFinal, a.realizado, a.folio, a.pdf, a.id FROM disperciones a, empresas b, movimiento c WHERE a.idMov = $id AND b.id = a.empresa AND c.id = a.idMov AND c.activo = 1 ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[6]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                }else{
                    $checked = "";
                    $valorChecked = 0;
                }
                if($row[7]==1){
                    $checked2 = "checked='checked'";
                    $valorChecked2 = 1;
                }else{
                    $checked2 = "";
                    $valorChecked2 = 0;
                }
                echo "<tr>
                    <td><input type='hidden' name='origenDest[]' value='", $row[0] ,"'><label>", $row[0] ,"</label></td>
                    <td><input type='hidden' name='dispersora[]' value='", $row[1] ,"'><input type='hidden' name='empresaDest[]' value='", $row[2] ,"'><label>", $row[2] ,"</label></td>
                    <td><input type='hidden' name='montoDest[]' value='", $row[3] ,"'><label>", $row[3] ,"</label></td>
                    <td><input type='hidden' name='bancoDest[]' value='", $row[4] ,"'><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='cuentaDest[]' value='", $row[5] ,"'><label>", $row[5] ,"</label></td>
                    <td><input type='hidden' name='cuentaFinalDest[]' value='", $valorChecked ,"'><input type='checkbox' onclick='cambiarValorCheck();' ", $checked ,"></td>
                    <td><input type='hidden' name='realizadoDest[]' value='", $valorChecked2 ,"'><input type='checkbox' name='checkRealizado[]' onclick='cambiarValorCheck();'  ", $checked2 ,"></td>
                    <td><input type='text' name='folio[]' value='", $row[8] ,"''></td>";
                    if($row[9] == ""){
                        echo "<td class='botnMov'><input type='hidden' name='pdfAntDisp[]' value=''><input type='file' name='pdfDisp[]'></td>";
                    }else{
                        echo "<td class='botnMov'><input type='hidden' name='pdfAntDisp[]' value='$row[9]'><input type='file' name='pdfDisp[]'><a target=\"_blank\" href=\"$row[9]\" title=\"\">Factura</a></td>";
                    }
                    echo "<td><input type='checkbox'></td>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos_simple_modific_dispersiones($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT (SELECT b.nombre FROM empresas b WHERE b.id = a.origen), b.dispersor, b.nombre, a.monto, a.banco, a.cuenta, a.cuentaFinal, a.realizado, a.folio, a.pdf, a.id FROM disperciones a, empresas b, movimiento c WHERE a.idMov = $id AND b.id = a.empresa AND c.id = a.idMov AND c.activo = 1 ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[6]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                }else{
                    $checked = "";
                    $valorChecked = 0;
                }
                if($row[7]==1){
                    $checked2 = "checked='checked'";
                    $valorChecked2 = 1;
                }else{
                    $checked2 = "";
                    $valorChecked2 = 0;
                }
                echo "<tr>
                    <td><input type='hidden' name='origenDest[]' value='", $row[0] ,"'><label>", $row[0] ,"</label></td>
                    <td><input type='hidden' name='dispersora[]' value='", $row[1] ,"'><input type='hidden' name='empresaDest[]' value='", $row[2] ,"'><label>", $row[2] ,"</label></td>
                    <td><input type='hidden' name='montoDest[]' value='", $row[3] ,"'><label>", $row[3] ,"</label></td>
                    <td><input type='hidden' name='bancoDest[]' value='", $row[4] ,"'><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='cuentaDest[]' value='", $row[5] ,"'><label>", $row[5] ,"</label></td>
                    <td><input type='hidden' name='cuentaFinalDest[]' value='", $valorChecked ,"'><input type='checkbox' onclick='cambiarValorCheck();' ", $checked ,"></td>
                    <td><input type='hidden' name='realizadoDest[]' value='", $valorChecked2 ,"'><input type='checkbox' name='checkRealizado[]' onclick='cambiarValorCheck();'  ", $checked2 ,"></td>
                    <td><input type='text' name='folio[]' value='", $row[8] ,"''></td>";
                    if($row[9] == ""){
                        echo "<td class='botnMov'><input type='hidden' name='pdfAntDisp[]' value=''><input type='file' name='pdfDisp[]'></td>";
                    }else{
                        echo "<td class='botnMov'><input type='hidden' name='pdfAntDisp[]' value='$row[9]'><input type='file' name='pdfDisp[]'><a target=\"_blank\" href=\"$row[9]\" title=\"\">Factura</a></td>";
                    }
                    echo "<td><input type='checkbox'></td></tr>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos_nomina_modific_finales($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.empresa, a.tipoTrans, a.monto, a.banco, a.cuenta, a.pdf, a.id, a.comentario, a.dispersora FROM movimientoFinal a, movimiento c WHERE a.idMov = $id AND c.id = a.idMov AND c.activo = 1 ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[1]==0){
                    $tipoTransferencia = "Transferencia";
                }else if($row[1] == 1){
                    $tipoTransferencia = "Efectivo";
                }else{
                    $tipoTransferencia = "Comision";
                }

                if($row[5]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                }else{
                    $checked = "";
                    $valorChecked = 0;
                }
                echo "<tr>
                    <td><input type='hidden' name='idParaDestino[]' value='", $row[6] ,"'><input type='hidden' name='paraDestino[]' value='", $row[0] ,"'><label>", $row[0] ,"</label></td>
                    <td><input type='hidden' name='tipoTransDestino[]' value='", $row[1] ,"'><label>", $tipoTransferencia ,"</label></td>
                    <td><input type='hidden' name='montoDestino[]' value='", $row[2] ,"'><label>", $row[2] ,"</label></td>
                    <td><input type='hidden' name='dispersoraDestino[]' value='", $row[8] ,"'><label>", $row[8] ,"</label></td>
                    <td><input type='hidden' name='bancoDestino[]' value='", $row[3] ,"'><label>", $row[3] ,"</label></td>
                    <td><input type='hidden' name='cuentaDestino[]' value='", $row[4] ,"'><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='comentarioDestino[]' value='", $row[7] ,"'><label>", $row[7] ,"</label></td>";
                    if($row[5] == ""){
                        echo "<td class='botnMov'><input type='hidden' name='pdfAnt[]' value=''><input type='file' name='pdf[]'></td>";
                    }else{
                        echo "<td class='botnMov'><input type='hidden' name='pdfAnt[]' value='$row[5]'><input type='file' name='pdf[]'><a target=\"_blank\" href=\"$row[5]\" title=\"\">Comprobante</a></td>";
                    }
                    echo "<td><input type='checkbox'></td></tr>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos_simple_modific_finales($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.empresa, a.tipoTrans, a.monto, a.banco, a.cuenta, a.pdf, a.id, a.comentario FROM movimientoFinal a, movimiento c WHERE a.idMov = $id AND c.id = a.idMov AND c.activo = 1 ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[1]==0){
                    $tipoTransferencia = "Transferencia";
                }else if($row[1] == 1){
                    $tipoTransferencia = "Efectivo";
                }else{
                    $tipoTransferencia = "Nómina";
                }

                if($row[5]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                }else{
                    $checked = "";
                    $valorChecked = 0;
                }
                echo "<tr>
                    <td><input type='hidden' name='idParaDestino[]' value='", $row[6] ,"'><input type='hidden' name='paraDestino[]' value='", $row[0] ,"'><label>", $row[0] ,"</label></td>
                    <td><input type='hidden' name='tipoTransDestino[]' value='", $row[1] ,"'><label>", $tipoTransferencia ,"</label></td>
                    <td><input type='hidden' name='montoDestino[]' value='", $row[2] ,"'><label>", $row[2] ,"</label></td>
                    <td><input type='hidden' name='bancoDestino[]' value='", $row[3] ,"'><label>", $row[3] ,"</label></td>
                    <td><input type='hidden' name='cuentaDestino[]' value='", $row[4] ,"'><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='comentarioDestino[]' value='", $row[7] ,"'><label>", $row[7] ,"</label></td>";
                    if($row[5] == ""){
                        echo "<td class='botnMov'><input type='hidden' name='pdfAnt[]' value=''><input type='file' name='pdf[]'></td>";
                    }else{
                        echo "<td class='botnMov'><input type='hidden' name='pdfAnt[]' value='$row[5]'><input type='file' name='pdf[]'><a target=\"_blank\" href=\"$row[5]\" title=\"\">Comprobante</a></td>";
                    }
                    echo "<td><input type='checkbox'></td></tr>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos5($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, b.nombre, a.monto, a.banco, a.cuenta, a.realizado FROM movimientoSimple a, empresas b WHERE a.idMov = $id AND b.id = a.empresa ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[5]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                    $desactivado = "disabled";
                }else{
                    $checked = "";
                    $valorChecked = 0;
                    $desactivado = "";
                }
                echo "<tr>
                    <td><input type='hidden' name='idEnt[]' value='", $row[0] ,"'><label>", $row[1] ,"</label></td>
                    <td><label>", $row[2] ,"</label></td>
                    <td><label>", $row[3] ,"</label></td>
                    <td><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='realizadoEnt[]' value='", $valorChecked ,"'><input type='checkbox' onclick='cambiarValorCheck2(); enviarRealizadoActualizado($row[0], \"movimientoSimple\"); disabled=true' ", $checked ," ", $desactivado ,"></td>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos2
    function tabla_mov_incompletos6($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, b.nombre, a.monto, a.banco, a.cuenta, a.realizado FROM movimientoDirecto a, empresas b WHERE a.idMov = $id AND b.id = a.empresa ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[5]==1){
                    $checked = "checked='checked'";
                    $valorChecked = 1;
                    $desactivado = "disabled";
                }else{
                    $checked = "";
                    $valorChecked = 0;
                    $desactivado = "";
                }
                echo "<tr>
                    <td><input type='hidden' name='idEnt[]' value='", $row[0] ,"'><label>", $row[1] ,"</label></td>
                    <td><label>", $row[2] ,"</label></td>
                    <td><label>", $row[3] ,"</label></td>
                    <td><label>", $row[4] ,"</label></td>
                    <td><input type='hidden' name='realizadoEnt[]' value='", $valorChecked ,"'><input type='checkbox' onclick='cambiarValorCheck3(); enviarRealizadoActualizado($row[0], \"movimientoDirecto\"); disabled=true' ", $checked ," ", $desactivado ,"></td>";
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_directos_facturar($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.idMov, a.fecha, a.origen, (SELECT b.nombre FROM empresas b WHERE b.id = a.empresa), a.monto, a.folio, a.pdf FROM movimientoDirecto a, movimiento b WHERE b.id = a.idMov AND b.activo = 1 AND a.realizado = 1 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            echo "<tr><td id='numeroMovimiento'><b>",'No.',"</b></td>
            <td id='numeroMovimiento'><b>",'No. Mov.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td><b>",'Destino de Factura',"</b></td>
            <td><b>",'Origen de Factura',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='montMov'><b>",'Folio',"</b></td>
            <td class='botnMov'><b>",'Ingresar Folio',"</b></td>
            <td class='botnMov'><b>",'PDF',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                echo "<tr><td><input type='hidden' name='idMovDirecto[]' value='$row[0]'>", $row[0],"</td>
                    <td><label>", $row[1],"</label></td>
                    <td class='fechaMov'>", date_format(date_create($row[2]), 'd / m / Y'),"</td>
                    <td><label>", $row[3],"</label></td>
                    <td><label>", $row[4],"</label></td>
                    <td><label>", $row[5],"</label></td>
                    <td class='montMov'><input type='hidden' name='folioAntDirecto[]' value='$row[6]'><label>", $row[6],"</label></td>";
                    if($row[6] == ""){
                        echo "<td class='botnMov'><input type='text' name='folioDirecto[]' maxlength='50' onKeyUp='soloMayusculas(this.value,this.id)'></td>";
                    }else{
                        echo "<td class='botnMov'><input type='text' name='folioDirecto[]' maxlength='50' disabled></td>";
                    }
                    if($row[7] == ""){
                        echo "<td class='botnMov'><input type='file' name='pdfDirecto[]'></td></tr>";
                    }else{
                        echo "<td class='botnMov'><input type='file' name='pdfDirecto[]' disabled><a target=\"_blank\" href=\"$row[7]\" title=\"\">Factura</a></td></tr>";
                    }
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_nominas_facturar($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.idMov, a.fecha, a.origen, (SELECT b.nombre FROM empresas b WHERE b.id = a.empresa), a.monto, a.folio, a.pdf FROM movimientoNominas a, movimiento b WHERE b.id = a.idMov AND b.activo = 1 AND a.realizado = 1 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            echo "<tr><td id='numeroMovimiento'><b>",'No.',"</b></td>
            <td id='numeroMovimiento'><b>",'No. Mov.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td><b>",'Destino de Factura',"</b></td>
            <td><b>",'Origen de Factura',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='montMov'><b>",'Folio',"</b></td>
            <td class='botnMov'><b>",'Ingresar Folio',"</b></td>
            <td class='botnMov'><b>",'PDF',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                echo "<tr><td><input type='hidden' name='idMovNominas[]' value='$row[0]'>", $row[0],"</td>
                    <td><label>", $row[1],"</label></td>
                    <td class='fechaMov'>", date_format(date_create($row[2]), 'd / m / Y'),"</td>
                    <td><label>", $row[3],"</label></td>
                    <td><label>", $row[4],"</label></td>
                    <td><label>", $row[5],"</label></td>
                    <td class='montMov'><input type='hidden' name='folioAntNominas[]' value='$row[6]'><label>", $row[6],"</label></td>";
                    if($row[6] == ""){
                        echo "<td class='botnMov'><input type='text' name='folioNominas[]' maxlength='50' onKeyUp='soloMayusculas(this.value,this.id)'></td>";
                    }else{
                        echo "<td class='botnMov'><input type='text' name='folioNominas[]' maxlength='50' disabled></td>";
                    }
                    if($row[7] == ""){
                        echo "<td class='botnMov'><input type='file' name='pdfNominas[]'></td></tr>";
                    }else{
                        echo "<td class='botnMov'><input type='file' name='pdfNominas[]' disabled><a target=\"_blank\" href=\"$row[7]\" title=\"\">Factura</a></td></tr>";
                    }
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_simples_facturar($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.idMov, a.fecha, a.origen, (SELECT b.nombre FROM empresas b WHERE b.id = a.empresa), a.monto, a.folio, a.pdf FROM movimientoSimple a, movimiento b WHERE b.id = a.idMov AND b.activo = 1 AND a.realizado = 1 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            echo "<tr><td id='numeroMovimiento'><b>",'No.',"</b></td>
            <td id='numeroMovimiento'><b>",'No. Mov.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td><b>",'Destino de Factura',"</b></td>
            <td><b>",'Origen de Factura',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='montMov'><b>",'Folio',"</b></td>
            <td class='botnMov'><b>",'Ingresar Folio',"</b></td>
            <td class='botnMov'><b>",'PDF',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                echo "<tr><td><input type='hidden' name='idMovSimples[]' value='$row[0]'>", $row[0],"</td>
                    <td><label>", $row[1],"</label></td>
                    <td class='fechaMov'>", date_format(date_create($row[2]), 'd / m / Y'),"</td>
                    <td><label>", $row[3],"</label></td>
                    <td><label>", $row[4],"</label></td>
                    <td><label>", $row[5],"</label></td>
                    <td class='montMov'><input type='hidden' name='folioAntSimple[]' value='$row[6]'><label>", $row[6],"</label></td>";
                    if($row[6] == ""){
                        echo "<td class='botnMov'><input type='text' name='folioSimple[]' maxlength='50' onKeyUp='soloMayusculas(this.value,this.id)'></td>";
                    }else{
                        echo "<td class='botnMov'><input type='text' name='folioSimple[]' maxlength='50' disabled></td>";
                    }
                    if($row[7] == ""){
                        echo "<td class='botnMov'><input type='file' name='pdfSimple[]'></td></tr>";
                    }else{
                        echo "<td class='botnMov'><input type='file' name='pdfSimple[]' disabled><a target=\"_blank\" href=\"$row[7]\" title=\"\">Factura</a></td></tr>";
                    }
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mov_incompletos_dispersiones_facturar($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.idMov, a.fecha, (SELECT b.nombre FROM empresas b WHERE b.id = a.origen), (SELECT b.nombre FROM empresas b WHERE b.id = a.empresa), a.monto, a.folio, a.pdf FROM disperciones a, movimiento b WHERE b.id = a.idMov AND b.activo = 1 AND a.realizado = 1 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            echo "<tr><td id='numeroMovimiento'><b>",'No.',"</b></td>
            <td id='numeroMovimiento'><b>",'No. Mov.',"</b></td>
            <td class='fechaMov'><b>",'Fecha',"</b></td>
            <td><b>",'Destino de Factura',"</b></td>
            <td><b>",'Origen de Factura',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='montMov'><b>",'Folio',"</b></td>
            <td class='botnMov'><b>",'Ingresar Folio',"</b></td>
            <td class='botnMov'><b>",'PDF',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                echo "<tr><td><input type='hidden' name='idMov[]' value='$row[0]'>", $row[1],"</td>
                    <td><label>", $row[1],"</label></td>
                    <td class='fechaMov'>", date_format(date_create($row[2]), 'd / m / Y'),"</td>
                    <td><label>", $row[3],"</label></td>
                    <td><label>", $row[4],"</label></td>
                    <td><label>", $row[5],"</label></td>
                    <td class='montMov'><input type='hidden' name='folioAnt[]' value='$row[6]'><label>", $row[6],"</label></td>";
                    if($row[6] == ""){
                        echo "<td class='botnMov'><input type='text' name='folio[]' maxlength='50' onKeyUp='soloMayusculas(this.value,this.id)'></td>";
                    }else{
                        echo "<td class='botnMov'><input type='text' name='folio[]' maxlength='50' disabled></td>";
                    }
                    if($row[7] == ""){
                        echo "<td class='botnMov'><input type='file' name='pdf[]'></td></tr>";
                    }else{
                        echo "<td class='botnMov'><input type='file' name='pdf[]' disabled><a target=\"_blank\" href=\"$row[7]\" title=\"\">Factura</a></td></tr>";
                    }
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function tabla_mostrar_finales($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.empresa, a.tipoTrans, a.monto, a.banco, a.cuenta, a.comentario FROM movimientoFinal a WHERE a.idMov = $id ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            echo "<tr><td><b>",'Empresa',"</b></td>
            <td><b>",'Tipo Transferencia',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td><b>",'Banco',"</b></td>
            <td><b>",'Cuenta',"</b></td>
            <td><b>",'Comentario',"</b></td></tr>";

            $toalTotales = 0;

            while($row=mysqli_fetch_array($pConsulta)){
                if($row[1] == 0){
                    $row[1] = 'Transferencia';
                }else if($row[1] == 1){
                    $row[1] = 'Efectivo';
                }else if($row[1] == 2){
                    $row[1] = 'Nómina';
                }
                echo "<tr><td><label>", $row[0],"</label></td>
                    <td><label>", $row[1],"</label></td>
                    <td class='montMov'><label>",$row[2],"</label></td>
                    <td><label>", $row[3],"</label></td>
                    <td><label>", $row[4],"</label></td>
                    <td><label>", $row[5],"</label></td></tr>";

                $toalTotales += $row[2];
            }
            echo "<tr><td><label></label></td>
                <td><label>Total</label></td>
                <td class='montMov'><label>",$toalTotales,"</label></td>
                <td><label></label></td>
                <td><label></label></td>
                <td><label></label></td></tr>";
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos Directos
    function tabla_mostrar_finales_directos($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.empresa, a.tipoTrans, a.monto, a.banco, a.cuenta, a.comentario, a.dispersora FROM movimientoFinal a WHERE a.idMov = $id ORDER BY a.id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            echo "<tr><td><b>",'Empresa',"</b></td>
            <td><b>",'Tipo Transferencia',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td><b>",'Dispersora',"</b></td>
            <td><b>",'Receptor',"</b></td>
            <td><b>",'Destino',"</b></td>
            <td><b>",'Comentario',"</b></td></tr>";

            $toalTotales = 0;

            while($row=mysqli_fetch_array($pConsulta)){
                if($row[1] == 0){
                    $row[1] = 'Transferencia';
                }else if($row[1] == 1){
                    $row[1] = 'Efectivo';
                }else if($row[1] == 2){
                    $row[1] = 'Comision';
                }
                echo "<tr><td><label>", $row[0],"</label></td>
                    <td><label>", $row[1],"</label></td>
                    <td class='montMov'><label>",$row[2],"</label></td>
                    <td><label>", $row[6],"</label></td>
                    <td><label>", $row[3],"</label></td>
                    <td><label>", $row[4],"</label></td>
                    <td><label>", $row[5],"</label></td></tr>";

                $toalTotales += $row[2];
            }
            echo "<tr><td><label></label></td>
                <td><label>Total</label></td>
                <td class='montMov'><label>",$toalTotales,"</label></td>
                <td><label></label></td>
                <td><label></label></td>
                <td><label></label></td>
                <td><label></label></td></tr>";
        }
        cerrar_db($mysqli);
    }

    //tabla de movimientos incompletos
    function disperciones_existentes($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta3 = "SELECT tipo FROM movimiento WHERE id = $id LIMIT 1";
        $pConsulta3 = consulta_tb($mysqli, $Consulta3);
        $row = mysqli_fetch_array($pConsulta3);

        if($row[0] == 3){
            echo "<input type='hidden' name='disperciones' id='disperciones' value='1'>";
        }else{
            $Consulta = "SELECT realizado FROM disperciones WHERE idMov = $id AND realizado = 0 LIMIT 1";
            $pConsulta = consulta_tb($mysqli, $Consulta);
            $row2 = mysqli_fetch_array($pConsulta);

            $Consulta2 = "SELECT realizado FROM disperciones WHERE idMov = $id";
            $pConsulta2 = consulta_tb($mysqli, $Consulta2);
            $row3 = mysqli_fetch_array($pConsulta2);

            if(!$row2 && $row3){
                echo "<input type='hidden' name='disperciones' id='disperciones' value='1'>";
            }else{
                echo "<input type='hidden' name='disperciones' id='disperciones' value='0'>";
            } 
        }
        cerrar_db($mysqli);
    }

    //eliminar registros en la bd
    function baja($tabla, $dato){
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        /* Actualiza filas */
        $Consulta = "UPDATE $tabla SET activo=0 WHERE id = $dato";
        consulta_tb($mysqli, $Consulta);

        /* Cierra la conexión */
        cerrar_db($mysqli);
    }

    //eliminar registros en la bd
    function datos_mod($tabla, $dato){
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        /* Actualiza filas */
        $Consulta = "SELECT * FROM $tabla WHERE id = $dato";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        return $pConsulta;

        /* Cierra la conexión */
        cerrar_db($mysqli);
    }

    //Rellena el formulario a modificar
    function rellenaFormulario($tabla, $id){
        $mysqli = conectar_db();
        selecciona_db($mysqli);

        $Consulta = "SELECT * FROM $tabla WHERE id = $id";
        $pConsulta = consulta_tb($mysqli, $Consulta);
        $row = mysqli_fetch_array($pConsulta);
        return $row;
    }

    //tabla de movimientos incompletos
    function tabla_listado_mov_finales($mes, $anio) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT a.id, a.origen, b.empresa, b.tipoTrans, b.monto, b.banco, b.cuenta, b.pdf, a.fecha FROM movimiento a, movimientoFinal b WHERE a.activo = 1 AND b.idMov = a.id AND b.realizado = 1 AND a.fecha BETWEEN '$anio-$mes-1' AND '$anio-$mes-31' ORDER BY a.origen, a.fecha, a.hora ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            echo "No se encontrarón resultados para esta consulta.";
        }else{
            $i = 1;
            echo "<tr><td id='noMov'><b>",'No.',"</b></td>
            <td class='empOrigen'><b>",'Cliente',"</b></td>
            <td class='empMov'><b>",'Destino',"</b></td>
            <td class='empMov'><b>",'Tipo',"</b></td>
            <td class='montMov'><b>",'Monto',"</b></td>
            <td class='montMov'><b>",'Banco',"</b></td>
            <td class='montMov'><b>",'Cuenta',"</b></td>
            <td class='botnMov'><b>",'Comprobante',"</b></td>
            <td class='botnMov'><b>",'Fecha',"</b></td></tr>";
            while($row=mysqli_fetch_array($pConsulta)){
                if($row[6] == 2){
                    $row[4] = "<-----NÓMINA----->";
                }else if($row[6] == 3){
                    $row[4] = "----->SÍMPLE<-----";
                }
                echo "<tr><td><label>", $row[0],"</label></td>
                    <td><label>", $row[1],"</label></td>
                    <td><label>", $row[2],"</label></td>";
                    if($row[3] == 0){
                        $row[3] = "Transferencia";
                    }else if($row[3] == 1){
                        $row[3] = "Efectivo";
                    }else{
                        $row[3] = "Nómina";
                    }
                    echo "<td><label>", $row[3],"</label></td>
                    <td class='montMov'><label>", $row[4],"</label></td>
                    <td><label>", $row[5],"</label></td>
                    <td><label>", $row[6],"</label></td>";
                    if($row[7] != ""){
                        echo "<td><label><a target=\"_blank\" href=\"$row[7]\" title=\"\">Transfer</a></label></td>";
                    }else{
                        echo "<td><label></label></td>";
                    }
                    echo "<td class='fechaMov'><label>", date_format(date_create($row[8]), 'd / m / Y'),"</label></td></tr>";
                    $i++;
            }
        }
        cerrar_db($mysqli);
    }

    //tabla de limites
    function tabla_limites($id) {
        $mysqli = conectar_db();
        selecciona_db($mysqli);
        
        $Consulta = "SELECT (SELECT b.nombre FROM empresas b WHERE a.origen = b.id), (SELECT b.nombre FROM empresas b WHERE a.destino = b.id), a.limite FROM limites a WHERE origen = $id ORDER BY id ASC";

        $pConsulta = consulta_tb($mysqli, $Consulta);

        if(!$pConsulta){
            //echo "No se encontrarón resultados para esta consulta.";
        }else{
            while($row=mysqli_fetch_array($pConsulta)){
                echo "<tr>
                    <td><input type='hidden' name='empresaOrigen[]' value='", $row[0] ,"'><label>", $row[0] ,"</label></td>
                    <td><input type='hidden' name='empresaDestino[]' value='", $row[1] ,"'><label>", $row[1] ,"</label></td>
                    <td><input type='hidden' name='montoLimite[]' value='", $row[2] ,"'><label>", $row[2] ,"</label></td>
                    <td><input type='checkbox'></td>";
            }
        }
        cerrar_db($mysqli);
    }
?>