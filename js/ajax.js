// JavaScript Document
 
// Función para recoger los datos de PHP según el navegador, se usa siempre.
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
 
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
 
//Función para recoger los datos del formulario y enviarlos por post  
function enviarRealizadoActualizado(idMov, tablaMov){
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  ajax.open("POST", "../php/actualizaRealizado.php",true);
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  ajax.send("id="+idMov+"&tabla="+tablaMov);
}