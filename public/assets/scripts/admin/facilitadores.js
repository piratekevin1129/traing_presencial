var facilitadores_json = []

function updateCursoFile(event){
    var inpu = getE('lista-facilitadores-txt')
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
            facilitadores_json = XLSX.utils.sheet_to_json(hoja, { defval: "" });

            // Ver el arreglo resultante en la consola del navegador (F12)
            //console.log(facilitadores_json);
            if(facilitadores_json.length>0){
                if(
                    facilitadores_json[0].tipo_documento!=null&&facilitadores_json[0].tipo_documento!=undefined&&
                    facilitadores_json[0].nombre!=null&&facilitadores_json[0].nombre!=undefined&&
                    facilitadores_json[0].apellido!=null&&facilitadores_json[0].apellido!=undefined&&
                    facilitadores_json[0].documento!=null&&facilitadores_json[0].documento!=undefined&&
                    facilitadores_json[0].ciudad!=null&&facilitadores_json[0].ciudad!=undefined&&
                    facilitadores_json[0].empresa!=null&&facilitadores_json[0].empresa!=undefined&&
                    facilitadores_json[0].correo_electronico!=null&&facilitadores_json[0].correo_electronico!=undefined
                ){
                    var h = ''
                    facilitadores_json.forEach((facilitador,indx) =>{
                        h+='<tr>'
                            h+='<td>'+facilitador.nombre+' '+facilitador.apellido+'</td>'
                            h+='<td>'+facilitador.documento+'</td>'
                            h+='<td>'+facilitador.ciudad+'</td>'
                            h+='<td>'+facilitador.empresa+'</td>'
                            h+='<td>'+facilitador.correo_electronico+'</td>'
                        h+='</tr>'
                    })
                    getE('tabla-facilitadores-tbody').innerHTML = h
                }else{
                    openModalAlert({
                        status:'warning',
                        title:'Excel incorrecto',
                        text:'El excel no está construido de forma correcta<br>Por favor descarga el archivo guía de excel y vuelve a intentarlo'
                    })
                    getE('lista-facilitadores-form').reset()
                    getE('lista-facilitadores-name').innerHTML = 'Subir archivo excel'
                }
            }else{
                openModalAlert({
                    status:'warning',
                    title:'Excel incorrecto',
                    text:'El archivo excel no contiene ningún dato o está mal construido<br>Por favor descarga el archivo guía de excel y vuelve a intentarlo'
                })
                getE('lista-facilitadores-form').reset()
                getE('lista-facilitadores-name').innerHTML = 'Subir archivo excel'
            }
        };
    
        lector.readAsArrayBuffer(archivo);
        getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-on'
    }
}

////////////////////////////////////////

function agregarFacilitador(btn){
    openModal(btn,'modal-formulario-facilitador')
}

var editing_facilitador = false;
var editing_facilitador_id = 0;

function editarFacilitador(){
    var item_selected = getRadioChecked('tabla-facilitadores','facilitador')
    if(item_selected==0){
        openModalAlert({
            status:'warning',
            title:'¡Aún no!',
            text:"Debes seleccionar un facilitador de la tabla"
        })
    }else{
        var facilitador_data_ind = findFacilitador(item_selected)
        var facilitador_data = null
        if(facilitador_data_ind!=-1){
            editing_facilitador = true;
            editing_facilitador_id = item_selected;

            facilitador_data = facilitadores_data[facilitador_data_ind]
            
            getE('tipo-documento-txt').value = facilitador_data.tipod

            getE('numero-documento-txt').value = facilitador_data.documento
            getE('nombres-txt').value = facilitador_data.nombre
            getE('apellidos-txt').value = facilitador_data.apellido
            getE('correo-txt').value = facilitador_data.correo
            getE('ciudad-txt').value = facilitador_data.ciudad
            getE('empresa-txt').value = facilitador_data.empresa

            openModal(null,'modal-formulario-facilitador','Editar Facilitador')
        }else{
            openModalAlert({
                status:'warning',
                title:'¡Aún no!',
                text:"No se encontró información del facilitador"
            })
        }
    }
}

function registrarFacilitador(){
    var action = base+'api/controllers/teachers.php?action=saveTeachers';
    var id = 0;
    if(editing_facilitador){
        action = base+'api/controllers/teachers.php?action=updateTeachers';
        id = editing_facilitador_id;
    }
    var facilitadores_collection = []
    facilitadores_collection.push({
        id:id,
        nombre:String(getE('nombres-txt').value),
        apellido:String(getE('apellidos-txt').value),
        tipo_documento:String(getE('tipo-documento-txt').value),
        documento:String(getE('numero-documento-txt').value),
        ciudad:String(getE('ciudad-txt').value),
        empresa:String(getE('empresa-txt').value),
        correo_electronico:String(getE('correo-txt').value)
    })

    setLoader()
    $.ajax({
        url: action,
        method: 'POST',
        data:{
            teachers:JSON.stringify(facilitadores_collection)
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                //asignar cursos
                registrarFacilitadorFinal()
            }else{
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo guardar el facilitador"
                });
            }
        },
        error: function(xhr, status, error) {
            unsetLoader()
            console.log("Error de servidor");
            console.log(xhr);
        }
    })
}

function registrarFacilitadorFinal(){
    unsetLoader()
    openModalAlert({
        status:'success',
        title:'¡Éxito!',
        text:"El facilitador se ha guardado correctamente",
        action:'reloadPage'
    });
}

////////////////////////////////////////

function eliminarFacilitador(){
    var item_selected = getRadioChecked('tabla-facilitadores','facilitador')
    if(item_selected==0){
        openModalAlert({
            status:'warning',
            title:'¡Aún no!',
            text:"Debes seleccionar un facilitador de la tabla"
        })
    }else{
        if(confirm('¿Realmente desea eliminar este facilitador? \n\nPuede tener cursos asignados')){
            //var tbdoy_container = getE('tabla-facilitadores').getElementsByTagName('tbody')[0]
            //tbdoy_container.removeChild(getE('tabla-facilitador-row-'+item_selected))
            $.ajax({
                url: base+'api/controllers/teachers.php?action=deleteTeacher',
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
                            text:"No se pudo eliminar el facilitador"
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

function guardarFacilitadoresMasivo(){
    if(facilitadores_json.length>0){
        setLoader()
        $.ajax({
            url: base+'api/controllers/teachers.php?action=saveTeachers',
            method: 'POST',
            data:{
                teachers:JSON.stringify(facilitadores_json)
            },
            success: function(response){
                var response_data = JSON.parse(response)
                if(response_data.status=='success'){
                    //asignar cursos
                    guardarFacilitadoresMasivoFinal()
                }else{
                    unsetLoader()
                    openModalAlert({
                        status:'warning',
                        title:'¡Algo salió mal!',
                        text:"No se pudo registrar los facilitadores"
                    });
                }
            },
            error: function(xhr, status, error) {
                unsetLoader()
                console.log("Error de servidor");
                console.log(xhr);
                unsetLoader()
            }
        })
    }else{
        openModalAlert({
            status:'warning',
            title:'Datos incompletos',
            text:'No se ha cargado la lista de los facilitadores'
        })
    }
}

function guardarFacilitadoresMasivoFinal(){
    openModalAlert({
        status:'success',
        title:'¡Éxito!',
        text:"Se han registrado los facilitadores",
        action:'reloadPage'
    });
    closeModalMasivo()
    unsetLoader()
}

function closeModalMasivo(){
    //limpiar
    resetFileInput('lista-facilitadores-txt')
    facilitadores_json = []
    
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-off'
    closeModal()
}

function closeModalIndividual(){
    //limpiar
    
    closeModal()
    editing_facilitador = false;
    editing_facilitador_id = 0;
}