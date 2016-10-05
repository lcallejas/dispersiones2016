            function myCreateFunction() {
            	var table = document.getElementById("myTable"); {
                    var combo1 = document.getElementById("origenSalida"); 
                    var origenSalida = combo1.options[combo1.selectedIndex].text;

                    var combo = document.getElementById("listado"); 
                    var listado = combo.options[combo.selectedIndex].text;
                    var listadoId = document.formulario.listado.value;
                    
                    var montoSalida = document.formulario.montoSalida.value;
                    var bancoSalida = document.formulario.bancoSalida.value;
                    var cuentaSalida = document.formulario.cuentaSalida.value;
                    var checkCuentaFinal = document.formulario.checkCuentaFinal.checked;

                    if(checkCuentaFinal == false){
                        var check = '';
                        var valorCheck = 0;
                    }else{
                        var check = 'checked="checked"';
                        var valorCheck = 1;
                    }

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
                    var cell9 = row.insertCell(8);
                    var cell10 = row.insertCell(9);
                    
                    cell1.innerHTML = '<input type="hidden" name="origenDest[]" value="'+ origenSalida +'"><label>' + origenSalida + '</label>';
                    cell2.innerHTML = '<input type="hidden" name="dispersora[]" value="'+ listadoId +'"><input type="hidden" name="empresaDest[]" value="'+ listado +'"><label>' + listado + '</label>';
                    cell3.innerHTML = '<input type="hidden" name="montoDest[]" value="'+ montoSalida +'"><label>' + montoSalida + '</label>';
                    cell4.innerHTML = '<input type="hidden" name="bancoDest[]" value="'+ bancoSalida +'"><label>' + bancoSalida + '</label>';
                    cell5.innerHTML = '<input type="hidden" name="cuentaDest[]" value="'+ cuentaSalida +'"><label>' + cuentaSalida + '</label>';
                    cell6.innerHTML = '<input type="hidden" name="cuentaFinalDest[]" value="'+ valorCheck +'"><input type="checkbox" onclick="cambiarValorCheck();" '+ check +'>';
                    cell7.innerHTML = '<input type="hidden" name="realizadoDest[]" value="0"><input type="checkbox" name="checkRealizado[]" onclick="cambiarValorCheck()">';
                    cell8.innerHTML = '<input type="text" name="folio[]"" value="">';
                    cell9.innerHTML = '<input type="hidden" name="pdfAntDisp[]" value=""><input type="file" name="pdfDisp[]">';
                    cell10.innerHTML = '<input type="checkbox">';

                    document.getElementById("listado").value = "Seleccion";
                    document.getElementById("montoSalida").value = "";
                    document.getElementById("bancoSalida").value = "";
                    document.getElementById("cuentaSalida").value = "";
                    document.getElementById("checkCuentaFinal").checked = false;
            	}
                setTotal();
        	}

            function myDeleteFunction() {
                try{
                    var table=document.getElementById("myTable");
                    var rowCount=table.rows.length;
                    for(var i=0;i<rowCount;i++){
                        var row=table.rows[i];
                        var chkbox=row.cells[9].childNodes[0];
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

            function myCreateFunctionSimple() {
                var table = document.getElementById("myTableSimple"); {
                    var combo1 = document.getElementById("listado1"); 
                    var listado1 = combo1.options[combo1.selectedIndex].text;
                    var listado1Id = document.formulario.listado1.value;
                    
                    var montoEntrada = document.formulario.montoEntrada.value;
                    var bancoEntrada = document.formulario.bancoEntrada.value;
                    var cuentaEntrada = document.formulario.cuentaEntrada.value;

                    var row = table.insertRow(table.rows.length);
                    var filas = table.rows.length - 2;
                    
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    var cell6 = row.insertCell(5);
                    
                    cell1.innerHTML = '<input type="hidden" name="idEnt[]" value="0"><input type="hidden" name="idEmp[]" value="'+ listado1Id +'"><label>' + listado1 + '</label>';
                    cell2.innerHTML = '<input type="hidden" name="montoEnt[]" value="'+ montoEntrada +'"><label>' + montoEntrada + '</label>';
                    cell3.innerHTML = '<input type="hidden" name="bancoEnt[]" value="'+ bancoEntrada +'"><label>' + bancoEntrada + '</label>';
                    cell4.innerHTML = '<input type="hidden" name="cuentaEnt[]" value="'+ cuentaEntrada +'"><label>' + cuentaEntrada + '</label>';
                    cell5.innerHTML = '<input type="hidden" name="realizadoEnt[]" value="0"><input type="checkbox" onclick="cambiarValorCheck2();">';
                    cell6.innerHTML = '<input type="checkbox">';

                    document.getElementById("listado1").value = "Seleccion";
                    document.getElementById("montoEntrada").value = "";
                    document.getElementById("bancoEntrada").value = "";
                    document.getElementById("cuentaEntrada").value = "";
                }
                setTotalNominas();
            }

            function myDeleteFunctionSimple() {
                try{
                    var table=document.getElementById("myTableSimple");
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
            function myCreateFunctionFinal() {
                var table = document.getElementById("myTableFinal"); {
                    var paraDestino = document.formulario.paraFinal.value;

                    var combo2 = document.getElementById("tipoTransFinal"); 
                    var tipoTransDestino = combo2.options[combo2.selectedIndex].text; 
                    var tipoTransDestinoId = document.formulario.tipoTransFinal.value;
                    
                    var montoDestino = document.formulario.montoFinal.value;
                    var bancoDestino = document.formulario.bancoFinal.value;
                    var cuentaDestino = document.formulario.cuentaFinal.value;
                    var comentarioDestino = document.formulario.comentarioFinal.value;

                    if(paraDestino == ""){
                        alert("Debes ingresa una empresa/cliente destino.");
                    }else if(tipoTransDestinoId == "Seleccion"){
                        alert("Selecciona un tipo de transferencia.");
                    }else if(montoDestino == ""){
                        alert("Debes ingresa un monto.");
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

                        cell1.innerHTML = '<input type="hidden" name="idParaDestino[]"><input type="hidden" name="paraDestino[]" value="'+ paraDestino +'"><label>' + paraDestino + '</label>';
                        cell2.innerHTML = '<input type="hidden" name="tipoTransDestino[]" value="'+ tipoTransDestinoId +'"><label>' + tipoTransDestino + '</label>';
                        cell3.innerHTML = '<input type="hidden" name="montoDestino[]" value="'+ montoDestino +'"><label>' + montoDestino + '</label>';
                        cell4.innerHTML = '<input type="hidden" name="bancoDestino[]" value="'+ bancoDestino +'"><label>' + bancoDestino + '</label>';
                        cell5.innerHTML = '<input type="hidden" name="cuentaDestino[]" value="'+ cuentaDestino +'"><label>' + cuentaDestino + '</label>';
                        cell6.innerHTML = '<input type="hidden" name="comentarioDestino[]" value="'+ comentarioDestino +'"><label>' + comentarioDestino + '</label>';
                        cell7.innerHTML = '<td class="botnMov"><input type="hidden" name="pdfAnt[]" value=""><input type="file" name="pdf[]">';
                        cell8.innerHTML = '<input type="checkbox">';

                        document.getElementById("paraFinal").value = "";
                        document.getElementById("tipoTransFinal").value = "Seleccion";
                        document.getElementById("montoFinal").value = "";
                        document.getElementById("bancoFinal").value = "";
                        document.getElementById("cuentaFinal").value = "";
                        document.getElementById("comentarioFinal").value = "";
                    }

                }
                setTotalFinal();
            }

            function myDeleteFunctionFinal() {
                try{
                    var table=document.getElementById("myTableFinal");
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

            function setTotal(){
                var tableTotal = document.getElementById("myTableTotal"); {
                    table = document.getElementById("myTable");
                    row = table.rows.length;
                    var total = 0;
                    for (var i = 1; i < row; i++) {
                        //Verifica si la empresa es dispersora para poder sumar su monto.
                        if(table.rows[i].cells[1].children[0].value == 1 || table.rows[i].cells[5].children[1].checked == true){
                            total = parseFloat(total) + parseFloat(table.rows[i].cells[2].innerText);
                        }
                    };
                    var flotante = parseFloat(total);
                    var resultado = Math.round(flotante*100)/100;
                    tableTotal.rows[0].cells[2].innerHTML = '<input type="hidden" name="total" value="'+ resultado +'"><label>'+ resultado +'</label>';
                }
            }

            function setTotalSimple(){
                var tableTotal = document.getElementById("myTableTotalSimple"); {
                    table = document.getElementById("myTableSimple");
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

            function setTotalFinal(){
                var tableTotal = document.getElementById("myTableTotalFinal"); {
                    table = document.getElementById("myTableFinal");
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

            function cambiarValorCheck() {
                var table=document.getElementById("myTable");
                var rowCount=table.rows.length;
                for(var i=0;i<rowCount;i++){
                    var row=table.rows[i];
                    var chkbox=row.cells[5].childNodes[1];
                    if(null!=chkbox&&true==chkbox.checked){
                        row.cells[5].childNodes[0].value = 1;
                    }else{
                        row.cells[5].childNodes[0].value = 0;
                    }

                    var chkbox2=row.cells[6].childNodes[1];
                    if(null!=chkbox2&&true==chkbox2.checked){
                        row.cells[6].childNodes[0].value = 1;
                    }else{
                        row.cells[6].childNodes[0].value = 0;
                    }
                }
                setTotal();
            }

            function cambiarValorCheck2() {
                var table=document.getElementById("myTableSimple");
                var rowCount=table.rows.length;
                for(var i=0;i<rowCount;i++){
                    var row=table.rows[i];
                    var chkbox=row.cells[4].childNodes[1];
                    if(null!=chkbox&&true==chkbox.checked){
                        row.cells[4].childNodes[0].value = 1;
                    }else{
                        row.cells[4].childNodes[0].value = 0;
                    }
            }
        }