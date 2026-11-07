var active_course_id = -1

function verQRS(id_curso){
    //validacion para el id
    openModal(null,'modal-codigos-qr2','Ver códigos QR')
}

function verAsistencias(id_curso){
    //validacion para el id
    //html para tabla
    
    openModal(null,'modal-ver-asistencias','Ver asistencia de los estudiantes')
    $.ajax({
        url: base+'api/courses_users.php?action=getUsersByCourse',
        method: 'POST',
        data: {
            courseid:id_curso
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
                        h+='<td class="td-boton">'
                            if(user.estado==0){
                                h+='<div class="table-tag table-tag-gris">'
                                    h+='<img src="'+base+'public/assets/images/loading-icon.svg" />'
                                    h+='<p>Esperando</p>'
                                h+='</div>'
                            }else if(user.estado==1){
                                h+='<div class="table-tag table-tag-verde">'
                                    h+='<img src="'+base+'public/assets/images/check-icon.svg" />'
                                    h+='<p>Confirmado</p>'
                                h+='</div>'
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

function editarCurso(id_curso){
    window.location.href = './cursos-crear.php'
}