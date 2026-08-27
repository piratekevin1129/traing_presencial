var active_course_id = -1

function clickConfirmarIngreso(c){
    var course_data_ind = findCourse(c)
    var course_data = null
    console.log(course_data_ind)
    if(course_data_ind!=-1){
        active_course_id = c
        course_data = cursos_data[course_data_ind]
        getE('modal-curso-nombre-txt').innerHTML = course_data.nombre
        getE('modal-curso-image-txt').src = './public/assets/images/cursos/'+course_data.img
        getE('modal-curso-fecha-txt').innerHTML = course_data.fecha
        getE('modal-curso-sede-txt').innerHTML = course_data.sede
        getE('modal-curso-ubicacion-txt').innerHTML = course_data.ubicacion
        getE('modal-curso-facilitador-txt').innerHTML = course_data.facilitador
        
        getE('modal-qr-title-txt').innerHTML = 'Confirmar asistencia'

        var current_date = new Date()
        getE('modal-usuario-hora-txt').innerHTML = String(current_date.getUTCHours()+':'+current_date.getUTCMinutes())
    
        openModal(null,'modal-codigos-qr','Confirmar Ingreso')
    }else{
        alert("Error cargando los datos del curso")
    }
}

function confirmarAsistencia(){
    closeModal()
    if(active_course_id!=-1){
        getE('confirmar-ingreso-btn-'+active_course_id).className = 'accordion-ingreso-btn ready'
        getE('confirmar-salida-btn-'+active_course_id).className = 'accordion-ingreso-btn unlocked'
    }
}