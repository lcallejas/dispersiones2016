            function myCreateFunction() {
            	var table = document.getElementById("myTable"); {

                    var empresa = document.formulario.empresa.value;

                    var combo = document.getElementById("listado"); 
                    var listado = combo.options[combo.selectedIndex].text;
                    
                    var montoLimite = document.formulario.montoLimite.value;

                    var verifica = 0;       
                    var table=document.getElementById("myTable");
                    var rowCount=table.rows.length;
                    for(var i=1;i<rowCount;i++){
                        var row=table.rows[i];
                        var empresaDestino=row.cells[1].childNodes[1].innerText;
                        if(listado==empresaDestino){
                            verifica = 1;
                        }
                    }

                    if(empresa == ""){
                        alert("Debes seleccionar una emprea para aplicarle límites.");
                    }else if(listado == "Seleccion"){
                        alert("Debes seleccionar una empresa de Destino.");
                    }else if(montoLimite == ""){
                        alert("Debes poner un límite de ingreso.");
                    }else if(verifica == 1){
                        alert("No puedes ingresar dos limites para la misma empresa.");
                    }else{
                            var row = table.insertRow(table.rows.length);
                            var filas = table.rows.length - 2;
                            
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            var cell4 = row.insertCell(3);
                            
                            cell1.innerHTML = '<input type="hidden" name="empresaOrigen[]" value="'+ empresa +'"><label>' + empresa + '</label>';
                            cell2.innerHTML = '<input type="hidden" name="empresaDestino[]" value="'+ listado +'"><label>' + listado + '</label>';
                            cell3.innerHTML = '<input type="hidden" name="montoLimite[]" value="'+ montoLimite +'"><label>' + montoLimite + '</label>';
                            cell4.innerHTML = '<input type="checkbox">';

                            document.getElementById("listado").value = "Seleccion";
                            document.getElementById("montoLimite").value = "";
                    }
            	}
        	}

            function myDeleteFunction() {
                try{
                    var table=document.getElementById("myTable");
                    var rowCount=table.rows.length;
                    for(var i=0;i<rowCount;i++){
                        var row=table.rows[i];
                        var chkbox=row.cells[3].childNodes[0];
                        if(null!=chkbox&&true==chkbox.checked){
                            if(rowCount<=1){
                                alert("Cannot delete all the rows.");
                                break;
                            }
                            table.deleteRow(i);
                            rowCount--;
                            i--;
                        }
                    }
                }catch(e){
                    alert(e);
                }
            }