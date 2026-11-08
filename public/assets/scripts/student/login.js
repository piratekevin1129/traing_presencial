function clickIngresar(){
    var cedula = getE('cedula-txt').value
    if(is_empty(cedula)){
        openModalAlert({
            status:'warning',
            title:'¡No tan rápido!',
            text:"Debes escribir un número de documento"
        });
    }else{
        $.ajax({
            method: 'POST',
            url: base+'api/controllers/student.php?action=login',
            data:{
                cedula:cedula,
                courseid:getE('curso-txt').value
            },
            success: function(response){
                var response_data = JSON.parse(response)
                if(response_data.status=='success'){
                    window.location.href = './curso-user.php';
                }else{
                    openModalAlert({
                        status:'warning',
                        title:'¡Información incorrecta!',
                        text:response_data.data
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log("Error de servidor");
                console.log(xhr);
            }
        })
    }
}