function rellenarFormulario(nombre){
	document.formulario.action = "../"+nombre+"/modificar"+nombre+".php";
	document.formulario.submit();
}