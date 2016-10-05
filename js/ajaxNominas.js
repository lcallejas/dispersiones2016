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
function agregarNuevoCliente(cliente){
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  ajax.open("POST", "../php/actualizaNominasPDF.php",true);
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  ajax.send("categoria=clientes&cliente="+cliente);
}
 
//Función para recoger los datos del formulario y enviarlos por post
function agregarNuevoNombre(cliente, nombre){
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  ajax.open("POST", "../php/actualizaNominasPDF.php",true);
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  ajax.send("categoria=nombres&cliente="+cliente+"&nombre="+nombre);
}

function visualizarPDFs(cliente, nombre){
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("POST", "../php/consultaPDFsNominas.php",true);
  	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  	ajax.send("cliente="+cliente+"&nombre="+nombre);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
}

function visualizarSelect(cliente){
	divResultado = document.getElementById('listadoNombres1');
	ajax=objetoAjax();
	ajax.open("POST", "../php/consultaSelectNominas.php",true);
  	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  	ajax.send("cliente="+cliente);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
}

function eliminaPDF(valorId, direccionPDF, cliente, nombre){
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("POST", "../php/consultaPDFsNominas.php",true);
  	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  	ajax.send("valorId="+valorId+"&direccionPDF="+direccionPDF+"&cliente="+cliente+"&nombre="+nombre);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
}