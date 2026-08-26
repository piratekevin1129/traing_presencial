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

function cleanDropdown(id_dropdown){
    console.log(id_dropdown)
    var dropdown_box = getE(id_dropdown).getElementsByClassName('modal-dropdown-box')[0]
    var dropdown_items = dropdown_box.getElementsByTagName('div')
    for(var i = 0;i<dropdown_items.length;i++){
        dropdown_items[i].removeAttribute('class')
    }
}


