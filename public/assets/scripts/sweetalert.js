function openModalAlert(data){
    getE('modal-dialog').className = data.status
    getE('modal-alert-title').innerHTML = data.title
    getE('modal-alert-text').innerHTML = data.text

    getE('sweetalert').className = 'sweetalert-on'
}

function closeModalAlert(){
    getE('sweetalert').className = 'sweetalert-off'
}