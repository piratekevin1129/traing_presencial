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
        h+='<img src="'+base+'public/assets/images/cursos/'+cursos_data[ind].img+'" />'
    h+='</div>'
    h+='<div class="modal-curso-preview-info">'
        h+='<p id="modal-curso-name-txt">'+cursos_data[ind].nombre+'</p>'
        h+='<div>'
            h+='<button><img src="'+base+'public/assets/images/modal/time-modal-icon.svg" /></button>'
            h+='<button><img src="'+base+'public/assets/images/modal/fecha-modal-icon.svg" /></button>'
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

function registrarUsuario(){
    var action = base+'api/users.php?action=saveUser';
    var id = 0;
    if(editing_usuario){
        action = base+'api/users.php?action=updateUser';
        id = editing_usuario_id;
    }
    $.ajax({
        url: action,
        method: 'POST',
        data:{
            id:id,
            tipou:getValueSwitch('tipo-trabajador-txt'),
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
                    text:"El usuario se ha guardado correctamente",
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
            text:"Debes seleccionar un usuario de la tabla"
        })
    }else{
        var user_data_ind = findUser(item_selected)
        var user_data = null
        if(user_data_ind!=-1){
            editing_usuario = true;
            editing_usuario_id = item_selected;

            user_data = usuarios_data[user_data_ind]
            
            setValueSWitch('tipo-trabajador-txt',user_data.tipou)
            getE('tipo-documento-txt').value = user_data.tipod

            getE('numero-documento-txt').value = user_data.documento
            getE('nombres-txt').value = user_data.nombre
            getE('apellidos-txt').value = user_data.apellido
            getE('correo-txt').value = user_data.correo
            getE('ciudad-txt').value = user_data.ciudad
            getE('empresa-txt').value = user_data.empresa

            openModal(null,'modal-formulario-usuario','Editar Usuario')
        }else{
            openModalAlert({
                status:'warning',
                title:'¡Aún no!',
                text:"No se encontró información del usuario"
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
            text:"Debes seleccionar un usuario de la tabla"
        })
    }else{
        if(confirm('¿Realmente desea eliminar este usuario?')){
            //var tbdoy_container = getE('tabla-usuarios').getElementsByTagName('tbody')[0]
            //tbdoy_container.removeChild(getE('tabla-usuario-row-'+item_selected))
            $.ajax({
                url: base+'api/users.php?action=deleteUser',
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
                            text:"El usuario se ha eliminado correctamente",
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