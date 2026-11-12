function createCharlas(){
    for(i = 0;i<charlas_data.length;i++){
        getE('calendario-date-'+charlas_data[i].fecha).className = 'dia-escogido'
    }

    verCharla(1)
}

function verCharla(id){
    current_charla = 0
    getE('calendario-date-'+charlas_data[current_charla].fecha).className = 'dia-seleccionado'
}

/************************************************/

function actualizarCurso(btn){
    //btn.disabled = true
    
    var nombre_val = getE('nombre-inp').value
    var descripcion_val = getE('descripcion-inp').value
    var tiempo_inp = getE('tiempo-inp').value
    var tiempo2_sel = getE('tiempo2-sel').value
    var encargados_list = getDropdownItems('dropdown-encargado')
    var curso_ids = getE('curso_ids').value
    
    if(
        is_empty(nombre_val)||
        charlas_data.length==0
    ){
        openModalAlert({
            status:'warning',
            title:'Campos sin diligenciar',
            text:'Por favor asegúrate de diligenciar:<br>• Un nombre<br>Fecha para el curso'
        })
    }else{
        setLoader()
        $.ajax({
            method: 'POST',
            url: base+'api/controllers/courses.php?action=updateCourse',
            data: {
                courseid:curso_ids,
                nombre:nombre_val,
                descripcion:descripcion_val,
                tiempo:parseInt(tiempo_inp),
                tiempo2:tiempo2_sel,
                encargados:JSON.stringify(encargados_list),
                charlas:JSON.stringify(charlas_data)
            },
            success: function(response){
                var response_data = JSON.parse(response)
                if(response_data.status=='success'){
                    //guardar usuarios registrados
                    actualizarCurso2()
                }else{
                    unsetLoader()
                    openModalAlert({
                        status:'warning',
                        title:'Algo salió mal',
                        text:'No se pudo actualizar el curso'
                    })
                }
            },
            error: function(xhr, status, error){
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'Ocurrió un error tratando de actualizar el curso'
                })
            }
        })
    }


}

function actualizarCurso2(){
    var curso_ids = getE('curso_ids').value
    var imagen_val = getE('imagen-inp')
    var users = []
    for(j = 0;j<charlas_data[current_charla].estudiantes.length;j++){
        users.push(charlas_data[current_charla].estudiantes[j])
    }
    var collection = [{
        id:curso_ids,
        users:users
    }]

    $.ajax({
        method: 'POST',
        url: base+'api/controllers/courses_users.php?action=updateCoursesUsers',
        data: {
            datos:JSON.stringify(collection),
        },
        success: function(response){
            var response_data = JSON.parse(response)
            unsetLoader()
            if(response_data.status=='success'){
                //guardar imagen
                if(imagen_val.files.length<=0){
                    actualizarFinal()
                }else{
                    actualizarCurso3()
                }
            }else{
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'No se pudo actualizar el registro a los estudiantes'
                })
            }
        },
        error: function(xhr, status, error){
            unsetLoader()
            openModalAlert({
                status:'warning',
                title:'Algo salió mal',
                text:'Ocurrió un error tratando de actualizar el registro de los estudiantes'
            })
        }
    })
}

function actualizarCurso3(){
    var datosimagen = new FormData(getE('curso-img-form'));

    $.ajax({
        url: base+'api/controllers/courses.php?action=saveCoursesImage',
        type: 'POST',
        data: datosimagen,
        contentType: false,
        processData: false,
        success: function(response) {
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                actualizarFinal()
            }else{
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'No se pudo actualizar la imagen del curso'
                })
            }
        },
        error: function(xhr, status, error) {
            openModalAlert({
                status:'warning',
                title:'Algo salió mal',
                text:'Ocurrió un error actualizando la imagen del curso'
            })
        }
    });
}

function actualizarFinal(){
    openModalAlert({
        status:'success',
        title:'Curso actualizado con éxito!',
        text:'Ya puedes ir a la sección de curso y descargar los códigos QR para la asistencia y finalización'
    })
}
