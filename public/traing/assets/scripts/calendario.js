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
        String(current_date.getFullYear()+'-'+meses[current_mes].f+'-1')
    )
    var first_day = custom_date.getDay()
    
    //dias vacios
    for(i = 0;i<first_day;i++){
        var dia = document.createElement('div')
        dias.appendChild(dia)
    }
    for(i = 1;i<=meses[current_mes].n;i++){
        var dia1 = document.createElement('div')
        dia1.id = 'calendario-date-'+i
        var h = ''
        h+='<div id="calendario-date-'+i+'-obj"><span>'+i+'</span></div>'
        if(i<current_date.getDate()){
            dia1.className = 'dia-bloqueado'
        }else{
            dia1.className = 'dia-normal'
            h+='<button class="calendario-date-btn1" type="button" onclick="addCharla('+i+')"><img src="./public/traing/assets/images/add-icon.svg" /></button>'
            h+='<button class="calendario-date-btn2" type="button"><img src="./public/traing/assets/images/ver-icon.svg" /></button>'
        }
        dia1.innerHTML = h
        dias.appendChild(dia1)
    }

    getE(idname).appendChild(mes_txt)
    getE(idname).appendChild(dias_s)
    getE(idname).appendChild(dias)
}

var charlas_data = []

function getCharlaId(id){
    var ind = -1
    for(var c = 0;c<charlas_data.length;c++){
        if(charlas_data[c].id==id){
            ind = c
        }
    }
    return ind
}

function createCharlas(){
    charlas_data.push({
        id:1,
        ano:2026,
        mes:9,
        fecha:26,
        dia:0,
        hora:15,
        minutos:0,
        horario:1,
        facilitador:1,
        sede:1,
        aula:1,
        estudiantes:[]
    })
    for(i = 0;i<charlas_data.length;i++){
        getE('calendario-date-'+charlas_data[i].fecha).className = 'dia-escogido'
        getE('calendario-date-'+charlas_data[i].fecha).getElementsByClassName('calendario-date-btn2')[0].setAttribute('onclick','verCharla('+charlas_data[i].id+')')
        
    }
}

var current_date_selected = 0
var current_date_status = ''

function addCharla(dd){
    getE('calendario-data-form').reset()

    activateCharla(dd,'normal')
    getE('calendario-data-options').className = 'calendario-data-option-guardar'
}

function verCharla(id){
    var ind = getCharlaId(id)
    console.log(ind)
    if(ind!=-1){
        getE('minutos-inp').value = charlas_data[ind].minutos
        getE('hora-inp').value = charlas_data[ind].hora
        getE('horario-sel').value = charlas_data[ind].horario
        getE('facilitador-sel').value = charlas_data[ind].facilitador
        getE('sede-sel').value = charlas_data[ind].sede
        getE('aula-txt').value = charlas_data[ind].aula
    }

    activateCharla(charlas_data[ind].fecha,'escogido')
    getE('calendario-data-options').className = 'calendario-data-option-eliminar'
}

function activateCharla(dd,status){
    //mirar si hay uno activo
    if(current_date_selected!=0){
        getE('calendario-date-'+current_date_selected).className = 'dia-'+current_date_status
    }
    getE('calendario-data').className = 'calendario-data-on'
    current_date_selected = dd
    current_date_status = status
    getE('calendario-date-'+dd).className = 'dia-seleccionado'
}

function eliminarCharla(){
    var ind = getCharlaId(current_date_selected)
    getE('calendario-date-'+current_date_selected).getElementsByClassName('calendario-date-btn2')[0].removeAttribute('onclick')
    getE('calendario-date-'+current_date_selected).className = 'dia-normal'
    if(ind!=-1){
        charlas_data.splice(ind,1)
    }
    getE('calendario-data').className = 'calendario-data-off'
    getE('calendario-data-form').reset()
    current_date_selected = 0
    current_date_status = ''
}

function guardarCharla(){
    var id = (charlas_data.length+1)
    var dia_semana = new Date(
        String('2026-'+meses[current_mes].f+'-'+current_date_selected)
    ).getDate()
    charlas_data.push({
        id:id,
        ano:2026,
        mes:9,
        fecha:current_date_selected,
        dia:dia_semana,
        hora:15,
        minutos:0,
        horario:1,
        facilitador:1,
        sede:1,
        aula:1,
        estudiantes:[]
    })
    getE('calendario-date-'+current_date_selected).getElementsByClassName('calendario-date-btn2')[0].setAttribute('onclick','verCharla('+id+')')

    getE('calendario-date-'+current_date_selected).className = 'dia-escogido'
    getE('calendario-data').className = 'calendario-data-off'
    getE('calendario-data-form').reset()
    current_date_selected = 0
    current_date_status = ''
}