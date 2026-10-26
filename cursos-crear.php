<?php $menu_active = [2,2];?>
<?php require('./data/users.php');?>
<?php require('./data/teachers.php');?>
<?php require('./data/headquarters.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include './layouts/css.php'; ?>
    <?php include './layouts/scripts.php'; ?>
    <link href="./public/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/form.css" rel="stylesheet" type="text/css" />
    <link href="./public/traing/assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="./public/traing/assets/css/presencial.css" rel="stylesheet" type="text/css" />
    <link href="./public/traing/assets/css/dropdown.css" rel="stylesheet" type="text/css" />
    <link href="./public/traing/assets/css/switch.css" rel="stylesheet" type="text/css" />
    <link href="./public/traing/assets/css/calendario.css" rel="stylesheet" type="text/css" />

    <link href="./public/assets/css/tabla.css" rel="stylesheet" type="text/css" />

    <title>Traing Presencial - Crear curso</title>
</head>
<body>
    <div class="main-container">
        <?php include './layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include './layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">CREAR CURSO/INDUCCIONES</h1>
                <div class="app-container">
                    <div class="col-mid">
                        <div class="input">
                            <input placeholder="Nombre del curso" type="text" maxlength="100" autocomplete="off" name="nombre" />
                            <label>Mínimo 3 máximo 100 caracteres</label>
                        </div>
                    </div>

                    <div class="steps-container">
                        <div class="step-item selected">
                            <div class="step-line"></div>
                            <div class="step-item-icon">
                                <div></div>
                            </div>
                            <p class="step-text">Información básica</p>
                        </div>
                        <div class="step-item">
                            <div class="step-line"></div>
                            <div class="step-item-icon">
                                <div></div>
                            </div>
                            <p class="step-text">Contenidos</p>
                        </div>
                        <!--<div class="step-item">
                            <div class="step-line"></div>
                            <div class="step-item-icon">
                                <div></div>
                            </div>
                            <p class="step-text">Certificado</p>
                        </div>
                        <div class="step-item">
                            <div class="step-line"></div>
                            <div class="step-item-icon">
                                <div></div>
                            </div>
                            <p class="step-text">Asignación</p>
                        </div>-->
                    </div>

                    <div class="row">
                        <!--70%-->
                        <div class="col-formulario">
                            <div class="textarea">
                                <textarea placeholder="Descripción del curso" autocomplete="off" name="descripcion"></textarea>
                                <label>Mínimo 3 máximo 500 caracteres</label>
                            </div>

                            <div class="hr"></div>
                        
                            <p class="text">Asigna los responsables encargados de tu curso</p>

                            <div class="col-mid">
                                <div class="dropdown" id="dropdown-encargado" data-limit="-1">
                                    <div class="dropdown-list">
                                        <div class="dropdown-list-item">
                                            <label class="dropdown-list-radio">
                                                <p>Opción 1</p>
                                                <input value="1" type="checkbox" name="encargado" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="dropdown-list-item">
                                            <label class="dropdown-list-radio">
                                                <p>Opción 2</p>
                                                <input value="2" type="checkbox" name="encargado" />
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="dropdown-box">
                                        <div class="dropdown-text">Selecciona responsables</div>
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--30%-->
                        <div class="col-imagen">
                            <div class="imagen-curso">
                                <img src="./public/assets/images/cursos/thumbnail-1.jpg" />
                            </div>
                        </div>
                    </div>

                    <div class="hr"></div>

                    <div class="full">
                        <p class="text">Opciones del curso presencial</p>
        
                        <div class="switch">
                            <label class="switch-radio">
                                <p>Repetir curso</p>
                                <input onchange="toggleRepetir(this)" value="0" type="checkbox" name="repetircurso" />
                                <span></span>
                            </label>
                        </div>

                        <div id="curso-presencial-opciones-repetir" class="content-hidden">
                            <div class="col-mid">
                                <div class="select">
                                    <select name="periodo" onchange="selectRepetirPeriodo(this)">
                                        <option value="0">Selecciona una opción</option>
                                        <option value="1">Todos los dias</option>
                                        <option value="2">Dos veces a la semana</option>
                                        <option value="3">Una vez a la semana</option>
                                        <option value="4">Cada 8 días</option>
                                        <option value="5">Cada 15 días</option>
                                        <option value="6">Una vez al mes</option>
                                    </select>
                                    <label>Seleccione la secuencia para repetir el curso (Mes de <span id="current-mes-txt"></span>)</label>
                                </div>
                            </div>

                            <div id="curso-presencial-opciones-repetir-o1" class="content-hidden">
                                <!--al seleccionar todos los dias-->
                                <div class="switch">
                                    <label class="switch-radio">
                                        <p>Incluir sábados y domingos</p>
                                        <input onchange="toggleRepetirO1(this)" value="0" type="checkbox" />
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div id="curso-presencial-opciones-repetir-o2" class="content-hidden">
                                <!--al seleccionar dos veces a la semana-->
                                <div class="col-mid">
                                    <div class="dropdown" id="dropdown-dias-semana-o2" data-limit="2">
                                        <div class="dropdown-list">
                                            <div class="dropdown-list-item">
                                                <label class="dropdown-list-radio">
                                                    <p>Domingo</p>
                                                    <input value="0" type="checkbox" name="dias-semana-o2" />
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="dropdown-list-item">
                                                <label class="dropdown-list-radio">
                                                    <p>Lunes</p>
                                                    <input value="1" type="checkbox" name="dias-semana-o2" />
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="dropdown-list-item">
                                                <label class="dropdown-list-radio">
                                                    <p>Martes</p>
                                                    <input value="2" type="checkbox" name="dias-semana-o2" />
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="dropdown-list-item">
                                                <label class="dropdown-list-radio">
                                                    <p>Miércoles</p>
                                                    <input value="3" type="checkbox" name="dias-semana-o2" />
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="dropdown-list-item">
                                                <label class="dropdown-list-radio">
                                                    <p>Jueves</p>
                                                    <input value="4" type="checkbox" name="dias-semana-o2" />
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="dropdown-list-item">
                                                <label class="dropdown-list-radio">
                                                    <p>Viernes</p>
                                                    <input value="5" type="checkbox" name="dias-semana-o2" />
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="dropdown-list-item">
                                                <label class="dropdown-list-radio">
                                                    <p>Sábado</p>
                                                    <input value="6" type="checkbox" name="dias-semana-o2" />
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="dropdown-box">
                                            <div class="dropdown-text">Selecciona los días</div>
                                            <div class="dropdown-arrow"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="curso-presencial-opciones-repetir-o3" class="content-hidden">
                                <!--al seleccionar una vez a la semana-->
                                <div class="col-mid">
                                    <div class="select">
                                        <select name="periodo-o3"><!--onchange="selectRepetirOpcion3(this)"-->
                                            <option value="0">Selecciona una opción</option>
                                            <option value="1">Domingo</option>
                                            <option value="2">Lunes</option>
                                            <option value="3">Martes</option>
                                            <option value="4">Miércoles</option>
                                            <option value="5">Jueves</option>
                                            <option value="6">Viernes</option>
                                            <option value="7">Sábado</option>
                                        </select>
                                        <label>Selecciona el día de la semana</label>
                                    </div>
                                </div>
                            </div>

                            <div id="curso-presencial-opciones-repetir-o4" class="content-hidden">
                                <!--al seleccionar cada 8 dias-->
                                <div class="col-mid">
                                    <div class="select">
                                        <select name="periodo-o4"><!--onchange="selectRepetirOpcion4(this)"-->
                                            <option value="0">Selecciona una opción</option>
                                            <option value="1">Domingo</option>
                                            <option value="2 selected">Lunes</option>
                                            <option value="3">Martes</option>
                                            <option value="4">Miércoles</option>
                                            <option value="5">Jueves</option>
                                            <option value="6">Viernes</option>
                                            <option value="7">Sábado</option>
                                        </select>
                                        <label>Comenzar desde el dia Lunes</label>
                                    </div>
                                </div>
                            </div>

                            <div id="curso-presencial-opciones-repetir-o5" class="content-hidden">
                                <!--al seleccionar cada 15 dias-->
                                <div class="col-mid">
                                    <div class="select">
                                        <select name="periodo-o5"><!--onchange="selectRepetirOpcion5(this)"-->
                                            <option value="0">Selecciona una opción</option>
                                            <option value="1">Domingo</option>
                                            <option value="2 selected">Lunes</option>
                                            <option value="3">Martes</option>
                                            <option value="4">Miércoles</option>
                                            <option value="5">Jueves</option>
                                            <option value="6">Viernes</option>
                                            <option value="7">Sábado</option>
                                        </select>
                                        <label>Comenzar desde el dia Lunes</label>
                                    </div>
                                </div>
                            </div>

                            <div id="curso-presencial-opciones-periodo" class="content-visible">
                                <div class="calendario-row">
                                    <div class="calendario-col">
                                        <div class="calendario" id="curso-presencial-calendario"></div>

                                        <div class="br"></div>
                                        <div class="calendario-info-container">
                                            <div style="background-color: var(--naranja);"></div>
                                            <p>Días con curso agendado</p>
                                        </div>
                                        <div class="calendario-info-container">
                                            <div style="background-color: var(--azulclaro);"></div>
                                            <p>Día seleccionado</p>
                                        </div>
                                    </div>
                                    
                                    <div class="calendario-data-off" id="calendario-data">
                                        <form id="calendario-data-form">
                                            <p class="text-label">Horario del curso</p>
                                            <div class="col-flex">
                                                <div class="col-hora">
                                                    <div class="input">
                                                        <input id="hora-inp" placeholder="2" type="text" maxlength="2" autocomplete="off" name="hora" />
                                                        <label>Hora (1-12)</label>
                                                    </div>
                                                </div>
                                                <div class="col-hora">
                                                    <div class="input">
                                                        <input id="minutos-inp" placeholder="00" type="text" maxlength="2" autocomplete="off" name="minutos" />
                                                        <label>Minutos (0-59)</label>
                                                    </div>
                                                </div>
                                                <div class="col-hora">
                                                    <div class="select">
                                                        <select name="horario" id="horario-sel">
                                                            <option value="0">Selecciona</option>
                                                            <option value="1">A.M</option>
                                                            <option value="2">P.M</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="br"></div>
    
                                            <!---->
                                            <p class="text-label">Asigna un facilitador</p>
                                            <div class="col-mid">
                                                <div class="select">
                                                    <select name="facilitador" id="facilitador-sel">
                                                        <option value="0">Selecciona</option>
                                                        <option value="1">Armando Mendoza</option>
                                                        <option value="2">Marcela Valencia</option>
                                                        <option value="3">Beatriz Pinzón</option>
                                                    </select>
                                                </div>
                                            </div>
    
                                            <div class="br"></div>
    
                                            <!---->
                                            <p class="text-label">Selecciona una Sede</p>
                                            <div class="col-mid">
                                                <div class="select">
                                                    <select name="sede" id="sede-sel">
                                                        <option value="0">Selecciona</option>
                                                        <option value="1">Sede 1</option>
                                                        <option value="2">Sede 2</option>
                                                        <option value="3">Sede 3</option>
                                                    </select>
                                                </div>
                                            </div>
    
                                            <div class="br"></div>
    
                                            <!---->
                                            <p class="text-label">Selecciona una Aula</p>
                                            <div class="col-mid">
                                                <div class="select">
                                                    <select name="aula" id="aula-txt">
                                                        <option value="0">Selecciona</option>
                                                        <option value="1">Aula 1</option>
                                                        <option value="2">Aula 2</option>
                                                        <option value="3">Aula 3</option>
                                                    </select>
                                                </div>
                                            </div>
    
                                            <div id="calendario-data-options" class="calendario-data-option-eliminar">
                                                <button class="calendario-eliminar-btn" type="button" onclick="eliminarCharla()">
                                                    <img src="./public/traing/assets/images/delete-icon.svg" />
                                                    <span>Eliminar</span>
                                                </button>
                                                <button class="calendario-guardar-btn" type="button" onclick="guardarCharla()">
                                                    <span>Guardar</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="br"></div>
                        <p class="text">Estudiantes para esta charla</p>
                        <p class="sublabel">Selecciona los estudiantes para esta charla</p>
                        
                        <div class="tabla-container">
                            <table id="tabla-usuarios" class="traing-tabla">
                                <thead>
                                    <tr>
                                        <th style="width: 3%;">
                                            <!--input radio-->
                                        </th>
                                        <th style="width: 12%;">
                                            <span>Tipo trabajador</span>
                                            <button></button>
                                        </th>
                                        <th style="width: 12%;">
                                            <span>Nombres</span>
                                            <button></button>
                                        </th>
                                        <th style="width: 12%;">
                                            <span>Apellido</span>
                                            <button></button>
                                        </th>
                                        <th style="width: 12%;">
                                            <span>Documento</span>
                                            <button></button>
                                        </th>
                                        <th style="width: 14%;">
                                            <span>Ciudad</span>
                                            <button></button>
                                        </th>
                                        <th style="width: 12%;">
                                            <span>Empresa</span>
                                            <button></button>
                                        </th>
                                        <th style="width: 23%;">
                                            <span>Correo electrónico</span>
                                            <button></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $user){?>
                                    <tr id="tabla-usuario-row-<?php echo $user[0]?>">
                                        <td class="td-checkbox">
                                            <label class="traing-check">
                                                <input type="checkbox" name="usuario" value="<?php echo $user[0]?>" autocomplete="off" />
                                                <span class="traing-check-box"></span>
                                                <span class="traing-check-name"></span>
                                            </label>
                                        </td>
                                        <td><?php echo $tipos_trabajador[$user[1]]?></td>
                                        <td><?php echo $user[2]?></td>
                                        <td><?php echo $user[3]?></td>
                                        <td><?php echo $user[5]?></td>
                                        <td><?php echo $user[6]?></td>
                                        <td><?php echo $user[7]?></td>
                                        <td><?php echo $user[8]?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="hr"></div>

                        <div class="col-right">
                            <button class="boton-principal" onclick="guardarCurso()">
                                <span>Guardar</span>
                            </button>
                        </div>
                        <!--end-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--modales-->

    <script src="./public/traing/assets/scripts/dropdown.js"></script>
    <script src="./public/traing/assets/scripts/calendario.js"></script>
    <script>
        var usuarios_data = []
        <?php foreach($users as $user){?>
        usuarios_data.push({
            id:<?php echo $user[0]?>,
            tipo:"<?php echo $user[1]?>",
            nombres:"<?php echo $user[2]?>",
            apellidos:"<?php echo $user[3]?>",
            tipodoc:"<?php echo $user[4]?>",
            documento:<?php echo $user[5]?>,
            ciudad:"<?php echo $user[6]?>",
            empresa:"<?php echo $user[7]?>",
            correo:"<?php echo $user[8]?>",
        })
        <?php } ?>

        window.onload = function(){
            setDropdown()
            setCalendario('curso-presencial-calendario')
            createCharlas()
        }

        var current_mes = new Date().getMonth()
        getE('current-mes-txt').innerHTML = meses[current_mes].m

        function toggleRepetir(inpu){
            if(inpu.checked){
                getE('curso-presencial-opciones-repetir').className = 'content-visible'
            }else{
                getE('curso-presencial-opciones-repetir').className = 'content-hidden'
            }    
        }

        function selectRepetirPeriodo(inpu){
            var selected_value = String(inpu.value)

            getE('curso-presencial-opciones-repetir-o1').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o2').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o3').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o4').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o5').className = 'content-hidden'
            
            getE('curso-presencial-opciones-repetir-o'+selected_value).className = 'content-visible'
        }

        function toggleRepetirO1(inpu){

        }

        function guardarCurso(){

        }
        
    </script>
</body>
</html>