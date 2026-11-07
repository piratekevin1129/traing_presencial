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

function createCharlas(){
    charlas_data.push({
        id:1,
        ano:2026,
        mes:Number(current_mes),
        fecha:Number(new Date().getDate()),
        dia:0,
        hora:10,
        minutos:30,
        horario:'am',
        facilitador:0,
        sede:0,
        aula:0,
        estudiantes:[]
    })
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
}

///////////////////////////////////////

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