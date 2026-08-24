
function clickSideMenu(btn){
    var clase = btn.className
    if(clase.indexOf('menu-btn-opened')==-1){
        //abrir
        btn.className = 'menu-btn-opened'
        document.getElementById('menu-container').className = 'menu-contaniner-opened'
        document.getElementById('app').className = 'app-opened'
    }else{
        //cerrar
        btn.className = 'menu-btn-closed'
        document.getElementById('menu-container').className = 'menu-contaniner-closed'
        document.getElementById('app').className = 'app-closed'
    }
}