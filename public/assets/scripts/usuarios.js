function updateCursoFile(inpu){
    updateFileInput(inpu)
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-on'
}

function addCursoList(ind,list){
    var course_div = document.createElement('div')
    course_div.className = 'modal-curso-preview'
    course_div.id = 'modal-curso-preview-'+cursos_data[ind].id+'_'+list
    var h = ''
    h+='<div class="modal-curso-preview-img">'
        h+='<img src="./public/assets/images/cursos/'+cursos_data[ind].img+'" />'
    h+='</div>'
    h+='<div class="modal-curso-preview-info">'
        h+='<p id="modal-curso-name-txt">'+cursos_data[ind].nombre+'</p>'
        h+='<div>'
            h+='<button><img src="./public/assets/images/modal/time-modal-icon.svg" /></button>'
            h+='<button><img src="./public/assets/images/modal/fecha-modal-icon.svg" /></button>'
        h+='</div>'
    h+='</div>'
    //h+='<div class="modal-curso-preview-close">'
        //h+='<button type="button" onclick="removeCurso(this,'+1+')"></button>'
    //h+='</div>'
    
    course_div.innerHTML = h
    getE('modal-cursos-preview-'+list).appendChild(course_div)
}

function removeCursoList(ind,list){
    var item = getE('modal-curso-preview-'+cursos_data[ind].id+'_'+list)
    getE('modal-cursos-preview-'+list).removeChild(item)
}

function editarUsuario(){
    var item_selected = getRadioChecked('tabla-usuarios','usuario')
    if(item_selected==0){
        alert("Debes seleccionar un usuario de la tabla")
    }else{
        var user_data_ind = findUser(item_selected)
        var user_data = null
        if(user_data_ind!=-1){
            user_data = usuarios_data[user_data_ind]
            
            setValueSWitch('tipo-trabajador-txt',user_data.tipo)
            getE('tipo-documento-txt').value = user_data.tipodoc

            getE('numero-documento-txt').value = user_data.documento
            getE('nombres-txt').value = user_data.nombres
            getE('apellidos-txt').value = user_data.apellidos
            getE('correo-txt').value = user_data.correo
            getE('ciudad-txt').value = user_data.ciudad
            getE('empresa-txt').value = user_data.empresa

            openModal(null,'modal-formulario-usuario','Editar Usuario')
        }else{
            alert("No se encontró información del usuario")
        }
    }
}

function eliminarUsuario(){
    var item_selected = getRadioChecked('tabla-usuarios','usuario')
    if(item_selected==0){
        alert("Debes seleccionar un usuario de la tabla")
    }else{
        if(confirm('¿Realmente desea eliminar este usuario?')){
            var tbdoy_container = getE('tabla-usuarios').getElementsByTagName('tbody')[0]
            tbdoy_container.removeChild(getE('tabla-usuario-row-'+item_selected))
        }
    }
    
}

function closeModalMasivo(){
    //limpiar
    getE('modal-cursos-preview-2').innerHTML = ''
    cleanDropdown('cursos-dropdown-2')
    resetFileInput('lista-usuarios-txt')
    
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-off'
    closeModal()
}

function closeModalIndividual(){
    //limpiar
    getE('modal-cursos-preview-1').innerHTML = ''
    cleanDropdown('cursos-dropdown-1')
    closeModal()
}