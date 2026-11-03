function openModalAlert(data){
    getE('modal-dialog').className = data.status
    getE('modal-alert-title').innerHTML = data.title
    getE('modal-alert-text').innerHTML = data.text

    if(data.action!=undefined&&data.action!=null){
        getE('modal-alert-btn').setAttribute('onclick',String(data.action+'()'))
    }else{
        getE('modal-alert-btn').setAttribute('onclick','closeModalAlert()')
    }

    getE('sweetalert').className = 'sweetalert-on'
}

function closeModalAlert(){
    getE('sweetalert').className = 'sweetalert-off'
}