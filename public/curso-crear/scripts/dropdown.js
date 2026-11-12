var i = 0;
var j = 0;
var dropdown_data = []
var dropdown_active = null

function setDropdown(){
    var dropdown_objs = document.body.getElementsByClassName('dropdown')
    for(i = 0;i<dropdown_objs.length;i++){
        var selected_items = []
        dropdown_objs[i].setAttribute('data-ind',i)
        dropdown_objs[i].getElementsByClassName('dropdown-box')[0].setAttribute('onclick','clickDropdown(this)')
        var list = dropdown_objs[i].getElementsByClassName('dropdown-list')[0]
        var items = list.getElementsByClassName('dropdown-list-item')
        for(j = 0;j<items.length;j++){
            items[j].id = 'dropdown-list-item-'+i+'_'+j
            var text = items[j].getElementsByTagName('p')[0]
            var inpu = items[j].getElementsByTagName('input')[0]
            inpu.setAttribute('onchange','clickDropdownItem('+i+','+j+',this)')
            selected_items.push({i:i,j:j,val:inpu.value,txt:text.innerHTML,state:false})
        }

        dropdown_data.push({
            id:dropdown_objs[i].id,
            state:'closed',
            selecteditems:selected_items,
            limit:Number(dropdown_objs[i].getAttribute('data-limit'))
        })
    }
}

function getDropdownItems(idname,type='n',len='short'){
    var dropdown_obj = getE(idname)
    var dropdown_ind = dropdown_obj.getAttribute('data-ind')
    var list = []
    for(var l = 0;l<dropdown_data[dropdown_ind].selecteditems.length;l++){
        if(dropdown_data[dropdown_ind].selecteditems[l].state){
            //list.push({val:dropdown_data[dropdown_ind].selecteditems[l].val})
            if(type=='n'){
                list.push(parseInt(dropdown_data[dropdown_ind].selecteditems[l].val))
            }else if(type=='s'){
                list.push(String(dropdown_data[dropdown_ind].selecteditems[l].val))
            }
        }
    }
    return list
}

function clickDropdown(box){
    var dropdown_div = box.parentNode
    dropdown_div.className = 'dropdown dropdown-open'
    dropdown_active = dropdown_div

    window.addEventListener('click',clickWindow,true)
}

function clickDropdownItem(d,it,inpu){
    //console.log(d,it)
    dropdown_data[d].selecteditems[it].state = inpu.checked
    //checkear limite
    //mirar cantidad checkeados
    var current_limit = 0;
    var l = 0;
    var textos = []

    for(l = 0;l<dropdown_data[d].selecteditems.length;l++){
        if(dropdown_data[d].selecteditems[l].state){
            current_limit++
            textos.push(dropdown_data[d].selecteditems[l].txt)
        }
    }
    var texto = 'Seleccionar'
    if(textos.length>0){
        texto = textos.join("; ")
    }
    getE(dropdown_data[d].id).getElementsByClassName('dropdown-text')[0].innerHTML = texto
    limitDropdown(d,current_limit)
}

function limitDropdown(d,current_limit){
    var ii = -1;
    var jj = -1;
    var l = 0;
    if(current_limit==dropdown_data[d].limit){
        //bloqear todo
        for(l = 0;l<dropdown_data[d].selecteditems.length;l++){
            ii = dropdown_data[d].selecteditems[l].i
            jj = dropdown_data[d].selecteditems[l].j
            if(dropdown_data[d].selecteditems[l].state){
                getE('dropdown-list-item-'+ii+'_'+jj).className = 'dropdown-list-item'
                getE('dropdown-list-item-'+ii+'_'+jj).getElementsByTagName('input')[0].disabled = false
            }else{
                getE('dropdown-list-item-'+ii+'_'+jj).className = 'dropdown-list-item disabled'
                getE('dropdown-list-item-'+ii+'_'+jj).getElementsByTagName('input')[0].disabled = true
            }
        }
    }else if(current_limit<dropdown_data[d].limit){
        //desbloquear todo
        for(l = 0;l<dropdown_data[d].selecteditems.length;l++){
            ii = dropdown_data[d].selecteditems[l].i
            jj = dropdown_data[d].selecteditems[l].j
            getE('dropdown-list-item-'+ii+'_'+jj).className = 'dropdown-list-item'
            getE('dropdown-list-item-'+ii+'_'+jj).getElementsByTagName('input')[0].disabled = false
        }
    }
}

function clickWindow(event){
    var clase = event.target.className
    if(dropdown_active!=null){
        if(!dropdown_active.contains(event.target)){
            dropdown_active.className = 'dropdown'
            dropdown_active = null
            window.removeEventListener('click',clickWindow,true)
        }
    }
}

function editDropdown(idname,values){
    var dropdown_obj = getE(idname)
    var dropdown_ind = dropdown_obj.getAttribute('data-ind')
    var current_limit = 0;
    var textos = []

    for(i = 0;i<values.length;i++){
        for(j = 0;j<dropdown_data[dropdown_ind].selecteditems.length;j++){
            if(dropdown_data[dropdown_ind].selecteditems[j].val==values[i]){
                dropdown_data[dropdown_ind].selecteditems[j].state = true
                var ii = dropdown_data[dropdown_ind].selecteditems[j].i
                var jj = dropdown_data[dropdown_ind].selecteditems[j].j
                var item_id = getE('dropdown-list-item-'+ii+'_'+jj)
                var item_inpu = item_id.getElementsByTagName('input')[0]
                var item_text = item_id.getElementsByTagName('p')[0]
                item_inpu.checked = true
                textos.push(item_text.innerHTML)
                current_limit++
            }
        }
    }

    var texto = 'Seleccionar'
    if(textos.length>0){
        texto = textos.join("; ")
    }
    getE(idname).getElementsByClassName('dropdown-text')[0].innerHTML = texto
    limitDropdown(dropdown_ind,current_limit)
}