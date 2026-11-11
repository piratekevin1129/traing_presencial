function clickConfirmarIngreso(c){
    if(!confirming_entry){
        //poner ingreso en ready
        setButtonIngresoLoading()
        confirming_entry = true
    
        $.ajax({
            method: 'POST',
            url: base+'api/controllers/student.php?action=confirmEntry',
            success: function(response){
                var response_data = JSON.parse(response)
                if(response_data.status=='success'){
                    setButtonIngresoReady()
                    openModalAlert({
                        status:'success',
                        title:'Ingreso confirmado',
                        text:'Hora de ingreso: '+response_data.data.horaentrada
                    })
                }else{
                    openModalAlert({
                        status:'warning',
                        title:'¡Algo salió mal!',
                        text:"Ocurrió un error confirmando el ingreso"
                    });
                    setButtonIngresoDefault()
                }
                confirming_entry = false
            },
            error: function(xhr, status, error) {
                console.log("Error de servidor");
                console.log(xhr);
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo confirmar el ingreso"
                });
                setButtonIngresoDefault()
                confirming_entry = false
            }
        })
    }
}

function clickConfirmarSalida(c){
    if(!confirming_entry){
        //poner ingreso en ready
        setButtonSalidaLoading()
        confirming_entry = true
    
        $.ajax({
            method: 'POST',
            url: base+'api/controllers/student.php?action=confirmExit',
            success: function(response){
                var response_data = JSON.parse(response)
                if(response_data.status=='success'){
                    setButtonSalidaReady()
                    openModalAlert({
                        status:'success',
                        title:'Salida confirmada',
                        text:'Hora de salida: '+response_data.data.horasalida
                    })
                }else{
                    openModalAlert({
                        status:'warning',
                        title:'¡Algo salió mal!',
                        text:"Ocurrió un error confirmando la salida"
                    });
                    setButtonSalidaDefault()
                }
                confirming_entry = false
            },
            error: function(xhr, status, error) {
                console.log("Error de servidor");
                console.log(xhr);
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo confirmar la salida"
                });
                setButtonSalidaDefault()
                confirming_entry = false
            }
        })
    }
}

/////////////////////////////////

function checkIngresoSalida(){
    $.ajax({
        method: 'POST',
        url: base+'api/controllers/student.php?action=checkStatus',
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                //console.log(response_data.data)
                if(response_data.data.status==0){
                    //usuario sin ingresar
                    setButtonIngresoDefault()
                    getE('hora-ingreso-txt').innerHTML = 'Hora de ingreso: ...'
                }else if(response_data.data.status==1){
                    //usuario ya confirmó ingreso
                    if(course_status==1){
                        //pero el curso aun no acaba
                        setButtonIngresoReady()
                        getE('hora-ingreso-txt').innerHTML = 'Hora de ingreso: '+response_data.data.horaentrada
                    }else if(course_status==2){
                        //el curso ya acabó, puede finalizar
                        setButtonSalidaDefault()
                        getE('hora-salida-txt').innerHTML = 'Hora de salida: ...'
                    }
                }else if(response_data.data.status==2){
                    //el usuario ya confirmó salida
                    setButtonSalidaFinalizado()
                    getE('hora-salida-txt').innerHTML = 'Hora de salida: '+response_data.data.horasalida
                }
            }else{
                //los botones se quedan cargando
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"Ocurrió un error verificando el ingreso"
                });
            }
            confirming_entry = false
        },
        error: function(xhr, status, error) {
            console.log("Error de servidor");
            console.log(xhr);
            //los botones se quedan cargando
            openModalAlert({
                status:'warning',
                title:'¡Algo salió mal!',
                text:"No se pudo verificar el ingreso"
            });
            confirming_entry = false
        }
    })
}

function setButtonIngresoReady(){
    ingreso_btn.className = 'ready'
    ingreso_btn.disabled = true
    ingreso_btn.removeAttribute('onclick')
    ingreso_btn.innerHTML = '<span>Ingreso confirmado</span><div></div>'
}
function setButtonSalidaReady(){
    salida_btn.className = 'ready'
    salida_btn.disabled = true
    salida_btn.removeAttribute('onclick')
    salida_btn.innerHTML = '<span>Salida confirmada</span><div></div>'
}
function setButtonIngresoLoading(){
    ingreso_btn.className = 'loading'
    ingreso_btn.disabled = true
    ingreso_btn.innerHTML = '<span>Espere</span><div></div>'
}
function setButtonSalidaLoading(){
    salida_btn.className = 'loading'
    salida_btn.disabled = true
    salida_btn.innerHTML = '<span>Espere</span><div></div>'
}

function setButtonIngresoDefault(){
    ingreso_btn.className = 'unlocked'
    ingreso_btn.setAttribute('onclick','clickConfirmarIngreso('+course_id+'')
    ingreso_btn.disabled = false
    ingreso_btn.innerHTML = '<span>Confirmar ingreso</span><div></div>'
}
function setButtonSalidaDefault(){
    salida_btn.className = 'unlocked'
    salida_btn.setAttribute('onclick','clickConfirmarSalida('+course_id+')')
    salida_btn.disabled = false
    salida_btn.innerHTML = '<span>Confirmar salida</span><div></div>'
}

function setButtonSalidaFinalizado(){
    salida_btn.className = 'ready'
    salida_btn.innerHTML = '<span>Curso finalizado</span><div></div>'
    salida_btn.disabled = true
    salida_btn.removeAttribute('onclick')
}