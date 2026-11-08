
function verDetallesCurso(id_course){
    //validacion para el id
    //html para tabla
    
    openModal(null,'modal-detalles-curso','Detalles del curso')
    $.ajax({
        url: base+'api/controllers/courses.php?action=getCourse',
        method: 'POST',
        data: {
            courseid:id_course
        },
        success: function(response){
            var response_data = JSON.parse(response)
            if(response_data.status=='success'){
                var curso_decoded = response_data.data
                console.log(curso_decoded)
                var h = ''
                h+='<tr>'
                    h+='<td>'+curso_decoded.id+'</td>'
                    h+='<td>'+curso_decoded.nombre+'</td>'
                    h+='<td>'+curso_decoded.facilitador+'</td>'
                    var ubicacion = String('<span>Sede:</span> '+curso_decoded.sede+'<br><span>Aula:</span> '+curso_decoded.aula+'<br><span>Dirección:</span> '+curso_decoded.direccion)
                    h+='<td>'+ubicacion+'</td>'
                    h+='<td>'+curso_decoded.fecha+'</td>'
                h+='</tr>'
                getE('tabla-detalles-tdbody').innerHTML = h
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