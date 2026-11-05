
function verDetallesCurso(id_course){
    //validacion para el id
    //html para tabla
    
    openModal(null,'modal-detalles-curso','Detalles del curso')
    $.ajax({
        url: base+'api/courses.php?action=getCourse',
        method: 'POST',
        data: {
            courseid:id_course
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                var curso_decoded = response_data.data
                //console.log(curso_decoded)
                var h = ''
                h+='<tr>'
                    h+='<td>'+curso.nombre+'</td>'
                    h+='<td>'+curso.facilitador+'</td>'
                    var ubicacion = String('Sede: '+curso.sede+'<br>Aula: '+curso.aula+'<br>Dirección: '+curso.direccion)
                    h+='<td>'+ubicacion+'</td>'
                    h+='<td>'+curso.fecha+'</td>'
                h+='</tr>'
                getE('tabla-detalles2-tdbody').innerHTML = h
            }else{
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo obtener la información del curso"
                });
            }
        },
        error: function(xhr, status, error) {
            console.log("Error de servidor");
            console.log(xhr);
        }
    })
}