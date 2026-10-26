function updateCursoFile(inpu){
    updateFileInput(inpu)
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-on'
}


function editarUsuario(){
    var item_selected = getRadioChecked('tabla-usuarios','usuario')
    if(item_selected==0){
        alert("Debes seleccionar un facilitador de la tabla")
    }else{
        var user_data_ind = findUser(item_selected)
        var user_data = null
        if(user_data_ind!=-1){
            user_data = facilitadores_data[user_data_ind]
            
            getE('tipo-documento-txt').value = user_data.tipodoc

            getE('numero-documento-txt').value = user_data.documento
            getE('nombres-txt').value = user_data.nombres
            getE('apellidos-txt').value = user_data.apellidos
            getE('correo-txt').value = user_data.correo
            getE('ciudad-txt').value = user_data.ciudad
            getE('empresa-txt').value = user_data.empresa

            openModal(null,'modal-formulario-usuario','Editar Facilitador')
        }else{
            alert("No se encontró información del facilitador")
        }
    }
}

function eliminarUsuario(){
    var item_selected = getRadioChecked('tabla-usuarios','usuario')
    if(item_selected==0){
        alert("Debes seleccionar un facilitador de la tabla")
    }else{
        if(confirm('¿Realmente desea eliminar este usuario?')){
            var tbdoy_container = getE('tabla-usuarios').getElementsByTagName('tbody')[0]
            tbdoy_container.removeChild(getE('tabla-usuario-row-'+item_selected))
        }
    }
    
}

function closeModalMasivo(){
    //limpiar
    resetFileInput('lista-usuarios-txt')
    
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-off'
    closeModal()
}

function closeModalIndividual(){
    //limpiar
    
    closeModal()
}