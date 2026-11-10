var charlas_data = []

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

var current_date_selected = 0
var current_date_status = ''
var current_charla = -1

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
        ano:2026,
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

function updateAulasMain(inpu){
    getE('aula-sel').innerHTML = updateAulas2(inpu.value)
    charlas_data[current_charla].sede = Number(inpu.value)
}

function updateAulasModal(inpu){
    getE('aula-modal-sel').innerHTML = updateAulas2(inpu.value)
}

function updateAulas2(inpu){
    var h = '<option value="0" selected>Selecciona</option>'
    for(i = 0;i<aulas_data.length;i++){
        if(aulas_data[i].sedeid==Number(inpu)){
            h+='<option value="'+aulas_data[i].id+'">'+aulas_data[i].nombre+'</option>'
        }
    }
    return h
}

//funciones de guardado en caliente

function updateHora(inpu){
    charlas_data[current_charla].hora = Number(inpu.value)
}
function updateMinutos(inpu){
    charlas_data[current_charla].minutos = Number(inpu.value)
}
function updateHorario(inpu){
    charlas_data[current_charla].horario = inpu.value
}
function updateFacilitador(inpu){
    charlas_data[current_charla].facilitador = Number(inpu.value)
}
function updateAula(inpu){
    charlas_data[current_charla].aula = Number(inpu.value)
}

function matricularUsuario(inpu){
    var pos_u = -1
    for(i = 0;i<charlas_data[current_charla].estudiantes.length;i++){
        if(charlas_data[current_charla].estudiantes[i]==inpu.value){
            pos_u = i
            break;
        }
    }
    
    if(pos_u==-1){
        //no está, agregar solo si se checkea el input
        if(inpu.checked){
            charlas_data[current_charla].estudiantes.push(inpu.value)
        }
    }else{
        //ya esta, quitar solo si se descheckea el input
        if(!inpu.checked){
            charlas_data[current_charla].estudiantes.splice(pos_u,1)
        }
    }
}

function updateCourseImage(event){
    var file = event.target.files[0];

    if (file) {
        // 2. Create a temporary local object URL
        var objectURL = URL.createObjectURL(file);

        // 3. Set it as the source of the image tag and display it
        getE('imagen-curso-img').src = objectURL;
        getE('imagen-curso-img').className = 'imagen-curso-img-on'
    }
}

/************************************************/

function guardarCurso(btn){
    //btn.disabled = true
    setLoader()

    var nombre_val = getE('nombre-inp').value
    var descripcion_val = getE('descripcion-inp').value
    var tiempo_inp = getE('tiempo-inp').value
    var tiempo2_sel = getE('tiempo2-sel').value
    var encargados_list = getDropdownItems('dropdown-encargado')

    $.ajax({
        method: 'POST',
        url: base+'api/controllers/courses.php?action=saveCourses',
        data: {
            nombre:nombre_val,
            descripcion:descripcion_val,
            tiempo:tiempo_inp,
            tiempo2:tiempo2_sel,
            encargados:JSON.stringify(encargados_list),
            charlas:JSON.stringify(charlas_data)
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                //openModalAlert({status:'success',title:'Curso creado con éxito!',text:'Ya puedes ir a la sección de curso y descargar los códigos QR para la asistencia y finalización'})
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
            unsetLoader()
            if(response_data.status=='success'){
                openModalAlert({status:'success',title:'Curso creado con éxito!',text:'Ya puedes ir a la sección de curso y descargar los códigos QR para la asistencia y finalización'})
            }else{
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