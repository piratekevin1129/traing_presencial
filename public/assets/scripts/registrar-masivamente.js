function updateCursoPreview(obj){
    var value_selected = obj.value
    var data_selected = obj.options[obj.selectedIndex]
    var text_selected = data_selected.text
    var img_selected = data_selected.getAttribute('data-img')

    getE('modal-curso-name-txt').innerHTML = text_selected
    getE('modal-curso-img').src = './public/assets/images/cursos/'+img_selected
    
}

function updateCursoFile(obj){
    getE('modal-input-file-txt').innerHTML = obj.value
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-on'
}