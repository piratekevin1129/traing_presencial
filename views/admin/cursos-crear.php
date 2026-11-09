<?php $menu_active = [2,2];?>
<?php require('../../api/env.php');?>
<?php require('../../data/users.php');?>
<?php require('../../data/teachers.php');?>
<?php require('../../data/headquarters.php');?>
<?php require('../../data/rooms.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../layouts/css.php'; ?>
    <?php include '../../layouts/scripts.php'; ?>
    <link href="<?php echo $base ?>public/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/form.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/traing/assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/traing/assets/css/presencial.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/traing/assets/css/dropdown.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/traing/assets/css/switch.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/traing/assets/css/calendario.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo $base ?>public/assets/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/tabla.css" rel="stylesheet" type="text/css" />

    <title>Traing Presencial - Crear curso</title>
</head>
<body>
    <div class="main-container">
        <?php include '../../layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include '../../layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">CREAR CURSO/INDUCCIÓN</h1>
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

                            <br>

                            <p class="text">Duración aproximada del curso</p>
                            <div class="col-flex">
                                <div class="col-tiempo">
                                    <div class="input">
                                        <input id="tiempo-inp" placeholder="10" min="1" max="100" type="number" maxlength="3" autocomplete="off" name="tiempo" />
                                        <label>Tiempo (1-100)</label>
                                    </div>
                                </div>
                                <div class="col-tiempo">
                                    <div class="select">
                                        <select name="tiempo2" id="tiempo2-sel">
                                            <option value="minutos" selected>Minutos</option>
                                            <option value="horas">Horas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--30%-->
                        <div class="col-imagen">
                            <div class="imagen-curso">
                                <img src="<?php echo $base ?>public/assets/images/cursos/thumbnail-1.jpg" />
                            </div>
                        </div>
                    </div>

                    <div class="hr"></div>

                    <div class="full">
                        <p class="text">Opciones del curso presencial</p>
        
                        <div class="switch" id="repetir-curso-switch">
                            <label class="switch-radio">
                                <p>Repetir curso</p>
                                <input id="repetir-curso-check" onchange="toggleRepetir(this)" value="0" type="checkbox" name="repetircurso" />
                                <span></span>
                            </label>
                        </div>

                        <div id="curso-presencial-opciones-periodo" class="content-visible">
                            <div class="calendario-row">
                                <div class="calendario-col">
                                    <div class="calendario" id="curso-presencial-calendario"></div>

                                    <br>

                                    <div class="calendario-info-container">
                                        <div style="background-color: var(--naranja);"></div>
                                        <p>Días con curso agendado</p>
                                    </div>
                                    <div class="calendario-info-container">
                                        <div style="background-color: var(--azulclaro);"></div>
                                        <p>Día seleccionado</p>
                                    </div>

                                    <button class="calendario-limpiar-btn" type="button" onclick="eliminarTodo()">
                                        <img src="<?php echo $base ?>public/traing/assets/images/clear-icon.svg" />
                                        <span>Eliminar todo</span>
                                    </button>
                                </div>
                                
                                <div class="calendario-data-off" id="calendario-data">
                                    <form id="calendario-data-form">
                                        <p class="text-label">Horario del curso</p>
                                        <div class="col-flex">
                                            <div class="col-hora">
                                                <div class="input">
                                                    <input id="hora-inp" placeholder="10" min="1" max="12" type="number" maxlength="2" autocomplete="off" name="hora" onchange="updateHora(this)" />
                                                    <label>Hora (1-12)</label>
                                                </div>
                                            </div>
                                            <div class="col-hora">
                                                <div class="input">
                                                    <input id="minutos-inp" placeholder="30" min="0" max="59" type="number" maxlength="2" autocomplete="off" name="minutos" onchange="updateMinutos(this)" />
                                                    <label>Minutos (0-59)</label>
                                                </div>
                                            </div>
                                            <div class="col-hora">
                                                <div class="select">
                                                    <select name="horario" id="horario-sel" onchange="updateHorario(this)">
                                                        <option value="am" selected>A.M</option>
                                                        <option value="pm">P.M</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <!---->
                                        <p class="text-label">Asigna un facilitador</p>
                                        <div class="col-mid">
                                            <div class="select">
                                                <select name="facilitador" id="facilitador-sel" onchange="updateFacilitador(this)">
                                                    <option value="0">Selecciona</option>
                                                    <?php foreach($teachers as $t){?>
                                                    <option value="<?php echo $t['id']?>"><?php echo $t['nombre'].' '.$t['apellido']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <br>

                                        <!---->
                                        <p class="text-label">Selecciona una Sede</p>
                                        <div class="col-mid">
                                            <div class="select">
                                                <select name="sede" id="sede-sel" onchange="updateAulasMain(this)">
                                                    <option value="0" selected>Selecciona</option>
                                                    <?php foreach($headquarters as $h){?>
                                                    <option value="<?php echo $h['id']?>"><?php echo $h['nombre']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <br>

                                        <!---->
                                        <p class="text-label">Selecciona una Aula</p>
                                        <div class="col-mid">
                                            <div class="select">
                                                <select name="aula" id="aula-sel" onchange="updateAula(this)">
                                                    <option value="0">Selecciona</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="calendario-data-options" class="calendario-data-option-eliminar">
                                            <button class="calendario-eliminar-btn" type="button" onclick="eliminarCharla()">
                                                <img src="<?php echo $base ?>public/traing/assets/images/delete-icon.svg" />
                                                <span>Borrar</span>
                                            </button>
                                            <!--<button class="calendario-guardar-btn" type="button" onclick="guardarCharla()">
                                                <img src="<?php echo $base ?>public/traing/assets/images/add-icon.svg" />
                                                <span>Agregar</span>
                                            </button>-->
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <div id="curso-presencial-usuarios" class="content-hidden">
                            <p class="text">Registrar estudiantes para la charla (<span id="estudiantes-charla-txt"></span>)</p>
                            
                            <div class="tabla-container">
                                <form class="tabla-form" id="tabla-usuarios-form">
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
                                            <tr id="tabla-usuario-row-<?php echo $user['id']?>">
                                                <td class="td-checkbox">
                                                    <label class="traing-check">
                                                        <input id="usuario-check-<?php echo $user['id']?>" type="checkbox" name="usuario" value="<?php echo $user['id']?>" autocomplete="off" onchange="matricularUsuario(this)" />
                                                        <span class="traing-check-box"></span>
                                                        <span class="traing-check-name"></span>
                                                    </label>
                                                </td>
                                                <td><?php echo $tipos_trabajador[$user['tipou']]?></td>
                                                <td><?php echo $user['nombre']?></td>
                                                <td><?php echo $user['apellido']?></td>
                                                <td><?php echo $user['documento']?></td>
                                                <td><?php echo $user['ciudad']?></td>
                                                <td><?php echo $user['empresa']?></td>
                                                <td><?php echo $user['correo']?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>

                        <div class="hr"></div>

                        <div class="col-right">
                            <button class="boton-principal" onclick="guardarCurso()">
                                <span>Guardar curso</span>
                            </button>
                        </div>
                        <!--end-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--modales-->
    <?php include './modals/repetir-curso.php'; ?>
    <?php include '../../components/sweetalert/sweetalert.php'; ?>
    
    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/sweetalert.js"></script>
    <script src="<?php echo $base ?>public/traing/assets/scripts/dropdown.js"></script>
    <script src="<?php echo $base ?>public/traing/assets/scripts/calendario.js"></script>
    <script src="<?php echo $base ?>public/traing/assets/scripts/cursos-crear.js"></script>
    <script>
        var sedes_data = []
        <?php foreach($headquarters as $headquarter){?>
        
        sedes_data.push({
            id:<?php echo $headquarter['id']?>,
            nombre:"<?php echo $headquarter['nombre']?>"
        })
        <?php } ?>
        
        var aulas_data = []
        <?php foreach($rooms as $r){ ?>
        aulas_data.push({
            id:<?php echo $r['id']?>,
            nombre:"<?php echo $r['nombre']?>",
            sedeid:Number(<?php echo $r['sedeid']?>)
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
                //autodestruir
                inpu.disabled = true
                getE('repetir-curso-switch').className = 'switch switch-disabled'
                openModal(null,'modal-repetir-curso','Opciones para repetir el curso')
            }
        }

        function aplicarRepetir(){
            //rellenar como un pavo de navidad
            var periodo = getE('periodo-sel').value
            if(periodo==1){
                var periodo_o1 = getE('periodo-o1-check').checked
            }else if(periodo==2){
                //var periodo_o2 = 
                getDropdown('dropdown-dias-semana-o2')
            }else if(periodo==3){
                var periodo_o3 = getE('periodo-o3-sel')
            }else if(periodo==4){
                var periodo_o4 = getE('periodo-o4-sel')
            }

            getE('curso-presencial-opciones-periodo').className = 'content-visible'
            closeModal()
        }

        function selectRepetirPeriodo(inpu){
            var selected_value = String(inpu.value)

            getE('curso-presencial-opciones-repetir-o1').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o2').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o3').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o4').className = 'content-hidden'
            
            getE('curso-presencial-opciones-repetir-o'+selected_value).className = 'content-visible'
        }

        function guardarCurso(){
            openModalAlert({status:'success',title:'Curso creado con éxito!',text:'Ya puedes ir a la sección de curso y descargar los códigos QR para la asistencia y finalización'})
        }
        
    </script>
</body>
</html>