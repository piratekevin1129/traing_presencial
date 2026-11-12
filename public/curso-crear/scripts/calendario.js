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

var current_date = new Date()
var current_mes = current_date.getMonth()
var current_year = current_date.getFullYear()
var current_day = current_date.getDate()

var custom_date = new Date(
    String(current_year+'-'+meses[current_mes].f+'-1')
)
var first_day = custom_date.getDay()



function setCalendario(idname,events = 'yes'){
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
    var dia_semana = 0
   
    //dias vacios
    for(i = 0;i<first_day;i++){
        var dia = document.createElement('div')
        dias.appendChild(dia)
        dia_semana++
        if(dia_semana==7){
            dia_semana = 0
        }
    }
    
    for(i = 1;i<=meses[current_mes].n;i++){
        var dia1 = document.createElement('div')
        dia1.id = 'calendario-date-'+i
        dia1.setAttribute('data-d',dia_semana)
        var h = ''
        h+='<div id="calendario-date-'+i+'-obj"><span>'+i+'</span></div>'
        if(i<current_date.getDate()){
            dia1.className = 'dia-bloqueado'
        }else{
            dia1.className = 'dia-normal'
            if(events=='yes'){
                h+='<button class="calendario-date-btn1" type="button" onclick="addCharla('+i+')"><img src="'+base+'public/curso-crear/images/add-icon.svg" /></button>'
                h+='<button class="calendario-date-btn2" type="button"><img src="'+base+'public/curso-crear/images/ver-icon.svg" /></button>'
            }
        }
        dia1.innerHTML = h
        dias.appendChild(dia1)

        dia_semana++
        if(dia_semana==7){
            dia_semana = 0
        }
    }

    getE(idname).appendChild(mes_txt)
    getE(idname).appendChild(dias_s)
    getE(idname).appendChild(dias)
}

