function toggleAccordion(obj_head){
    var accordion = obj_head.parentNode
    if(accordion.className.indexOf('expanded')==-1){
        //abrir
        accordion.className = 'accordion-container accordion-container-expanded'
    }else{
        //cerrar
        accordion.className = 'accordion-container accordion-container-collapsed'
    }
}