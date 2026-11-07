var active_course_id = -1
var active_qr_action = ''

function clickConfirmarIngreso(c){
    active_course_id = c
    active_qr_action = 'ingreso'
    confirmarBoton()
}

function clickConfirmarSalida(c){
    active_course_id = c
    active_qr_action = 'salida'
    confirmarBoton()
}

function confirmarBoton(){
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