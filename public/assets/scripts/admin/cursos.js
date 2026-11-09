var active_course_id = -1
var active_course_status = -1

function verQRS(id_curso){
    //validacion para el id
    openModal(null,'modal-codigos-qr2','Ver códigos QR')
}

function verAsistencias(id_curso, status_curso){
    //validacion para el id
    //html para tabla
    active_course_id = id_curso
    active_course_status = status_curso
    openModal(null,'modal-ver-asistencias','Ver asistencia de los estudiantes')
    verAsistencias2()
}

function verAsistencias2(){
    $.ajax({
        url: base+'api/controllers/courses_users.php?action=getUsersByCourse',
        method: 'POST',
        data: {
            courseid:active_course_id
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                var usuarios_decoded = response_data.data
                //console.log(usuarios_decoded)
                var h = ''
                usuarios_decoded.forEach((user,indx) =>{
                    h+='<tr>'
                        h+='<td>'+user.tipou+'</td>'
                        h+='<td>'+user.nombre+' '+user.apellido+'</td>'
                        h+='<td>'+user.documento+'</td>'
                        h+='<td>'+user.ciudad+'</td>'
                        h+='<td>'+user.empresa+'</td>'
                        h+='<td>'+user.correo+'</td>'
                        h+='<td>'
                            if(active_course_status==0){
                                h+='<div class="table-tag table-tag-gris2">'
                                    h+='<img src="'+base+'public/assets/images/esperar-icon.svg" />'
                                    h+='<p>Sin iniciar</p>'
                                h+='</div>'
                            }else if(active_course_status==1){
                                if(user.estado==0){
                                    h+='<div class="table-tag table-tag-gris">'
                                        h+='<img src="'+base+'public/assets/images/loading-icon.svg" />'
                                        h+='<p>Esperando</p>'
                                    h+='</div>'
                                }else if(user.estado==1){
                                    h+='<div class="table-tag table-tag-verde">'
                                        h+='<img src="'+base+'public/assets/images/check-icon.svg" />'
                                        h+='<p>Ingresado</p>'
                                    h+='</div>'
                                }else if(user.estado==2){
                                    h+='<div class="table-tag table-tag-verde">'
                                        h+='<img src="'+base+'public/assets/images/check-icon.svg" />'
                                        h+='<p>Finalizado</p>'
                                    h+='</div>'
                                }
                            }else if(active_course_status==2){
                                if(user.estado==0){
                                    h+='<div class="table-tag table-tag-gris">'
                                        h+='<img src="'+base+'public/assets/images/esperar-icon.svg" />'
                                        h+='<p>No ingresó</p>'
                                    h+='</div>'
                                }else if(user.estado==1){
                                    h+='<div class="table-tag table-tag-naranja">'
                                        h+='<img src="'+base+'public/assets/images/check-icon.svg" />'
                                        h+='<p>Ingresó</p>'
                                    h+='</div>'
                                }else if(user.estado==2){
                                    h+='<div class="table-tag table-tag-verde">'
                                        h+='<img src="'+base+'public/assets/images/check-icon.svg" />'
                                        h+='<p>Finalizó</p>'
                                    h+='</div>'
                                }
                            }
                        h+='</td>'
                    h+='</tr>'
                })

                getE('tabla-asistencia-tdbody').innerHTML = h
            }else{
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo obtener la lista de usuarios"
                });
            }
        },
        error: function(xhr, status, error) {
            console.log("Error de servidor");
            console.log(xhr);
        }
    })
}

function actualizarModal(){
    verAsistencias2()
}

function closeModalAsistencias(){
    active_course_id = -1
    active_course_status = -1
    closeModal()
}

function editarCurso(id_curso){
    window.location.href = './cursos-crear.php'
}

function iniciarCurso(id_curso){
    active_course_id = id_curso
    openModalAlert({
        status:'success',
        title:'Iniciar curso',
        text:'Se acaba de abrir el curso. <br><br> para finalizarlo por favor regrese a esta ventana y haz click en <span>Finalizar</span>',
        action:'iniciarCurso2'
    })
}

function iniciarCurso2(){
    $.ajax({
        method: 'POST',
        url: base+'api/controllers/courses.php?action=InitiateCourse',
        data: {
            courseid:active_course_id
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                window.open(base+'public/docs/curso-medio-ambiente.pdf')
                //cambiar boton a finalizar
                reloadPage()
            }else{
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:'No se ha podido iniciar el curso'
                })
            }
            active_course_id = -1
        },
        error: function(xhr, status, error){
            openModalAlert({
                status:'warning',
                title:'¡Algo salió mal!',
                text:'Ocurrió un error tratando de iniciar el cusro'
            })
        }

    })
}