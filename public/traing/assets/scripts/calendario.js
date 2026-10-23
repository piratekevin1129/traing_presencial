var meses = [
    {m:'Enero',n:31,f:'01'},
    {m:'Febrero',n:28,f:'02'},
    {m:'Marzo',n:31,f:'03'},
    {m:'Abril',n:30,f:'04'},
    {m:'Mayo',n:31,f:'05'},
    {m:'Junio',n:30,f:'06'},
    {m:'Julio',n:31,f:'07'},
    {m:'Agosto',n:31,f:'08'},
    {m:'Septiembre',n:30,f:'09'},
    {m:'Octubre',n:31,f:'10'},
    {m:'Noviembre',n:30,f:'11'},
    {m:'Diciembre',n:31,f:'12'}
]

var dias_semana = [{
    short:'D',
    mid:'DO',
    full:'Domingo'
},{
    short:'L',
    mid:'LU',
    full:'Lunes'
},{
    short:'M',
    mid:'MA',
    full:'Martes'
},{
    short:'M',
    mid:'MI',
    full:'Miércoles'
},{
    short:'J',
    mid:'JU',
    full:'Jueves'
},{
    short:'V',
    mid:'VI',
    full:'Viernes'
},{
    short:'S',
    mid:'SA',
    full:'Sábado'
}]

function setCalendario(idname){
    var mes_txt = document.createElement('div')
    mes_txt.className = 'mes-container'
    mes_txt.innerHTML = '<p>'+meses[current_mes].m+'</p>'

    var dias_s = document.createElement('div')
    dias_s.className = 'dias-semana-container'
    for(i = 0;i<dias_semana.length;i++){
        var dia_s = document.createElement('div')
        dia_s.innerHTML = '<div><span>'+dias_semana[i].short+'</span></div>'
        dias_s.appendChild(dia_s)
    }

    var dias = document.createElement('div')
    dias.className = 'dias-container'

    var current_date = new Date()
    var custom_date = new Date(
        String(current_date.getUTCFullYear()+'-'+meses[current_mes].f+'-1')
    )
    var first_day = custom_date.getDay()
    
    //dias vacios
    for(i = 0;i<first_day;i++){
        var dia = document.createElement('div')
        dias.appendChild(dia)
    }
    for(i = 1;i<=meses[current_mes].n;i++){
        var dia1 = document.createElement('div')
        dia1.innerHTML = '<div><span>'+i+'</span></div>'
        dias.appendChild(dia1)
    }

    getE(idname).appendChild(mes_txt)
    getE(idname).appendChild(dias_s)
    getE(idname).appendChild(dias)
}

