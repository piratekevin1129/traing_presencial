function updateCursoFile(inpu){
    updateFileInput(inpu)
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-on'
}

function registrarFacilitador(){
    var action = base+'api/teachers.php?action=saveFacilitador';
    var id = 0;
    if(editing_usuario){
        action = base+'api/teachers.php?action=updateFacilitador';
        id = editing_usuario_id;
    }
    $.ajax({
        url: action,
        method: 'POST',
        data:{
            id:id,
            nombre:String(getE('nombres-txt').value),
            apellido:String(getE('apellidos-txt').value),
            tipod:String(getE('tipo-documento-txt').value),
            documento:String(getE('numero-documento-txt').value),
            ciudad:String(getE('ciudad-txt').value),
            empresa:String(getE('empresa-txt').value),
            correo:String(getE('correo-txt').value)
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                openModalAlert({
                    status:'success',
                    title:'¡Éxito!',
                    text:"El facilitador se ha guardado correctamente",
                    action:'reloadPage'
                });
                
            }else{
                console.log(response)
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo guardar el usuario"
                });
            }
        },
        error: function(xhr, status, error) {
            console.log("Error de servidor");
            console.log(xhr);
        }
    })
}

var editing_usuario = false;
var editing_usuario_id = 0;

function editarUsuario(){
    var item_selected = getRadioChecked('tabla-usuarios','usuario')
    if(item_selected==0){
        openModalAlert({
            status:'warning',
            title:'¡Aún no!',
            text:"Debes seleccionar un facilitador de la tabla"
        })
    }else{
        var user_data_ind = findFacilitador(item_selected)
        var user_data = null
        if(user_data_ind!=-1){
            editing_usuario = true;
            editing_usuario_id = item_selected;

            user_data = facilitadores_data[user_data_ind]
            
            getE('tipo-documento-txt').value = user_data.tipod

            getE('numero-documento-txt').value = user_data.documento
            getE('nombres-txt').value = user_data.nombre
            getE('apellidos-txt').value = user_data.apellido
            getE('correo-txt').value = user_data.correo
            getE('ciudad-txt').value = user_data.ciudad
            getE('empresa-txt').value = user_data.empresa

            openModal(null,'modal-formulario-usuario','Editar Facilitador')
        }else{
            openModalAlert({
                status:'warning',
                title:'¡Aún no!',
                text:"No se encontró información del facilitador"
            })
        }
    }
}

function eliminarUsuario(){
    var item_selected = getRadioChecked('tabla-usuarios','usuario')
    if(item_selected==0){
        openModalAlert({
            status:'warning',
            title:'¡Aún no!',
            text:"Debes seleccionar un facilitador de la tabla"
        })
    }else{
        if(confirm('¿Realmente desea eliminar este facilitador? \n\nPuede tener cursos asignados')){
            //var tbdoy_container = getE('tabla-usuarios').getElementsByTagName('tbody')[0]
            //tbdoy_container.removeChild(getE('tabla-usuario-row-'+item_selected))
            $.ajax({
                url: base+'api/teachers.php?action=deleteFacilitador',
                method: 'POST',
                data:{
                    id:item_selected
                },
                success: function(response){
                    var response_data = JSON.parse(response)
                    if(response_data.status=='success'){
                        openModalAlert({
                            status:'success',
                            title:'¡Éxito!',
                            text:"El facilitador se ha eliminado correctamente",
                            action:'reloadPage'
                        });
                        
                    }else{
                        console.log(response)
                        openModalAlert({
                            status:'warning',
                            title:'¡Algo salió mal!',
                            text:"No se pudo eliminar el usuario"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error de servidor");
                    console.log(xhr);
                }
            })
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