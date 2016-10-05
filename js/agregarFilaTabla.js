            function myCreateFunction() {
            	var table = document.getElementById("myTable"); {
                    var paraDestino = document.formulario.paraDestino.value;

                    var combo2 = document.getElementById("tipoTransDestino"); 
                    var tipoTransDestino = combo2.options[combo2.selectedIndex].text; 
            		var tipoTransDestinoId = document.formulario.tipoTransDestino.value;
            		
                    var montoDestino = document.formulario.montoDestino.value;
                    var dispersoraDestino = document.formulario.dispersoraDestino.value;
                    var bancoDestino = document.formulario.bancoDestino.value;
                    var cuentaDestino = document.formulario.cuentaDestino.value;
                    var comentarioDestino = document.formulario.comentarioDestino.value;

                    if(paraDestino == ""){
                        alert("Debes ingresa una empresa/cliente destino.");
                    }else if(tipoTransDestinoId == "Seleccion"){
                        alert("Selecciona un tipo de transferencia.");
                    }else if(montoDestino == ""){
                        alert("Debes ingresa un monto.");
                    }else if(dispersoraDestino == ""){
                        alert("Debes ingresa una dispersora.");
                    }else if(bancoDestino == ""){
                        alert("Debes ingresa un banco receptor.");
                    }else if(cuentaDestino == ""){
                        alert("Debes ingresa un banco destino.");
                    }else{
                        var row = table.insertRow(table.rows.length);
                        var filas = table.rows.length - 2;
                	
                        var cell1 = row.insertCell(0);
                	    var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);
                        var cell7 = row.insertCell(6);
                        var cell8 = row.insertCell(7);

                	    cell1.innerHTML = '<input type="hidden" name="paraDestino[]" value="'+ paraDestino +'"><label>' + paraDestino + '</label>';
                        cell2.innerHTML = '<input type="hidden" name="tipoTransDestino[]" value="'+ tipoTransDestinoId +'"><label>' + tipoTransDestino + '</label>';
                	    cell3.innerHTML = '<input type="hidden" name="montoDestino[]" value="'+ montoDestino +'"><label>' + montoDestino + '</label>';
                        cell4.innerHTML = '<input type="hidden" name="dispersoraDestino[]" value="'+ dispersoraDestino +'"><label>' + dispersoraDestino + '</label>';
                        cell5.innerHTML = '<input type="hidden" name="bancoDestino[]" value="'+ bancoDestino +'"><label>' + bancoDestino + '</label>';
                        cell6.innerHTML = '<input type="hidden" name="cuentaDestino[]" value="'+ cuentaDestino +'"><label>' + cuentaDestino + '</label>';
                        cell7.innerHTML = '<input type="hidden" name="comentarioDestino[]" value="'+ comentarioDestino +'"><label>' + comentarioDestino + '</label>';
                        cell8.innerHTML = '<input type="checkbox">';

                        document.getElementById("paraDestino").value = "";
                	    document.getElementById("tipoTransDestino").value = "Seleccion";
                	    document.getElementById("montoDestino").value = "";
                        document.getElementById("dispersoraDestino").value = "";
                        document.getElementById("bancoDestino").value = "";
                        document.getElementById("cuentaDestino").value = "";
                        document.getElementById("comentarioDestino").value = "";
                    }

            	}
                setTotal();
        	}

        	function myDeleteFunction() {
                try{
                    var table=document.getElementById("myTable");
                    var rowCount=table.rows.length;
                    for(var i=0;i<rowCount;i++){
                        var row=table.rows[i];
                        var chkbox=row.cells[7].childNodes[0];
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
                setTotal();
        	} 

            function myCreateFunctionDirecto() {
                var table = document.getElementById("myTableDirecto"); {
                    var combo1 = document.getElementById("listado1"); 
                    var listado1 = combo1.options[combo1.selectedIndex].text;
                    var listado1Id = document.formulario.listado1.value;
                    
                    var montoEntrada = document.formulario.montoEntrada.value;
                    var bancoEntrada = document.formulario.bancoEntrada.value;
                    var cuentaEntrada = document.formulario.cuentaEntrada.value;

                    if(listado1Id == "Seleccion"){
                        alert("Debes seleccionar una empresa de Destino.");
                    }else if(montoEntrada == ""){
                        alert("Debes ingresar un monto.");
                    }else if(bancoEntrada == ""){
                        alert("Debes ingresar un banco.");
                    }else{
                        var row = table.insertRow(table.rows.length);
                        var filas = table.rows.length - 2;
                    
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                    
                        cell1.innerHTML = '<input type="hidden" name="empEnt[]" value="'+ listado1Id +'"><input type="hidden" name="empresaEnt[]" value="'+ listado1 +'"><label>' + listado1 + '</label>';
                        cell2.innerHTML = '<input type="hidden" name="montoEnt[]" value="'+ montoEntrada +'"><label>' + montoEntrada + '</label>';
                        cell3.innerHTML = '<input type="hidden" name="bancoEnt[]" value="'+ bancoEntrada +'"><label>' + bancoEntrada + '</label>';
                        cell4.innerHTML = '<input type="hidden" name="cuentaEnt[]" value="'+ cuentaEntrada +'"><label>' + cuentaEntrada + '</label>';
                        cell5.innerHTML = '<input type="checkbox">';

                        document.getElementById("listado1").value = "Seleccion";
                        document.getElementById("montoEntrada").value = "";
                        document.getElementById("bancoEntrada").value = "";
                        document.getElementById("cuentaEntrada").value = "";
                    }
                }
                setTotalDirecto();
            }

            function myDeleteFunctionDirecto() {
                try{
                    var table=document.getElementById("myTableDirecto");
                    var rowCount=table.rows.length;
                    for(var i=0;i<rowCount;i++){
                        var row=table.rows[i];
                        var chkbox=row.cells[4].childNodes[0];
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
                setTotalDirecto();
            }

            function setTotal(){
                var tableTotal = document.getElementById("myTableTotal"); {
                    table = document.getElementById("myTable");
                    row = table.rows.length;
                    var total = 0;
                    for (var i = 1; i < row; i++){
                        total = parseFloat(total) + parseFloat(table.rows[i].cells[2].innerText);
                    };
                    var flotante = parseFloat(total);
                    var resultado = Math.round(flotante*100)/100;
                    tableTotal.rows[0].cells[2].innerHTML = '<input type="hidden" name="total" value="'+ resultado +'"><label>'+ resultado +'</label>';
                }
            }

            function setTotalDirecto(){
                var tableTotal = document.getElementById("myTableTotalDirecto"); {
                    table = document.getElementById("myTableDirecto");
                    row = table.rows.length;
                    var total = 0;
                    for (var i = 1; i < row; i++) {
                        total = parseFloat(total) + parseFloat(table.rows[i].cells[1].innerText);
                    };
                    var flotante = parseFloat(total);
                    var resultado = Math.round(flotante*100)/100;
                    tableTotal.rows[0].cells[1].innerHTML = '<input type="hidden" name="totalDirecto" id="totalDirecto" value="'+ resultado +'"><label>'+ resultado +'</label>';
                }
            }