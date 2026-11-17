
////////////////////////////////////////

function agregarSede(btn){
    openModal(btn,'modal-formulario-sede')
}

var editing_sede = false;
var editing_sede_id = 0;

function editarSede(){
    var item_selected = getRadioChecked('tabla-sedes','sede')
    if(item_selected==0){
        openModalAlert({
            status:'warning',
            title:'¡Aún no!',
            text:"Debes seleccionar una sede de la tabla"
        })
    }else{
        var sede_data_ind = findHeadquarter(item_selected)
        var sede_data = null
        if(sede_data_ind!=-1){
            editing_sede = true;
            editing_sede_id = item_selected;

            sede_data = sedes_data[sede_data_ind]
            
            getE('nombre-txt').value = sede_data.nombre
            getE('departamento-txt').value = sede_data.departamento
            getE('ciudad-txt').value = sede_data.ciudad
            getE('direccion-txt').value = sede_data.direccion

            openModal(null,'modal-formulario-sede','Editar Sede')
        }else{
            openModalAlert({
                status:'warning',
                title:'¡Aún no!',
                text:"No se encontró información de la sede"
            })
        }
    }
}

function registrarSede(){
    var action = base+'api/controllers/headquarters.php?action=saveHeadquarters';
    var id = 0;
    if(editing_sede){
        action = base+'api/controllers/headquarters.php?action=updateHeadquarters';
        id = editing_sede_id;
    }
    var sedes_collection = []
    sedes_collection.push({
        id:id,
        nombre:String(getE('nombre-txt').value),
        departamento:String(getE('departamento-txt').value),
        ciudad:String(getE('ciudad-txt').value),
        direccion:String(getE('direccion-txt').value)
    })

    setLoader()
    $.ajax({
        url: action,
        method: 'POST',
        data:{
            headquarters:JSON.stringify(sedes_collection)
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                //asignar cursos
                registrarSedeFinal()
            }else{
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo guardar la sede"
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

function registrarSedeFinal(){
    unsetLoader()
    openModalAlert({
        status:'success',
        title:'¡Éxito!',
        text:"La sede se ha guardado correctamente",
        action:'reloadPage'
    });
}

////////////////////////////////////////

function eliminarSede(){
    var item_selected = getRadioChecked('tabla-sedes','sede')
    if(item_selected==0){
        openModalAlert({
            status:'warning',
            title:'¡Aún no!',
            text:"Debes seleccionar una sede de la tabla"
        })
    }else{
        if(confirm('¿Realmente desea eliminar esta sede?')){
            //var tbdoy_container = getE('tabla-sedes').getElementsByTagName('tbody')[0]
            //tbdoy_container.removeChild(getE('tabla-sede-row-'+item_selected))
            $.ajax({
                url: base+'api/controllers/headquarters.php?action=deleteHeadquarter',
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
                            text:"La sede se ha eliminado correctamente",
                            action:'reloadPage'
                        });
                        
                    }else{
                        console.log(response)
                        openModalAlert({
                            status:'warning',
                            title:'¡Algo salió mal!',
                            text:"No se pudo eliminar la sede"
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
