<?php 
  
  function conectar_db()
  {
    $mysqli = mysqli_connect(SERVER, USER, PASSWORD) or die ("No se pudo establecer la conexion con el servidor.");
    mysqli_query($mysqli, "SET NAMES 'utf8'");
    return $mysqli;
  }

  function selecciona_db($mysqli){
    mysqli_select_db($mysqli, DATABASE) or die ("No se pudo establecer la conexion con la base de datos.");
  }

  function consulta_tb($mysqli, $Sql){
    global $resultado;
    $resultado = mysqli_query($mysqli, $Sql);
    if($resultado <> NULL){
      return $resultado;
    }else{
      return 0;
    }
  }

  //indicado de la consulta indicada
  function Get_Datos($pConsulta){   
   $aDatos=mysql_fetch_array($pConsulta);
   return $aDatos;
  }



  
  //Funcion para ejecutar consultas en Mysql
  function consulta_tb1($Sql){
    global  $pConsulta; 
    $pConsulta = mysqli_query($Sql);
	  If ($pConsulta<>NULL){
      return $pConsulta;
    }
    else{
      return 0;
    }
  }

  //Funcion para cerrar una base de datos
  function cerrar_db($mysqli)
  {
    // Cerramos la conexion con la base de datos
    mysqli_close($mysqli);
  }
  
  //Funcion para regresar el valor del campo
  //indicado de la consulta indicada
  /*function Get_Datos($pConsulta){   
   $aDatos=mysql_fetch_array($pConsulta);
     error("5");
   return $aDatos;
  }*/

  //Funcion que devuelve el numero del error  
  //obtenido en un a consulta
  //para : utiles.php function error()

  function GetNumError(){
    $numError=mysql_errno();
    return $numError;
  }
  
  //Funcion que devuelve la descripción del error  
  //obtenido en un a consulta
  //para : Utiles.php function error()

  function GetDescError(){ 
    $descError=mysql_error();
    return $descError;
  }
/* 
  //Funcion que crea una tabla temporal 
  //para trabajar con ella
  //para : general
  
  function CrearTable($Nomtabla,$Campos,$Tablas,$Condicion)
  {
    global  $tmpTable; 

               $enunSQL = " CREATE TEMPORARY TABLE ";
    $enunSQL = $enunSQL . $Nomtabla;
    $enunSQL = $enunSQL . " TYPE=HEAP ";
    $enunSQL = $enunSQL . " SELECT ";
    $enunSQL = $enunSQL . $Campos;
    $enunSQL = $enunSQL . " FROM ";
    $enunSQL = $enunSQL . $Tablas;
    $enunSQL = $enunSQL . $Condicion;
    $enunSQL = $enunSQL . ";";
    $tmpTable=mysql_query($enunSQL); 
  }
  */
?>
