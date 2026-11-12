var charlas_data = []
var current_date_selected = 0
var current_date_status = ''
var current_charla = -1

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