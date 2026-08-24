var modal_active_id = null

function openModal(id_modal){
    getE(id_modal).className = 'modal modal-on'
    modal_active_id = id_modal
}
function closeModal(){
    if(modal_active_id!=null){
        getE(modal_active_id).className = 'modal modal-off'
    }
    modal_active_id = null

    getE('modal-input-file-txt').innerHTML = 'Subir archivo excel'
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-off'
}