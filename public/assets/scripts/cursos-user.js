var active_course_id = -1
var active_qr_action = ''

function clickConfirmarIngreso(c){
    updateModalCurso(c,'ingreso','ingreso')
}

function clickConfirmarSalida(c){
    updateModalCurso(c,'salida','salida')
}

function updateModalCurso(c,estado_qr,estado_qr2){
    var course_data_ind = findCourse(c)
    var course_data = null
    
    if(course_data_ind!=-1){
        active_course_id = c
        active_qr_action = estado_qr

        course_data = cursos_data[course_data_ind]
        getE('modal-curso-nombre-txt').innerHTML = course_data.nombre
        getE('modal-curso-image-txt').src = './public/assets/images/cursos/'+course_data.img
        getE('modal-curso-fecha-txt').innerHTML = course_data.fecha
        getE('modal-curso-sede-txt').innerHTML = course_data.sede
        getE('modal-curso-ubicacion-txt').innerHTML = course_data.ubicacion
        getE('modal-curso-facilitador-txt').innerHTML = course_data.facilitador
        
        //getE('modal-qr-title-txt').innerHTML = 'Confirmar '+estado_qr
        getE('modal-usuario-hora-title').innerHTML = estado_qr2
                
        var current_date = new Date()
        getE('modal-usuario-hora-txt').innerHTML = String(current_date.getUTCHours()+':'+current_date.getUTCMinutes())
    
        openModal(null,'modal-codigos-qr','Confirmar '+estado_qr2)
    }else{
        alert("Error cargando los datos del curso")
    }
}

function confirmarQr(){
    closeModal()
    if(active_qr_action=='ingreso'){
        if(active_course_id!=-1){
            //poner ingreso en ready
            getE('confirmar-ingreso-btn-'+active_course_id).className = 'accordion-ingreso-btn ready'
            //quitar evento del click a ingreso
            getE('confirmar-ingreso-btn-'+active_course_id).removeAttribute('onclick')
            getE('confirmar-ingreso-btn-'+active_course_id).disabled = true

            //habilitar clase y click de salida
            getE('confirmar-salida-btn-'+active_course_id).className = 'accordion-ingreso-btn unlocked'
            getE('confirmar-salida-btn-'+active_course_id).disabled = false
        }
    }else if(active_qr_action=='salida'){
        if(active_course_id!=-1){
            //poner salida en ready
            getE('confirmar-salida-btn-'+active_course_id).className = 'accordion-ingreso-btn ready'
            //quitar evento del click a salida
            getE('confirmar-salida-btn-'+active_course_id).removeAttribute('onclick')
            getE('confirmar-salida-btn-'+active_course_id).disabled = true

            //habilitar clase y click de certificado
            getE('confirmar-certificado-btn-'+active_course_id).className = 'accordion-ingreso-btn unlocked'
            getE('confirmar-certificado-btn-'+active_course_id).setAttribute('href','./public/docs/certificado-curso-1.pdf')
            getE('confirmar-certificado-btn-'+active_course_id).setAttribute('target','_blank')
        }
    }
}