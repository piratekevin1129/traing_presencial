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
        obj.className = 'modal-dropdown-item selected'
        addCursoList(ind,list)
    }else{
        //quitar
        obj.className = 'modal-dropdown-item'
        removeCursoList(ind,list)
    }
    
    dropdown.blur()
}

function getDropdownData(obj_name){
    var list = []
    var items = getE(obj_name).getElementsByClassName('modal-dropdown-box')[0].getElementsByClassName('modal-dropdown-item')
    
    for(var l = 0;l<items.length;l++){
        if(items[l].className.indexOf('selected')!=-1){
            list.push(Number(items[l].getAttribute('data-value')))
        }
    }
    return list
}

function cleanDropdown(id_dropdown){
    //console.log(id_dropdown)
    var dropdown_box = getE(id_dropdown).getElementsByClassName('modal-dropdown-box')[0]
    var dropdown_items = dropdown_box.getElementsByTagName('div')
    for(var i = 0;i<dropdown_items.length;i++){
        dropdown_items[i].className = 'modal-dropdown-item'
    }
}


