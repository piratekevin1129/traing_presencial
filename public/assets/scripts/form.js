function toggleSwitch(obj){
    var switch_obj = obj.parentNode
    var items = switch_obj.getElementsByTagName('div')
    for(var i = 0;i<items.length;i++){
        items[i].className = 'modal-switch-option'
    }
    obj.classList.add('selected')
}