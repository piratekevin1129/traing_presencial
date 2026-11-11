
function verDetallesUsuario(id_user){
    //validacion para el id
    //html para tabla
    
    openModal(null,'modal-detalles-usuario','Detalles del usuario')
    $.ajax({
        url: base+'api/controllers/courses_users.php?action=getCoursesByUser',
        method: 'POST',
        data: {
            userid:id_user
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                var cursos_decoded = response_data.data
                //console.log(cursos_decoded)
                var h = ''
                cursos_decoded.forEach((curso,indx) =>{
                    h+='<tr>'
                        h+='<td>'+curso.nombre+'</td>'
                        if(curso.status==0){
                            h+='<td>No ingresó</td>'
                        }else if(curso.status==1){
                            h+='<td>Ingresó</td>'
                        }else if(curso.status==2){
                            h+='<td>Finalizó</td>'
                        }else{
                            h+='<td>Desconocido</td>'
                        }
                        h+='<td>'+curso.horaentrada+'</td>'
                        h+='<td>'+curso.horasalida+'</td>'
                    h+='</tr>'
                })
                getE('tabla-detalles2-tdbody').innerHTML = h

                if(usuarios_decoded.length==0){
                    getE('tabla-cursos-none').style.display = 'block'
                }else{
                    getE('tabla-cursos-none').style.display = 'none'
                }
            }else{
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo obtener la información del usuario"
                });
            }
        },
        error: function(xhr, status, error) {
            console.log("Error de servidor");
            console.log(xhr);
        }
    })

    $.ajax({
        url: base+'api/controllers/users.php?action=getUser',
        method: 'POST',
        data: {
            userid:id_user
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                var user_decoded = response_data.data
                //console.log(user_decoded)
                var h = ''
                
                h+='<tr>'
                    h+='<td>'+getTipoTrabajador(user_decoded.tipou)+'</td>'
                    h+='<td>'+user_decoded.nombre+' '+user_decoded.apellido+'</td>'
                    h+='<td>'+user_decoded.documento+'</td>'
                    h+='<td>'+user_decoded.ciudad+'</td>'
                    h+='<td>'+user_decoded.empresa+'</td>'
                    h+='<td>'+user_decoded.correo+'</td>'
                h+='</tr>'
                getE('tabla-detalles-tdbody').innerHTML = h
            }else{
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo obtener la información del usuario"
                });
            }
        },
        error: function(xhr, status, error) {
            console.log("Error de servidor");
            console.log(xhr);
        }
    })
}