function toggleSwitch(obj){
    var switch_obj = obj.parentNode
    var items = switch_obj.getElementsByTagName('div')
    for(var i = 0;i<items.length;i++){
        items[i].className = 'modal-switch-option'
    }
    obj.classList.add('selected')
}

function setValueSWitch(container,value){
    console.log(container)
    var items = getE(container).getElementsByTagName('div')
    for(var i = 0;i<items.length;i++){
        var data_value = items[i].getAttribute('data-value')
        if(data_value==value){
            items[i].className = 'modal-switch-option selected'
        }else{
            items[i].className = 'modal-switch-option'
        }
    }
}

function updateFileInput(inpu){
    var input_parent = inpu.parentNode.parentNode
    var fakepath = inpu.value
    input_parent.getElementsByTagName('p')[0].innerHTML = fakepath
}

function resetFileInput(inpu){
    var formu = getE(inpu).parentNode
    
    formu.reset()
    var inpu_container = formu.parentNode
    inpu_container.getElementsByTagName('p')[0].innerHTML = 'Subir archivo excel'
}