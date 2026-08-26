var modal_active_id = null

function openModal(btn,id_modal,title = 'default'){
    if(title=='default'){
        var btn_name = btn.getElementsByTagName('span')[0].innerHTML
        getE(id_modal).getElementsByTagName('h1')[0].innerHTML = btn_name
    }else{
        getE(id_modal).getElementsByTagName('h1')[0].innerHTML = title
    }
    getE(id_modal).className = 'modal modal-on'
    modal_active_id = id_modal
}

function closeModal(){
    if(modal_active_id!=null){
        getE(modal_active_id).className = 'modal modal-off'
    }
    modal_active_id = null
}