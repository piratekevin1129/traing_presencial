
function clickSideMenu(btn){
    var clase = btn.className
    if(clase.indexOf('menu-btn-opened')==-1){
        //abrir
        btn.className = 'menu-btn-opened'
        getE('menu-container').className = 'menu-contaniner-opened'
        getE('app').className = 'app-opened'
    }else{
        //cerrar
        btn.className = 'menu-btn-closed'
        getE('menu-container').className = 'menu-contaniner-closed'
        getE('app').className = 'app-closed'
    }
}