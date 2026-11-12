<?php $menu_active = [2,2];?>
<?php 

require('../../data/courses.php');
require('../../data/courses_users.php');

$course_data = array(
    'id'=>0,
    'nombre'=>"",
    'descripcion'=>"",
    'img'=>"",
    'hora'=>0,
    'minutos'=>0,
    'horario'=>"",
    'ano'=>0,
    'mes'=>0,
    'dia'=>0,
    'semana'=>0,
    'fecha'=>"",
    'fechaformat'=>"",
    'sedeid'=>0,
    'aulaid'=>0,
    'facilitadorid'=>0,
    'status'=>0,
    'tiempo'=>0,
    'tiempo2'=>"",
    'encargados'=>array(),
    'users'=>array()
);

if(isset($_GET['courseid'])){
    $c = findCourse($_GET['courseid']);
    if($c>=0){
        $course = $courses[$c];
        $course_data = array(
            'id'=>$course['id'],
            'nombre'=>$course['nombre'],
            'descripcion'=>$course['descripcion'],
            'img'=>"",
            'fecha'=>$course['fecha'],
            'fechaformat'=>$course['fechaformat'],
            'sedeid'=>$course['sedeid'],
            'aulaid'=>$course['aulaid'],
            'facilitadorid'=>$course['facilitadorid'],
            'status'=>$course['status'],
            'tiempo'=>$course['tiempo'],
            'tiempo2'=>$course['tiempo2'],
            'encargados'=>$course['encargados'],
            'users'=>array()
        );

        $fecha1 = explode(" ",$course['fechaformat']);
        $fecha2 = explode("-",$fecha1[0]);
        $fecha3 = explode(":",$fecha1[1]);

        $course_data['ano'] = (int)$fecha2[0];
        $course_data['mes'] = (int)$fecha2[1];
        $course_data['dia'] = (int)$fecha2[2];
        $course_data['hora'] = (int)$fecha3[0];
        $course_data['minutos'] = (int)$fecha3[1];
        if($course_data['hora']>12){
            $course_data['hora'] = ($course_data['hora']-12);
            $course_data['horario'] = 'pm';
        }else{
            $course_data['horario'] = 'am';
        }

        $imgurl = '../../public/cursos/'.$course_data['id'].'/thumbnail.jpg';
        if(!file_exists($imgurl)){
            $imgurl = '../../public/cursos/'.$course_data['id'].'/thumbnail.png';
        }

        $course_data['img'] = $imgurl;

        foreach($courses_users as $cu){
            if($course_data['id']==$cu['id']){
                $course_data['users'] = $cu['users'];
                break;
            }
        }
    }
}
?>

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
    <title>Traing Presencial - Editar curso</title>
</head>
<body>
    <div class="main-container">
        <?php include '../../layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include '../../layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">EDITAR CURSO/INDUCCIÓN</h1>
                <div class="app-container">
                    <div class="col-mid">
                        <div class="input">
                            <input id="nombre-inp" placeholder="Nombre del curso" type="text" maxlength="100" autocomplete="off" name="nombre" value="<?php echo $course_data['nombre']?>" />
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
                                <textarea id="descripcion-inp" placeholder="Descripción del curso" autocomplete="off" name="descripcion"><?php echo $course_data['descripcion']?></textarea>
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
                                        <input id="tiempo-inp" placeholder="10" min="1" max="100" type="number" maxlength="3" autocomplete="off" name="tiempo" value="<?php echo $course_data['tiempo']?>" />
                                        <label>Tiempo (1-100)</label>
                                    </div>
                                </div>
                                <div class="col-tiempo">
                                    <div class="select">
                                        <select name="tiempo2" id="tiempo2-sel">
                                            <option value="minutos">Minutos</option>
                                            <option value="horas" selected>Horas</option>
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
                                <?php if($course_data['img']==""){?>
                                <img class="imagen-curso-img-off" id="imagen-curso-img" src="" />
                                <?php }else{?>
                                <img class="imagen-curso-img-on" id="imagen-curso-img" src="<?php echo $course_data['img']?>" />
                                <?php }?>
                                <form id="curso-img-form" enctype="multipart/form-data">
                                    <input id="imagen-inp" type="file" name="curso-img" accept=".png,.jpeg,.jpg" onchange="updateCourseImage(event)" />
                                    <input type="hidden" name="curso-ids" id="curso_ids" value="<?php echo $course_data['id']?>" />
                                </form>
                            </div>
                            <label>Haz clic sobre la imagen para cambiarla</label>
                        </div>
                    </div>

                    <div class="hr"></div>

                    <div class="full">
                        <p class="text">Opciones del curso presencial</p>

                        <div id="curso-presencial-opciones-periodo" class="content-visible">
                            <div class="calendario-row">
                                <div class="calendario-col">
                                    <div class="calendario" id="curso-presencial-calendario"></div>
                                </div>
                                
                                <div class="calendario-data-on" id="calendario-data">
                                    <form id="calendario-data-form">
                                        <p class="text-label">Horario del curso</p>
                                        <div class="col-flex">
                                            <div class="col-hora">
                                                <div class="input">
                                                    <input id="hora-inp" placeholder="10" min="1" max="12" type="number" maxlength="2" autocomplete="off" name="hora" onchange="updateHora(this)" value="<?php echo $course_data['hora']?>" />
                                                    <label>Hora (1-12)</label>
                                                </div>
                                            </div>
                                            <div class="col-hora">
                                                <div class="input">
                                                    <input id="minutos-inp" placeholder="30" min="0" max="59" type="number" maxlength="2" autocomplete="off" name="minutos" onchange="updateMinutos(this)" value="<?php echo $course_data['minutos']?>" />
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
                                    </form>
                                </div>

                            </div>
                        </div>

                        <div id="curso-presencial-usuarios" class="content-visible">
                            <p class="text">Registrar estudiantes para la charla</p>
                            
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
                            <button type="button" class="boton-principal" onclick="actualizarCurso(this)">
                                <span>Actualizar curso</span>
                            </button>
                        </div>
                        <!--end-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--modales-->
    <?php include '../../components/sweetalert/sweetalert.php'; ?>
    <?php include '../../components/loader/loader.php'; ?>
    
    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/curso-crear/scripts/dropdown.js"></script>
    <script src="<?php echo $base ?>public/curso-crear/scripts/calendario.js"></script>
    <script src="<?php echo $base ?>public/curso-crear/scripts/cursos-form.js"></script>
    <script src="<?php echo $base ?>public/curso-crear/scripts/cursos-editar.js"></script>
    <script>

    <?php if($c>=0){ ?>
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

        var encargados_data = []
        <?php foreach($course_data['encargados'] as $ce){?>
        encargados_data.push(<?php echo $ce?>)
        <?php } ?>

        var tiempo2_data = "<?php echo $course_data['tiempo2']?>";
        var horario_data = "<?php echo $course_data['horario']?>";
        var facilitador_data = <?php echo $course_data['facilitadorid']?>;
        var sede_data = <?php echo $course_data['sedeid']?>;
        var aula_data = <?php echo $course_data['aulaid']?>;

        var estudiantes_data = []
        <?php foreach($course_data['users'] as $u){ ?>
        estudiantes_data.push(Number(<?php echo $u['id']?>))
        <?php } ?>

        window.onload = function(){
            setDropdown()
            setCalendario('curso-presencial-calendario','no')

            editDropdown('dropdown-encargado',encargados_data)
            getE('tiempo2-sel').value = tiempo2_data
            
            var fecha_charla = new Date(String('<?php echo $course_data['ano'].'-'.$course_data['mes'].'-'.$course_data['dia']?>'))

            charlas_data.push({
                id:1,
                ano:Number(<?php echo $course_data['ano']?>),
                mes:parseInt(<?php echo $course_data['mes']?>)-1,
                fecha:parseInt(<?php echo $course_data['dia']?>),
                dia:parseInt(fecha_charla.getDay()),
                hora:parseInt(<?php echo $course_data['hora']?>),
                minutos:parseInt(<?php echo $course_data['minutos']?>),
                horario:"<?php echo $course_data['horario']?>",
                facilitador:parseInt(<?php echo $course_data['facilitadorid']?>),
                sede:parseInt(<?php echo $course_data['sedeid']?>),
                aula:parseInt(<?php echo $course_data['aulaid']?>),
                estudiantes:estudiantes_data
            })
            
            createCharlas()
            
            getE('horario-sel').value = horario_data
            getE('facilitador-sel').value = facilitador_data
            getE('sede-sel').value = sede_data
            updateAulasMain(getE('sede-sel'))
            getE('aula-sel').value = aula_data
        }

        
    <?php } else {?>
        openModalAlert({
            status:"warning",
            title:"¡No pudes estar aqui!",
            text:"El curso no existe o ya fué finalizado",
            action:'goToCourses'
        })

        function goToCourses(){
            window.location.href = 'cursos.php'
        }
    <?php } ?>
    </script>
</body>
</html>