function getCharlaId(id){
    var ind = -1
    for(var c = 0;c<charlas_data.length;c++){
        if(charlas_data[c].id==id){
            ind = c
        }
    }
    return ind
}

function createCharlas(charlas){
    var hora_modal_val = getE('hora-modal-inp').value
    var minutos_modal_val = getE('minutos-modal-inp').value
    var horario_modal_val = getE('horario-modal-sel').value
    var facilitador_modal_val = getE('facilitador-modal-sel').value
    var sede_modal_val = getE('sede-modal-sel').value
    var aula_modal_val = getE('aula-modal-sel').value

    for(i = 0;i<charlas.length;i++){
        charlas_data.push({
            id:(i+1),
            id_curso:0,
            ano:Number(current_year),
            mes:parseInt(current_mes),
            fecha:parseInt(charlas[i].date),
            dia:parseInt(charlas[i].day),
            hora:parseInt(hora_modal_val),
            minutos:parseInt(minutos_modal_val),
            horario:horario_modal_val,
            facilitador:parseInt(facilitador_modal_val),
            sede:parseInt(sede_modal_val),
            aula:parseInt(aula_modal_val),
            estudiantes:[]
        })
    }
    for(i = 0;i<charlas_data.length;i++){
        getE('calendario-date-'+charlas_data[i].fecha).className = 'dia-escogido'
        getE('calendario-date-'+charlas_data[i].fecha).getElementsByClassName('calendario-date-btn2')[0].setAttribute('onclick','verCharla('+charlas_data[i].id+')')
    }

    verCharla(1)
}

function addCharla(dd){
    //limpiar formularios
    getE('calendario-data-form').reset()
    getE('tabla-usuarios-form').reset()

    //agregar
    var id = (charlas_data.length+1)
    var dia_semana = new Date(
        String('2026-'+meses[current_mes].f+'-'+dd)
    ).getDate()
    charlas_data.push({
        id:id,
        id_curso:0,
        ano:Number(current_year),
        mes:current_mes,
        fecha:dd,
        dia:dia_semana,
        hora:10,
        minutos:30,
        horario:'am',
        facilitador:0,
        sede:0,
        aula:0,
        estudiantes:[]
    })

    current_charla = charlas_data.length-1
    getE('calendario-date-'+dd).getElementsByClassName('calendario-date-btn2')[0].setAttribute('onclick','verCharla('+id+')')

    activateCharla(dd,'escogido')
    getE('calendario-data-options').className = 'calendario-data-option-eliminar'
}

function verCharla(id){
    //limpiar formularios
    getE('calendario-data-form').reset()
    getE('tabla-usuarios-form').reset()

    //asignar valores a los form, en base al que le acaba de dar click
    current_charla = getCharlaId(id)
    if(current_charla!=-1){
        getE('minutos-inp').value = charlas_data[current_charla].minutos
        getE('hora-inp').value = charlas_data[current_charla].hora
        getE('horario-sel').value = charlas_data[current_charla].horario
        getE('facilitador-sel').value = charlas_data[current_charla].facilitador
        getE('sede-sel').value = charlas_data[current_charla].sede

        updateAulasMain(getE('sede-sel'))
        getE('aula-sel').value = charlas_data[current_charla].aula

        //asignar estudiantes
        for(i = 0;i<charlas_data[current_charla].estudiantes.length;i++){
            getE('usuario-check-'+charlas_data[current_charla].estudiantes[i]).checked = true;
        }
    }

    activateCharla(charlas_data[current_charla].fecha,'escogido')
    getE('calendario-data-options').className = 'calendario-data-option-eliminar'
}

function activateCharla(dd,status){
    //mirar si hay uno activo y ponerle la clase de escogido
    if(current_date_selected!=0){
        getE('calendario-date-'+current_date_selected).className = 'dia-'+current_date_status
    }

    //poner visible tabla del calendario
    getE('calendario-data').className = 'calendario-data-on'
    //poner visible tabla de los usuarios
    getE('curso-presencial-usuarios').className = 'content-visible'

    current_date_selected = dd
    current_date_status = status
    getE('calendario-date-'+dd).className = 'dia-seleccionado'
    getE('estudiantes-charla-txt').innerHTML = String(dd+' de '+meses[current_mes].m)
}

function eliminarCharla(){
    //var ind = getCharlaId(current_date_selected)
    getE('calendario-date-'+current_date_selected).getElementsByClassName('calendario-date-btn2')[0].removeAttribute('onclick')
    getE('calendario-date-'+current_date_selected).className = 'dia-normal'
    if(current_charla!=-1){
        charlas_data.splice(current_charla,1)
    }
    getE('calendario-data').className = 'calendario-data-off'
    getE('curso-presencial-usuarios').className = 'content-hidden'
    getE('calendario-data-form').reset()
    getE('tabla-usuarios-form').reset()
    current_date_selected = 0
    current_date_status = ''
    current_charla = -1
}

function eliminarTodo(){
    //eliminar todo
    for(i = 0;i<charlas_data.length;i++){
        getE('calendario-date-'+charlas_data[i].fecha).getElementsByClassName('calendario-date-btn2')[0].removeAttribute('onclick')
        getE('calendario-date-'+charlas_data[i].fecha).className = 'dia-normal'
    }

    getE('calendario-data').className = 'calendario-data-off'
    getE('curso-presencial-usuarios').className = 'content-hidden'
    getE('calendario-data-form').reset()
    getE('tabla-usuarios-form').reset()
    current_date_selected = 0
    current_date_status = ''
    current_charla = -1
    charlas_data.length = 0
    charlas_data = []

    getE('repetir-curso-check').disabled = false
    getE('repetir-curso-check').checked = false
    getE('repetir-curso-switch').className = 'switch'
    getE('reptir-curso-form').reset()
}

/************************************************/

function guardarCurso(btn){
    //btn.disabled = true
    
    var nombre_val = getE('nombre-inp').value
    var descripcion_val = getE('descripcion-inp').value
    var tiempo_inp = getE('tiempo-inp').value
    var tiempo2_sel = getE('tiempo2-sel').value
    var encargados_list = getDropdownItems('dropdown-encargado')
    var imagen_val = getE('imagen-inp')

    if(
        is_empty(nombre_val)||
        imagen_val.files.length<=0||
        charlas_data.length==0
    ){
        openModalAlert({
            status:'warning',
            title:'Campos sin diligenciar',
            text:'Por favor asegúrate de diligenciar:<br>• Un nombre<br>• Una imagen<br>•Una fecha mínimo para el curso'
        })
    }else{
        setLoader()
        $.ajax({
            method: 'POST',
            url: base+'api/controllers/courses.php?action=saveCourses',
            data: {
                nombre:nombre_val,
                descripcion:descripcion_val,
                tiempo:parseInt(tiempo_inp),
                tiempo2:tiempo2_sel,
                encargados:JSON.stringify(encargados_list),
                charlas:JSON.stringify(charlas_data)
            },
            success: function(response){
                var response_data = JSON.parse(response)
                if(response_data.status=='success'){
                    //guardar usuarios registrados
                    guardarCurso2(response_data.data)
                }else{
                    unsetLoader()
                    openModalAlert({
                        status:'warning',
                        title:'Algo salió mal',
                        text:'No se pudo guardar el curso'
                    })
                }
            },
            error: function(xhr, status, error){
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'Ocurrió un error tratando de guardar el curso'
                })
            }
        })
    }


}

function guardarCurso2(ids_collection){
    var collection = []
    for(i = 0;i<charlas_data.length;i++){
        var users = []
        for(j = 0;j<charlas_data[i].estudiantes.length;j++){
            users.push(charlas_data[i].estudiantes[j])
        }
        collection.push({
            id:ids_collection[i],
            users:users
        })
    }
    $.ajax({
        method: 'POST',
        url: base+'api/controllers/courses_users.php?action=saveCoursesUsers',
        data: {
            datos:JSON.stringify(collection),
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                //guardar QRS
                guardarCurso3(ids_collection)
            }else{
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'No se pudo matricular a los estudiantes'
                })
            }
        },
        error: function(xhr, status, error){
            unsetLoader()
            openModalAlert({
                status:'warning',
                title:'Algo salió mal',
                text:'Ocurrió un error tratando de matricular a los estudiantes'
            })
        }
    })
}

function guardarCurso3(ids_collection){
    //guardar QR
    $.ajax({
        method: 'POST',
        url: base+'api/controllers/courses.php?action=saveCoursesQR',
        data:{
            ids:JSON.stringify(ids_collection)
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                //guardar imagen
                getE('curso_ids').value = ids_collection[0]
                guardarCurso4()
            }else{
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'No se pudo generar el código QR de los cursos'
                })
            }
        },
        error: function(xhr, status, error){
            unsetLoader()
            openModalAlert({
                status:'warning',
                title:'Algo salió mal',
                text:'Ocurrió un error generando el código QR de los cursos'
            })
        }
    })
}

function guardarCurso4(){
    var datosimagen = new FormData(getE('curso-img-form'));

    $.ajax({
        url: base+'api/controllers/courses.php?action=saveCoursesImage',
        type: 'POST',
        data: datosimagen,
        contentType: false,
        processData: false,
        success: function(response) {
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                unsetLoader()
                openModalAlert({status:'success',title:'Curso creado con éxito!',text:'Ya puedes ir a la sección de curso y descargar los códigos QR para la asistencia y finalización'})
            }else{
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'No se pudo guardar la imagen del curso'
                })
            }
        },
        error: function(xhr, status, error) {
            unsetLoader()
            openModalAlert({
                status:'warning',
                title:'Algo salió mal',
                text:'Ocurrió un error guardando la imagen del curso'
            })
        }
    });
}

var facilitadores_charla = []

function enviarCorreoFacilitadores(){
    for(i = 0;i<charlas_data.length;i++){
        var f_id = charlas_data[i].facilitador
        var f_ind = -1

        var sede_ind = findSede(charlas_data[i].sede)
        var aula_ind = findAula(charlas_data[i].aula)
        var sede_data = []
        var aula_data = []
        var dir = {sede:0,aula:0}
        var dat = {a:0,m:0,d:0,h:0,i:0,s:"00"}
        var det = {a:0,m:0,d:0,h:0,i:0,s:"00"}

        if(sede_ind==-1||aula_ind==-1){
            sede_data = sedes_data[sede_ind]
            aula_data = aulas_data[aula_ind]
            dir.sede = sede_data.id
            dir.aula = aula_data.id
        }
        var ano = charlas_data[i].ano
        dat.a = String(ano)

        var mes = (Number(charlas_data[i].mes)+1)
        var m = String(mes)
        if(mes<10){
            m = String('0'+mes)
        }
        dat.m = m

        var dia = charlas_data[i].fecha
        var d = String(dia)
        if(dia<10){
            d = String('0'+dia)
        }
        dat.d = d
        
        var hora = charlas_data[i].hora
        if(charlas_data[i].horario=='pm'){
            hora+=12
        }
        var h = String(hora)
        if(hora<10){
            h = String('0'+hora)
        }
        dat.h = h

        var minuto = charlas_data[i].minutos
        var mm = String(minuto)
        if(minuto<10){
            mm = String('0'+minuto)
        }
        dat.i = mm

        //chanchullo feo
        var fecha_fin = new Date(String(ano+"-"+m+"-"+d+" "+h+":"+mm+":00"))
        if(getE('tiempo2-sel').value=='horas'){
            fecha_fin.setHours(fecha_fin.getHours() + Number(getE('tiempo-inp').value))
        }else{
            fecha_fin.setMinutes(fecha_fin.getMinutes() + Number(getE('tiempo-inp').value))
        }
        det.a = String(fecha_fin.getFullYear())
        var mes2 = Number(fecha_fin.getMonth()+1)
        if(mes2<10){
            det.m = String('0'+mes2)
        }else{
            det.m = String(mes2)
        }
        var dia2 = fecha_fin.getDate()
        if(dia2<10){
            det.d = String('0'+dia2)
        }else{
            det.d = String(dia2)
        }
        var hora2 = fecha_fin.getHours()
        if(hora2<10){
            det.h = String('0'+hora2)
        }else{
            det.h = String(hora2)
        }
        var minuto2 = fecha_fin.getMinutes()
        if(minuto2<10){
            det.i = String('0'+minuto2)
        }else{
            det.i = String(minuto2)
        }

        for(j = 0;j<facilitadores_charla.length;j++){
            if(facilitadores_charla[j].f==f_id){
                f_ind = j
                break;
            }
        }

        if(f_ind==-1){
            //agregar
            facilitadores_charla.push({
                f:f_id,
                t:String(getE('nombre-inp').value),
                ch:[{
                    dir:dir,
                    dat:dat,
                    det:det
                }]
            })
        }else{
            facilitadores_charla[f_ind].ch.push({
                dir:dir,
                dat:dat,
                det:det
            })
        }
    }

    $.ajax({
        method: 'POST',
        action: base+'api/controllers/mail.php?action=agendarFacilitador',
        data:{
            datos:JSON.stringify(facilitadores_charla)
        },
    })
    //console.log(facilitadores_charla)
}