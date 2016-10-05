function validar(origen){
	if(origen == "NuevoProcesoDirecto"){
		var montoEntrada = parseFloat(document.getElementById("totalDirecto").value);
		var total = parseFloat(document.getElementById("myTableTotal").rows[0].cells[2].innerText);
		if(montoEntrada == total){
			document.formulario.action = "../php/datosProceso.php";
			document.formulario.submit();
		}else{
			alert('El monto de entrada no es igual al monto total depositado.');
		}
	}else if(origen == "NuevoProcesoNominas"){
		document.formulario.action = "../php/datosProcesoNominas.php";
		document.formulario.submit();
	}else if(origen == "NuevoProcesoSimple"){
		quienEntrada = document.getElementById("quienEntrada").value;
		if(quienEntrada != ""){
			tableEntra = document.getElementById("myTableNominas");
			rowEntra = tableEntra.rows.length;
			table = document.getElementById("myTable");
			row = table.rows.length;
			if(rowEntra > 1 || row > 1){
				document.formulario.action = "../php/datosProcesoSimples.php";
				document.formulario.submit();
			}else{
				alert('No haz agregado ni un movimiento.');
			}
		}else{
			alert('Ingresa un cliente.');
		}
	}else if(origen == "NuevoProcesoPrestamo"){
		quienSalida = document.getElementById("quienSalida").value;
		quienEntrada = document.getElementById("quienEntrada").value;
		montoEntrada = document.getElementById("montoEntrada").value;
		montoFloat = parseFloat(montoEntrada);
		bancoOrigen = document.getElementById("bancoOrigen").value;
		bancoDestino = document.getElementById("bancoDestino").value;
		if(quienSalida == ""){
			alert("Debes ingresar la empresa de la cual sale el prestamo.");
		}else if(quienEntrada == ""){
			alert("Debes ingresar la empresa a la cual llegará el prestamo.");
		}else if(montoEntrada == "" || montoFloat <= 0){
			alert("Debes ingresar un monto válido.");
		}else if(bancoOrigen == ""){
			alert("Debes ingresar un banco origen.");
		}else if(bancoDestino == ""){
			alert("Debes ingresar un banco destino.");
		}else{
			document.formulario.action = "../php/datosProcesoPrestamo.php";
			document.formulario.submit();
		}
	}else if(origen == "NuevoUsuario"){
		var nombre = document.getElementById("nombre").value;
		var usuario = document.getElementById("usuario").value;
		var pass = document.getElementById("pass").value;
		var permisos = document.getElementById("permisos").value;

		if(nombre == ""){
			alert("Debes agregar un nombre.");
		}else if(usuario == ""){
			alert("Debes agregar un usuario.");
		}else if(pass == ""){
			alert("Debes agregar una contraseña.");
		}else if(permisos == "Seleccion"){
			alert("Debes agregar permisos de usuario.");
		}else{
			document.formulario.action = "../php/datosUsuario.php";
			document.formulario.submit();
		}
	}else if(origen == "ModificarUsuario"){
		var id = document.getElementById("idUsuario").value;
		var nombre = document.getElementById("nombre").value;
		var usuario = document.getElementById("usuario").value;
		var pass = document.getElementById("pass").value;
		var permisos = document.getElementById("permisos").value;

		if(id == ""){
			alert("No haz seleccionado un usuario para modificar");
		}else if(nombre == ""){
			alert("Debes agregar un nombre.");
		}else if(usuario == ""){
			alert("Debes agregar un usuario.");
		}else if(pass == ""){
			alert("Debes agregar una contraseña.");
		}else if(permisos == "Seleccion"){
			alert("Debes agregar permisos de usuario.");
		}else{
			document.formulario.action = "../php/datosUsuario.php";
			document.formulario.submit();
		}
	}else if(origen == "EliminarUsuario"){
		var listado = document.getElementById("listado").value;
		alert(listado);
		if(listado == "Seleccion"){
			alert("Debes selecionar un usuario a eliminar.");
		}else{
			document.formulario.action = "../php/datosUsuario.php";
			document.formulario.submit();
		}
	}else if(origen == "NuevaEmpresa"){
		var nombre = document.getElementById("nombre").value;
		if(nombre == ""){
			alert("Debes ingresar un nombre.");
		}else{
			document.formulario.action = "../php/datosEmpresa.php";
			document.formulario.submit();
		}
	}else if(origen == "ModificarEmpresa"){
		var id = document.getElementById("idEmpresa").value;
		var nombre = document.getElementById("nombre").value;
		if(id == ""){
			alert("Debes seleccionar una empresa a modificar.");
		}else if(nombre == ""){
			alert("Debes ingresar un nombre.");
		}else{
			document.formulario.action = "../php/datosEmpresa.php";
        	document.formulario.submit();
        }
	}else if(origen == "EliminarEmpresa"){
		var listado = document.getElementById("listado").value;
		if(listado = "Seleccion"){
			alert("Debes selecionar una empresa a eliminar.");
		}else{
			document.formulario.action = "../php/datosEmpresa.php";
			document.formulario.submit();
		}
	}else if(origen == "SeguimientoDirecto"){
	var verifica = 0;
                
		var table=document.getElementById("myTableDirecto");
		var rowCount=table.rows.length;
		for(var i=0;i<rowCount;i++){
			var row=table.rows[i];
			var chkbox=row.cells[4].childNodes[1];
			if(null!=chkbox&&true==chkbox.checked){
				verifica = 1;
			}
		}
		if(verifica == 1){
			var resp = confirm("Alguna o todas las casillas de realizado del monto de Entrada estan activadas.\nDeseas continuar?");
			if(resp == true){
				var montoEntrada = parseFloat(document.getElementById("totalDirecto").value);
				var total = parseFloat(document.getElementById("myTableTotal").rows[0].cells[2].innerText);
				if(montoEntrada == total){
					document.formulario.action = "../php/datosProceso.php";
					document.formulario.submit();
				}else{
               		alert('El monto de Entrada no es igual al monto en Dispersora.');
				}
			}else{
				//No hace nada.
			}
		}else{
			var verifica = 1;

			var table=document.getElementById("myTable");
			var rowCount=table.rows.length;
			for(var i=0;i<rowCount;i++){
				var row=table.rows[i];
               	var chkbox=row.cells[6].childNodes[1];
				if(null!=chkbox&&true==chkbox.checked){
					verifica = 0;
				}
			}
			if(verifica == 1){
				var montoEntrada = document.getElementById("montoEntrada").innerText;
				var total = parseFloat(document.getElementById("myTableTotal").rows[0].cells[2].innerText);
				if(montoEntrada == total){
					document.formulario.action = "../php/datosProceso.php";
					document.formulario.submit();
				}else{
					alert('El monto de Entrada no es igual al monto en Dispersora.');
				}
			}else{
				alert('No puedes activar la casilla realizado de la tabla sin haber activado la del monto de entrada.');
			}
		}
	}
	else if(origen == "FacturarProcesoContador"){
		var control = 0;

		var table=document.getElementById("tabla_incompletos_directo");
		var rowCount=table.rows.length;

		for(var i=0;i<rowCount;i++){
			var row=table.rows[i];
			var folio=row.cells[7].childNodes[0].value;
			var archivo=row.cells[8].childNodes[0].value;
			if(folio == "" && archivo != ""){
				control = 1;
			}else if(folio != "" && archivo == ""){
				control = 1;
			}
		}

		var tableNom=document.getElementById("tabla_incompletos_nominas");
		var rowCountNom=tableNom.rows.length;

		for(var i=0;i<rowCountNom;i++){
			var row=tableNom.rows[i];
			var folio=row.cells[7].childNodes[0].value;
			var archivo=row.cells[8].childNodes[0].value;
			if(folio == "" && archivo != ""){
				control = 1;
			}else if(folio != "" && archivo == ""){
				control = 1;
			}
		}

		var tableSim=document.getElementById("tabla_incompletos_simples");
		var rowCountSim=tableSim.rows.length;

		for(var i=0;i<rowCountSim;i++){
			var row=tableSim.rows[i];
			var folio=row.cells[7].childNodes[0].value;
			var archivo=row.cells[8].childNodes[0].value;
			if(folio == "" && archivo != ""){
				control = 1;
			}else if(folio != "" && archivo == ""){
				control = 1;
			}
		}

		if(control == 0){
			for(var i=0;i<rowCount;i++){
				var row=table.rows[i];
				var disabd=row.cells[7].childNodes[0];
				var disabd2=row.cells[8].childNodes[0];
				if(null!=disabd&&true==disabd.disabled){
					disabd.disabled = false;
				}
				if(null!=disabd2&&true==disabd2.disabled){
					disabd2.disabled = false;
				}
			}
			for(var i=0;i<rowCountNom;i++){
				var row=tableNom.rows[i];
				var disabd=row.cells[7].childNodes[0];
				var disabd2=row.cells[8].childNodes[0];
				if(null!=disabd&&true==disabd.disabled){
					disabd.disabled = false;
				}
				if(null!=disabd2&&true==disabd2.disabled){
					disabd2.disabled = false;
				}
			}
			for(var i=0;i<rowCountSim;i++){
				var row=tableSim.rows[i];
				var disabd=row.cells[7].childNodes[0];
				var disabd2=row.cells[8].childNodes[0];
				if(null!=disabd&&true==disabd.disabled){
					disabd.disabled = false;
				}
				if(null!=disabd2&&true==disabd2.disabled){
					disabd2.disabled = false;
				}
			}
			document.formulario.action = "../php/datosProceso.php";
			document.formulario.submit();
		}else{
			alert("Debes poner el folio y subir la factura al mismo tiempo, de lo contrario no podras guardar los cambios.");
		}
	}else if(origen == "FacturarProcesoDispersor"){
		var table=document.getElementById("tabla_incompletos");
		var rowCount=table.rows.length;

		var control = 0;

		for(var i=0;i<rowCount;i++){
			var row=table.rows[i];
			var folio=row.cells[7].childNodes[0].value;
			var archivo=row.cells[8].childNodes[0].value;
			if(folio == "" && archivo != ""){
				control = 1;
			}else if(folio != "" && archivo == ""){
				control = 1;
			}
		}

		if(control == 0){
			for(var i=0;i<rowCount;i++){
				var row=table.rows[i];
				var disabd=row.cells[7].childNodes[0];
				var disabd2=row.cells[8].childNodes[0];
				if(null!=disabd&&true==disabd.disabled){
					disabd.disabled = false;
				}
				if(null!=disabd2&&true==disabd2.disabled){
					disabd2.disabled = false;
				}
			}
			document.formulario.action = "../php/datosDispersiones.php";
			document.formulario.submit();
		}else{
			alert("Debes poner el folio y subir la factura al mismo tiempo, de lo contrario no podras guardar los cambios.");
		}
	}else if(origen == "ModificarNominasCompleto"){
		document.formulario.action = "../php/datosModificarNominas.php";
		document.formulario.submit();
	}else if(origen == "ModificarDirectoCompleto"){
		document.formulario.action = "../php/datosModificarDirecto.php";
		document.formulario.submit();
	}else if(origen == "ModificarSimpleCompleto"){
		document.formulario.action = "../php/datosModificarSimple.php";
		document.formulario.submit();
	}else if(origen == "ModificarPrestamoCompleto"){
		document.formulario.action = "../php/datosModificarPrestamo.php";
		document.formulario.submit();
	}else if(origen == "ModificarLimites"){
		alert("Datos guardados.");
		document.getElementById("empresa").disabled = false;
		document.formulario.action = "../php/datosModificarLimites.php";
		document.formulario.submit();
	}else if(origen == "FinalizarProceso"){
		var table=document.getElementById("myTableFin");
		var rowCount=table.rows.length;
		for(var i=0;i<rowCount;i++){
			var row=table.rows[i];
			var disabd=row.cells[5].childNodes[0];
			if(null!=disabd&&true==disabd.disabled){
				disabd.disabled = false;
			}
		}
		document.formulario.action = "../php/datosProceso.php";
		document.formulario.submit();
	}
}

function validarNominas(){
	if (document.getElementById("myTable").rows.length >= 2) {
			document.formulario.action = "../php/datosProcesoNominas.php";
			document.formulario.submit();
		}else{
			alert("No haz realizado las disperciones.");
		}
}

function validarSimple(){
	document.formulario.action = "../php/datosProcesoSimples.php";
	document.formulario.submit();
}

function visualizar(origen){
	if(origen == "Contador"){
		document.formulario.action = "../movimientos/facturarProceso.php";
		document.formulario.submit();
	}else if(origen == "Dispersiones"){
		document.formulario.action = "../movimientos/facturarDispersiones.php";
		document.formulario.submit();
	}else if(origen == "Seguimiento"){
		document.formulario.action = "../movimientos/continuaProceso.php";
		document.formulario.submit();
	}else if(origen == "Modificar"){
		document.formulario.action = "../movimientos/modificaProceso.php";
		document.formulario.submit();
	}else if(origen == "ListadoFinales"){
		document.formulario.action = "../listados/listadoFinales.php";
		document.formulario.submit();
	}
}

function rellenarFormulario(nombre){
	var listado = document.getElementById("listado1").value;
	if(listado == "Seleccion"){
		if(nombre == "Usuarios"){
			alert("Debes seleccionar un usuario para modificar.");
		}else{
			alert("Debes seleccionar una empresa para modificar.");
		}
	}else{
		document.formulario.action = "../"+nombre+"/modificar"+nombre+".php";
		document.formulario.submit();
	}
}


function procesaLimites(){
	var listado = document.getElementById("listado1").value;
	if(listado == "Seleccion"){
		alert("Debes seleccionar una empresa para modificar.");
	}else{
		document.formulario.action = "limites.php";
		document.formulario.submit();
	}
}

function soloNumeros(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
    return true;
 
    return /\d/.test(String.fromCharCode(keynum));
}

function soloMayusculas(obj,id){
	obj = obj.toUpperCase();
	document.getElementById(id).value = obj;
}

function desactivar(){
	var verifica = 1;
                
	var table=document.getElementById("myTable");
	var rowCount=table.rows.length;
	for(var i=0;i<rowCount;i++){
		var row=table.rows[i];
		var chkbox=row.cells[7].childNodes[0];
		if(null!=chkbox&&true==chkbox.disabled){
			verifica = 0;
		}
	}
	if(verifica == 0){
		document.getElementById("agregarFila").disabled=true;
	}
}

function agregarNuevoPDF(cliente, nombre){
	document.getElementById("clienteText").disabled=false;
	document.getElementById("nombreText").disabled=false;

	document.formulario.action = "../php/altaPDFNominas.php";
	document.formulario.submit();
}