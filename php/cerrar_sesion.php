<?php
        ob_start(); 
	session_start();
	
	session_unset();
	session_destroy();

	if($_SESSION){
		echo"Error al cerrar sesion";
	}else{
		header("Location: ../index.html");
	}
        ob_en_flush(); 
?>