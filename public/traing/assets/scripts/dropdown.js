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
            var text = items[j].getElementsByTagName('p')[0]
            var inpu = items[j].getElementsByTagName('input')[0]
            inpu.setAttribute('onchange','clickDropdownItem('+i+','+j+',this)')
            selected_items.push({val:inpu.value,txt:text.innerHTML,state:false})
        }

        dropdown_data.push({
            id:dropdown_objs[i].id,
            state:'closed',
            selecteditems:selected_items
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
    console.log(d,it)
    dropdown_data[d].selecteditems[it].state = inpu.checked
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