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
    <link href="<?php echo $base ?>public/curso-crear/css/main.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/curso-crear/css/presencial.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/curso-crear/css/dropdown.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/curso-crear/css/switch.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/curso-crear/css/calendario.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo $base ?>public/assets/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>components/loader/loader.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/tabla.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo $base ?>public/assets/scripts/jquery-4.0.0.min.js"></script>
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
                            <input id="nombre-inp" placeholder="Nombre del curso" type="text" maxlength="100" autocomplete="off" name="nombre" />
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
                    </div>

                    <div class="row">
                        <!--70%-->
                        <div class="col-formulario">
                            <div class="textarea">
                                <textarea id="descripcion-inp" placeholder="Descripción del curso" autocomplete="off" name="descripcion"></textarea>
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
                                            <option value="0" selected>Seleccionar</option>
                                            <option value="minutos">Minutos</option>
                                            <option value="horas">Horas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--30%-->
                        <div class="col-imagen">
                            <div class="imagen-curso">
                                <div class="imagen-curso-default">
                                    <img src="<?php echo $base?>public/assets/images/button-image-icon.svg" />
                                </div>
                                <img class="imagen-curso-img-off" id="imagen-curso-img" src="" />
                                <input type="file" name="curso-img" accept=".png,.jpeg,.jpg" onchange="updateCourseImage(event)" />
                            </div>
                            <label>Haz clic sobre la imagen para cambiarla</label>
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
                                        <img src="<?php echo $base ?>public/curso-crear/images/clear-icon.svg" />
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
                                                <img src="<?php echo $base ?>public/curso-crear/images/delete-icon.svg" />
                                                <span>Borrar</span>
                                            </button>
                                            <!--<button class="calendario-guardar-btn" type="button" onclick="guardarCharla()">
                                                <img src="<?php echo $base ?>public/curso-crear/images/add-icon.svg" />
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
                            <button class="boton-principal" onclick="guardarCurso(this)">
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
    <?php include '../../components/loader/loader.php'; ?>
    
    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/curso-crear/scripts/dropdown.js"></script>
    <script src="<?php echo $base ?>public/curso-crear/scripts/calendario.js"></script>
    <script src="<?php echo $base ?>public/curso-crear/scripts/cursos-crear.js"></script>
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
            getE('current-mes-txt').innerHTML = meses[current_mes].m
        }


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
            var dias_agregar = [];
            var fecha_i = "";
            var dia_i = -1;

            if(periodo==1){
                //todos los dias
                var periodo_o1 = getE('periodo-o1-check').checked

                for(i = (current_day+1);i<=meses[current_mes].n;i++){
                    //obtener div con dia de la semana
                    var dia_semana = getE('calendario-date-'+i).getAttribute('data-d')
                    if(dia_semana==0||dia_semana==6){
                        if(periodo_o1){
                            dias_agregar.push({date:i,day:dia_semana})
                        }
                    }else{
                        dias_agregar.push({date:i,day:dia_semana})
                    }
                }
            }else if(periodo==2){
                //tres dias a la semana
                var periodo_o2 = getDropdownItems('dropdown-dias-semana-o2')
                for(i = (current_day+1);i<=meses[current_mes].n;i++){
                    //obtener div con dia de la semana
                    var dia_semana = getE('calendario-date-'+i).getAttribute('data-d')

                    if(periodo_o2.indexOf(dia_semana)!=-1){
                        dias_agregar.push({date:i,day:dia_semana})
                    }
                }
            }else if(periodo==3){
                //dos dias a la semana
                var periodo_o3 = getDropdownItems('dropdown-dias-semana-o3')
                for(i = (current_day+1);i<=meses[current_mes].n;i++){
                    //obtener div con dia de la semana
                    var dia_semana = getE('calendario-date-'+i).getAttribute('data-d')

                    if(periodo_o3.indexOf(dia_semana)!=-1){
                        dias_agregar.push({date:i,day:dia_semana})
                    }
                }
            }else if(periodo==4){
                //un dia a la semana
                var periodo_o4 = getE('periodo-o4-sel').value
                for(i = (current_day+1);i<=meses[current_mes].n;i++){
                    //obtener div con dia de la semana
                    var dia_semana = getE('calendario-date-'+i).getAttribute('data-d')

                    if(periodo_o4==dia_semana){
                        dias_agregar.push({date:i,day:dia_semana})
                    }
                }
            }

            if(dias_agregar.length==0){
                openModalAlert({
                    status:'warning',
                    title:'No tan rápido!',
                    text:'Debes escoger una opción para repetir el curso'
                })
            }else{
                createCharlas(dias_agregar)
                getE('curso-presencial-opciones-periodo').className = 'content-visible'
                closeModal()
            }

        }

        function selectRepetirPeriodo(inpu){
            var selected_value = String(inpu.value)

            getE('curso-presencial-opciones-repetir-o1').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o2').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o3').className = 'content-hidden'
            getE('curso-presencial-opciones-repetir-o4').className = 'content-hidden'
            
            getE('curso-presencial-opciones-repetir-o'+selected_value).className = 'content-visible'
        }
        
    </script>
</body>
</html>