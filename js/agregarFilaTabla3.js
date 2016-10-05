            function myCreateFunction() {
            	var table = document.getElementById("myTable"); {
                    var paraDestino = document.formulario.paraDestino.value;
                    
                    var combo1 = document.getElementById("tipoTransDestino"); 
                    var tipoTransDestino = combo1.options[combo1.selectedIndex].text;
                    var tipoTransDestinoId = document.formulario.tipoTransDestino.value;

            		var montoDestino = document.formulario.montoDestino.value;
                    var bancoDestino = document.formulario.bancoDestino.value;
                    var cuentaDestino = document.formulario.cuentaDestino.value;

                    if(paraDestino == ""){
                        alert("Debes ingresa una empresa/cliente destino.");
                    }else if(tipoTransDestinoId == "Seleccion"){
                        alert("Selecciona un tipo de transferencia.");
                    }else if(montoDestino == ""){
                        alert("Debes ingresa un monto destino.");
                    }else{

                	    var row = table.insertRow(table.rows.length);
                        var filas = table.rows.length - 2;
                	
                        var cell1 = row.insertCell(0);
                	    var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);
                	
                        cell1.innerHTML = '<input type="hidden" name="paraDest[]" value="'+ paraDestino +'"><label>' + paraDestino + '</label>';
                        cell2.innerHTML = '<input type="hidden" name="tipoTransDest[]" value="'+ tipoTransDestinoId +'"><label>' + tipoTransDestino + '</label>';
                	    cell3.innerHTML = '<input type="hidden" name="montoDest[]" value="'+ montoDestino +'"><label>' + montoDestino + '</label>';
                        cell4.innerHTML = '<input type="hidden" name="bancoDest[]" value="'+ bancoDestino +'"><label>' + bancoDestino + '</label>';
                        cell5.innerHTML = '<input type="hidden" name="cuentaDest[]" value="'+ cuentaDestino +'"><label>' + cuentaDestino + '</label>';
                        cell6.innerHTML = '<input type="checkbox">';

                        document.getElementById("paraDestino").value = "";
                        document.getElementById("tipoTransDestino").value = "Seleccion";
                	    document.getElementById("montoDestino").value = "";
                        document.getElementById("bancoDestino").value = "";
                        document.getElementById("cuentaDestino").value = "";
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
                        var chkbox=row.cells[5].childNodes[0];
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

            function myCreateFunctionNominas() {
                var table = document.getElementById("myTableNominas"); {
                    var combo1 = document.getElementById("listado1"); 
                    var listado1 = combo1.options[combo1.selectedIndex].text;
                    var listado1Id = document.formulario.listado1.value;
                    
                    var montoEntrada = document.formulario.montoEntrada.value;
                    var bancoEntrada = document.formulario.bancoEntrada.value;
                    var cuentaEntrada = document.formulario.cuentaEntrada.value;
                    var comentarioEntrada = document.formulario.comentarioEntrada.value;

                    if(listado1Id == "Seleccion"){
                        alert("Debes elegir una empresa destino.");
                    }else if(montoEntrada == ""){
                        alert("Debes ingresar un monto de entrada.");
                    }else if(bancoEntrada == ""){
                        alert("Debes ingresar un banco de entrada.");
                    }else{

                        var row = table.insertRow(table.rows.length);
                        var filas = table.rows.length - 2;
                    
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);
                    
                        cell1.innerHTML = '<input type="hidden" name="empEnt[]" value="'+ listado1Id +'"><input type="hidden" name="empresaEnt[]" value="'+ listado1 +'"><label>' + listado1 + '</label>';
                        cell2.innerHTML = '<input type="hidden" name="montoEnt[]" value="'+ montoEntrada +'"><label>' + montoEntrada + '</label>';
                        cell3.innerHTML = '<input type="hidden" name="bancoEnt[]" value="'+ bancoEntrada +'"><label>' + bancoEntrada + '</label>';
                        cell4.innerHTML = '<input type="hidden" name="cuentaEnt[]" value="'+ cuentaEntrada +'"><label>' + cuentaEntrada + '</label>';
                        cell5.innerHTML = '<input type="hidden" name="comentarioEnt[]" value="'+ comentarioEntrada +'"><label>' + comentarioEntrada + '</label>';
                        cell6.innerHTML = '<input type="checkbox">';

                        document.getElementById("listado1").value = "Seleccion";
                        document.getElementById("montoEntrada").value = "";
                        document.getElementById("bancoEntrada").value = "";
                        document.getElementById("cuentaEntrada").value = "";
                        document.getElementById("comentarioEntrada").value = "";
                    }
                }
                setTotalNominas();
            }

            function myDeleteFunctionNominas() {
                try{
                    var table=document.getElementById("myTableNominas");
                    var rowCount=table.rows.length;
                    for(var i=0;i<rowCount;i++){
                        var row=table.rows[i];
                        var chkbox=row.cells[5].childNodes[0];
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
                setTotalNominas();
            }
            function setTotal(){
                var tableTotal = document.getElementById("myTableTotal"); {
                    table = document.getElementById("myTable");
                    row = table.rows.length;
                    var total = 0;
                    for (var i = 1; i < row; i++) {
                        total = parseFloat(total) + parseFloat(table.rows[i].cells[2].innerText);
                    };
                    var flotante = parseFloat(total);
                    var resultado = Math.round(flotante*100)/100;
                    tableTotal.rows[0].cells[2].innerHTML = '<input type="hidden" name="total" value="'+ resultado +'"><label>'+ resultado +'</label>';
                }
            }
            function setTotalNominas(){
                var tableTotal = document.getElementById("myTableTotalNominas"); {
                    table = document.getElementById("myTableNominas");
                    row = table.rows.length;
                    var total = 0;
                    for (var i = 1; i < row; i++) {
                        total = parseFloat(total) + parseFloat(table.rows[i].cells[1].innerText);
                    };
                    var flotante = parseFloat(total);
                    var resultado = Math.round(flotante*100)/100;
                    tableTotal.rows[0].cells[1].innerHTML = '<input type="hidden" name="totalNominas" value="'+ resultado +'"><label>'+ resultado +'</label>';
                }
            }