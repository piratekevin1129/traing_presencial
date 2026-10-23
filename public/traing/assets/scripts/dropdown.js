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
    var ii = -1;
    var jj = -1;
    var textos = []

    for(l = 0;l<dropdown_data[d].selecteditems.length;l++){
        if(dropdown_data[d].selecteditems[l].state){
            current_limit++
            textos.push(dropdown_data[d].selecteditems[l].txt)
        }
    }
    var texto = textos.join("; ")
    getE(dropdown_data[d].id).getElementsByClassName('dropdown-text')[0].innerHTML = texto

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