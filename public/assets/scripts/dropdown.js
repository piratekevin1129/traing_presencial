function toggleDropdown(obj,status){
    if(status=='on'){
        obj.className = 'modal-dropdown modal-dropdown-expanded'
    }else if(status=='off'){
        obj.className = 'modal-dropdown modal-dropdown-collapsed'
    }
}

function dropdownClickItem(obj,ind,list){
    var dropdown = obj.parentNode.parentNode
    var dropdown_txt = dropdown.getElementsByTagName('span')[0]
    //dropdown_txt.innerHTML = item.innerHTML

    if(obj.className.indexOf('selected')==-1){
        //seleccionar
        obj.className = 'selected'
        addCursoList(ind,list)
    }else{
        //quitar
        obj.removeAttribute('class')
        removeCursoList(ind,list)
    }
    
    dropdown.blur()
}



