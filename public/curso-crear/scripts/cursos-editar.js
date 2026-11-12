function createCharlas(){
    for(i = 0;i<charlas_data.length;i++){
        getE('calendario-date-'+charlas_data[i].fecha).className = 'dia-escogido'
    }

    verCharla(1)
}

function verCharla(id){
    current_charla = 0
}

/************************************************/

function guardarCurso(btn){
    //btn.disabled = true
    
    var nombre_val = getE('nombre-inp').value
    var descripcion_val = getE('descripcion-inp').value
    var tiempo_inp = getE('tiempo-inp').value
    var tiempo2_sel = getE('tiempo2-sel').value
    var encargados_list = getDropdownItems('dropdown-encargado')
    var imagen_val = getE('imagen-inp')

    if(
        is_empty(nombre_val)||
        imagen_val.files.length<=0||
        charlas_data.length==0
    ){
        openModalAlert({
            status:'warning',
            title:'Campos sin diligenciar',
            text:'Por favor asegúrate de diligenciar:<br>• Un nombre<br>• Una imagen<br>•Una fecha mínimo para el curso'
        })
    }else{
        setLoader()
        $.ajax({
            method: 'POST',
            url: base+'api/controllers/courses.php?action=saveCourses',
            data: {
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
                    guardarCurso2(response_data.data)
                }else{
                    unsetLoader()
                    openModalAlert({
                        status:'warning',
                        title:'Algo salió mal',
                        text:'No se pudo guardar el curso'
                    })
                }
            },
            error: function(xhr, status, error){
                unsetLoader()
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'Ocurrió un error tratando de guardar el curso'
                })
            }
        })
    }


}

function guardarCurso2(ids_collection){
    var collection = []
    for(i = 0;i<charlas_data.length;i++){
        var users = []
        for(j = 0;j<charlas_data[i].estudiantes.length;j++){
            users.push(charlas_data[i].estudiantes[j])
        }
        collection.push({
            id:ids_collection[i],
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
            unsetLoader()
            if(response_data.status=='success'){
                //guardar imagen
                guardarCurso3(ids_collection)
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
}

function guardarCurso3(ids_collection){
    //guardar QR
    $.ajax({
        method: 'POST',
        url: base+'api/controllers/courses.php?action=saveCoursesQR',
        data:{
            ids:JSON.stringify(ids_collection)
        },
        success: function(response){
            var response_data = JSON.parse(response)
            unsetLoader()
            if(response_data.status=='success'){
                //guardar imagen
                getE('curso_ids').value = ids_collection[0]
                guardarCurso4()
            }else{
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'No se pudo generar el código QR de los cursos'
                })
            }
        },
        error: function(xhr, status, error){
            openModalAlert({
                status:'warning',
                title:'Algo salió mal',
                text:'Ocurrió un error generando el código QR de los cursos'
            })
        }
    })
}

function guardarCurso4(){
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
                openModalAlert({status:'success',title:'Curso creado con éxito!',text:'Ya puedes ir a la sección de curso y descargar los códigos QR para la asistencia y finalización'})
            }else{
                openModalAlert({
                    status:'warning',
                    title:'Algo salió mal',
                    text:'No se pudo guardar la imagen del curso'
                })
            }
        },
        error: function(xhr, status, error) {
            openModalAlert({
                status:'warning',
                title:'Algo salió mal',
                text:'Ocurrió un error guardando la imagen del curso'
            })
        }
    });
}