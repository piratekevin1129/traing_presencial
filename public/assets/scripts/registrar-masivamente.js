function updateFileInput(inpu){
    var input_parent = inpu.parentNode
    var fakepath = inpu.value
    input_parent.getElementsByTagName('p')[0].innerHTML = fakepath
}

function updateCursoFile(inpu){
    updateFileInput(inpu)
    getE('modal-tabla-preview-tab').className = 'modal-preview-tabla modal-preview-tabla-on'
}

function addCursoList(ind,list){
    var course_div = document.createElement('div')
    course_div.className = 'modal-curso-preview'
    course_div.id = 'modal-curso-preview-'+cursos_data[ind].id+'_'+list
    var h = ''
    h+='<div class="modal-curso-preview-img">'
        h+='<img src="./public/assets/images/cursos/'+cursos_data[ind].img+'" />'
    h+='</div>'
    h+='<div class="modal-curso-preview-info">'
        h+='<p id="modal-curso-name-txt">'+cursos_data[ind].nombre+'</p>'
        h+='<div>'
            h+='<button><img src="./public/assets/images/modal/time-modal-icon.svg" /></button>'
            h+='<button><img src="./public/assets/images/modal/fecha-modal-icon.svg" /></button>'
        h+='</div>'
    h+='</div>'
    //h+='<div class="modal-curso-preview-close">'
        //h+='<button type="button" onclick="removeCurso(this,'+1+')"></button>'
    //h+='</div>'
    
    course_div.innerHTML = h
    getE('modal-cursos-preview-'+list).appendChild(course_div)
}

function removeCursoList(ind,list){
    var item = getE('modal-curso-preview-'+cursos_data[ind].id+'_'+list)
    getE('modal-cursos-preview-'+list).removeChild(item)
}