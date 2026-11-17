
////////////////////////////////////////

function agregarAula(btn){
    openModal(btn,'modal-formulario-aula')
}

var editing_aula = false;
var editing_aula_id = 0;

function editarAula(){
    var item_selected = getRadioChecked('tabla-aulas','aula')
    if(item_selected==0){
        openModalAlert({
            status:'warning',
            title:'¡Aún no!',
            text:"Debes seleccionar un aula de la tabla"
        })
    }else{
        var aula_data_ind = findRoom(item_selected)
        var aula_data = null
        if(aula_data_ind!=-1){
            editing_aula = true;
            editing_aula_id = item_selected;

            aula_data = aulas_data[aula_data_ind]
            
            getE('nombre-txt').value = aula_data.nombre
            getE('extra-txt').value = aula_data.extra
            getE('sede-sel').value = aula_data.sedeid

            openModal(null,'modal-formulario-aula','Editar Aula')
        }else{
            openModalAlert({
                status:'warning',
                title:'¡Aún no!',
                text:"No se encontró información del aula"
            })
        }
    }
}

function registrarAula(){
    var action = base+'api/controllers/rooms.php?action=saveRooms';
    var id = 0;
    if(editing_aula){
        action = base+'api/controllers/rooms.php?action=updateRooms';
        id = editing_aula_id;
    }
    var aulas_collection = []
    aulas_collection.push({
        id:id,
        nombre:String(getE('nombre-txt').value),
        extra:String(getE('extra-txt').value),
        sedeid:Number(getE('sede-sel').value)
    })

    setLoader()
    $.ajax({
        url: action,
        method: 'POST',
        data:{
            rooms:JSON.stringify(aulas_collection)
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                //asignar cursos
                registrarAulaFinal()
            }else{
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo guardar el aula"
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

function registrarAulaFinal(){
    unsetLoader()
    openModalAlert({
        status:'success',
        title:'¡Éxito!',
        text:"El aula se ha guardado correctamente",
        action:'reloadPage'
    });
}

////////////////////////////////////////

function eliminarAula(){
    var item_selected = getRadioChecked('tabla-aulas','aula')
    if(item_selected==0){
        openModalAlert({
            status:'warning',
            title:'¡Aún no!',
            text:"Debes seleccionar una aula de la tabla"
        })
    }else{
        if(confirm('¿Realmente desea eliminar esta aula?')){
            //var tbdoy_container = getE('tabla-aulas').getElementsByTagName('tbody')[0]
            //tbdoy_container.removeChild(getE('tabla-aula-row-'+item_selected))
            $.ajax({
                url: base+'api/controllers/rooms.php?action=deleteRoom',
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
                            text:"El aula se ha eliminado correctamente",
                            action:'reloadPage'
                        });
                        
                    }else{
                        console.log(response)
                        openModalAlert({
                            status:'warning',
                            title:'¡Algo salió mal!',
                            text:"No se pudo eliminar el aula"
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
