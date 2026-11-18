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
    for(var m = 0;m<charlas_data[current_charla].estudiantes.length;m++){
        if(charlas_data[current_charla].estudiantes[m]==inpu.value){
            pos_u = m
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

    //console.log(charlas_data[current_charla].estudiantes)
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

function clickContenido(c){
    getE('step-container-1').className = 'step-item'
    getE('step-container-2').className = 'step-item'
    getE('step-container-'+c).className = 'step-item selected'

    getE('step-body-container-1').className = 'step-container-off'
    getE('step-body-container-2').className = 'step-container-off'

    getE('step-body-container-'+c).className = 'step-container-on'
}

var contenidos_data = [{
    id:1,
    nombre:"",
    file:false
}]

function findContenido(id){
    var indx = -1
    for(var c = 0;c<contenidos_data.length;c++){
        if(contenidos_data[c].id==id){
            indx = c
        }
    }
    return indx
}

function agregarContenido(){
    var div = document.createElement('div')
    div.className = 'row-material'
    
    var new_id = (contenidos_data[contenidos_data.length-1].id)+1
    div.id = 'contenido-content-'+new_id

    var h = ""
    h+='<div class="col-material">'
        h+='<div class="input">'
            h+='<input id="contenido-inp-'+new_id+'" name="contenido-inp-'+new_id+'" placeholder="Nombre del tema" type="text" maxlength="100" autocomplete="off" />'
            h+='<label>Mínimo 3 máximo 100 caracteres</label>'
        h+='</div>'
    h+='</div>'
    h+='<div class="col-material">'
        h+='<div class="file">'
            h+='<input id="material-inp-'+new_id+'" type="file" name="material-inp-'+new_id+'" accept=".png,.jpeg,.jpg,.pdf,.mp4" onchange="updateFileContent('+new_id+',this,event)" />'
            h+='<p>Selecciona un archivo</p>'
            h+='<div></div>'
        h+='</div>'
        h+='<label class="file-label">Formatos permitidos: Imagen, Video, PDF</label>'
    h+='</div>'
    h+='<button class="eliminar-contenido-btn" type="button" onclick="eliminarMaterial('+new_id+')">'
        h+='<img src="'+base+'public/curso-crear/images/clear2-icon.svg" />'
    h+='</button>'
    
    div.innerHTML = h

    getE('contenidos-content').appendChild(div)
    contenidos_data.push({
        id:new_id,
        nombre:"",
        file:false
    })
}

function updateFileContent(id,inpu,event){
    var indx = findContenido(id)
    if(indx>-1){
        contenidos_data[indx].file = true
    }
    var input_parent = inpu.parentNode
    var fakepath = inpu.value
    input_parent.getElementsByTagName('p')[0].innerHTML = fakepath
}

function eliminarMaterial(id){
    //mirar si es el ultimo
    if(contenidos_data.length==1){
        openModalAlert({
            status:'warning',
            title:'No puedes!',
            text:'Debes dejar al menos 1 contenido'
        })
    }else{
        var indx = findContenido(id)
        if(indx>-1){
            contenidos_data.splice(indx,1)
        }
    
        getE('contenidos-content').removeChild(getE('contenido-content-'+id))
    }
}