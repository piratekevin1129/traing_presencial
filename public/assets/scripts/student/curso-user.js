function clickConfirmarIngreso(c){
    if(!confirming_entry){
        //poner ingreso en ready
        setButtonIngresoLoading()
        confirming_entry = true
    
        $.ajax({
            method: 'POST',
            url: base+'api/controllers/student.php?action=confirmEntry',
            success: function(response){
                var response_data = JSON.parse(response)
                if(response_data.status=='success'){
                    setButtonIngresoReady()
                    openModalAlert({
                        status:'success',
                        title:'Ingreso confirmado',
                        text:'Hora de ingreso: '+response_data.data.horaentrada
                    })
                }else{
                    openModalAlert({
                        status:'warning',
                        title:'¡Algo salió mal!',
                        text:"Ocurrió un error confirmando el ingreso"
                    });
                    setButtonIngresoDefault()
                }
                confirming_entry = false
            },
            error: function(xhr, status, error) {
                console.log("Error de servidor");
                console.log(xhr);
                openModalAlert({
                    status:'warning',
                    title:'¡Algo salió mal!',
                    text:"No se pudo confirmar el ingreso"
                });
                setButtonIngresoDefault()
                confirming_entry = false
            }
        })
    }
}


//habilitar clase y click de certificado
//getE('confirmar-certificado-btn-'+active_course_id).className = 'accordion-ingreso-btn unlocked'
//getE('confirmar-certificado-btn-'+active_course_id).setAttribute('href','./public/docs/certificado-curso-1.pdf')
//getE('confirmar-certificado-btn-'+active_course_id).setAttribute('target','_blank')