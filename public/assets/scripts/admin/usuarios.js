var usuarios_json = []

function updateCursoFile(event){
    var inpu = getE('lista-usuarios-txt')
    updateFileInput(inpu)

    // Tomar el primer archivo seleccionado [0]
    const archivo = event.target.files[0];
    if (archivo){
        const lector = new FileReader();
    
        lector.onload = function(e) {
            const datos = new Uint8Array(e.target.result);
            const libro = XLSX.read(datos, { type: 'array' });
    
            // Tomar el nombre de la primera hoja [0]
            const primeraHoja = libro.SheetNames[0];
            const hoja = libro.Sheets[primeraHoja];

            // 2. Convertir la hoja a un arreglo de objetos JSON
            // defval: "" asegura que las celdas vacías aparezcan como texto vacío en vez de omitirse
            usuarios_json = XLSX.utils.sheet_to_json(hoja, { defval: "" });

            // Ver el arreglo resultante en la consola del navegador (F12)
            //console.log(usuarios_json);
            var h = ''

            usuarios_json.forEach((user,indx) =>{
                h+='<tr>'
                    h+='<td>'+getTipoTrabajador(user.tipo_trabajador)+'</td>'
                    h+='<td>'+user.nombre+' '+user.apellido+'</td>'
                    h+='<td>'+user.documento+'</td>'
                    h+='<td>'+user.ciudad+'</td>'
                    h+='<td>'+user.empresa+'</td>'
                    h+='<td>'+user.correo_electronico+'</td>'
                h+='</tr>'
            })
            getE('tabla-usuarios-tdbody').innerHTML = h
        };
    
        lector.readAsArrayBuffer(archivo);
        getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-on'
    }
}

function addCursoList(ind,list){
    var course_div = document.createElement('div')
    course_div.className = 'modal-curso-preview'
    course_div.id = 'modal-curso-preview-'+cursos_data[ind].id+'_'+list
    var h = ''
    h+='<div class="modal-curso-preview-img">'
        h+='<img src="'+base+'public/cursos/'+cursos_data[ind].id+'/'+cursos_data[ind].img+'" />'
    h+='</div>'
    h+='<div class="modal-curso-preview-info">'
        h+='<p id="modal-curso-name-txt">'+cursos_data[ind].nombre+'</p>'
        h+='<div>'
            //h+='<button><img src="'+base+'public/assets/images/modal/time-modal-icon.svg" /></button>'
            h+='<button><img src="'+base+'public/assets/images/modal/fecha-modal-icon.svg" /></button>'
            h+='<p>'+cursos_data[ind].fecha+'</p>'
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

////////////////////////////////////////

function agregarUsuario(btn){
    getE('cursos-dropdown-1').style.display = 'block'
    openModal(btn,'modal-formulario-usuario')
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

            getE('cursos-dropdown-1').style.display = 'none'
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

function registrarUsuario(){
    var action = base+'api/controllers/users.php?action=saveUsers';
    var id = 0;
    if(editing_usuario){
        action = base+'api/controllers/users.php?action=updateUsers';
        id = editing_usuario_id;
    }
    var usuarios_collection = []
    usuarios_collection.push({
        id:id,
        tipo_trabajador:getValueSwitch('tipo-trabajador-txt'),
        nombre:String(getE('nombres-txt').value),
        apellido:String(getE('apellidos-txt').value),
        tipo_documento:String(getE('tipo-documento-txt').value),
        documento:String(getE('numero-documento-txt').value),
        ciudad:String(getE('ciudad-txt').value),
        empresa:String(getE('empresa-txt').value),
        correo_electronico:String(getE('correo-txt').value)
    })

    $.ajax({
        url: action,
        method: 'POST',
        data:{
            users:JSON.stringify(usuarios_collection)
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                //asignar cursos
                if(editing_usuario){
                    registrarUsuarioFinal()
                }else{
                    registrarUsuario2(response_data.data)
                }
            }else{
                unsetLoader()
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

function registrarUsuario2(new_id){
    var charlas_data = getDropdownData('cursos-dropdown-1')
    if(charlas_data.length>0){
        var collection = []
        for(i = 0;i<charlas_data.length;i++){
            collection.push({
                id:charlas_data[i],
                users:new_id
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
                    registrarUsuarioFinal()
                }else{
                    openModalAlert({
                        status:'warning',
                        title:'Algo salió mal',
                        text:'No se pudo matricular al estudiante'
                    })
                }
            },
            error: function(xhr, status, error){
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'Ocurrió un error tratando de matricular al estudiante'
                })
            }
        })
    }else{
        registrarUsuarioFinal()
    }
    
}

function registrarUsuarioFinal(){
    openModalAlert({
        status:'success',
        title:'¡Éxito!',
        text:"El usuario se ha guardado correctamente",
        action:'reloadPage'
    });
}

////////////////////////////////////////

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
                url: base+'api/controllers/users.php?action=deleteUser',
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

////////////////////////////////////////

function guardarUsuariosMasivo(){
    if(usuarios_json.length>0){
        setLoader()
        $.ajax({
            url: base+'api/controllers/users.php?action=saveUsers',
            method: 'POST',
            data:{
                users:JSON.stringify(usuarios_json)
            },
            success: function(response){
                var response_data = JSON.parse(response)
                if(response_data.status=='success'){
                    //asignar cursos
                    guardarUsuariosMasivo2(response_data.data)
                }else{
                    unsetLoader()
                    openModalAlert({
                        status:'warning',
                        title:'¡Algo salió mal!',
                        text:"No se pudo registrar los usuarios"
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log("Error de servidor");
                console.log(xhr);
                unsetLoader()
            }
        })
    }else{
        openModalAlert({
            status:'warning',
            title:'Datos incompletos',
            text:'No se ha cargado la lista de usuarios'
        })
    }
}

function guardarUsuariosMasivo2(ids_collection){
    var charlas_data = getDropdownData('cursos-dropdown-2')
    if(charlas_data.length>0){
        var collection = []
        for(i = 0;i<charlas_data.length;i++){
            var users = []
            for(j = 0;j<ids_collection.length;j++){
                users.push(ids_collection[j])
            }
            collection.push({
                id:charlas_data[i],
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
                    guardarUsuariosMasivoFinal()
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
    }else{
        guardarUsuariosMasivoFinal()
    }
    
}

function guardarUsuariosMasivoFinal(){
    openModalAlert({
        status:'success',
        title:'¡Éxito!',
        text:"Se han registrado los usuarios",
        action:'reloadPage'
    });
    closeModalMasivo()
    unsetLoader()
}

function closeModalMasivo(){
    //limpiar
    getE('modal-cursos-preview-2').innerHTML = ''
    cleanDropdown('cursos-dropdown-2')
    resetFileInput('lista-usuarios-txt')
    usuarios_json = []
    
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-off'
    closeModal()
}

function closeModalIndividual(){
    //limpiar
    getE('modal-cursos-preview-1').innerHTML = ''
    //cleanDropdown('cursos-dropdown-1')
    closeModal()
    editing_usuario = false;
}