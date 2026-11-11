<?php 
require('../../api/env.php');
require('../../api/session.php');

if(!$valid_session){
    //exit("sesion invalida ".$_SESSION['document'].'-'.$_SESSION['user_id'].'-'.$_SESSION['name'].'-'.$_SESSION['document'].'-'.$_SESSION['course_id']);
    exit("sesion invalida");
}else{
    require('../../data/courses.php');
    require('../../data/headquarters.php');
    require('../../data/rooms.php');
    require('../../data/teachers.php');
    $c = findCourse($_SESSION['course_id']);

    if($c>=0){
        $course = $courses[$c];

        foreach($headquarters as $h){
            if($course['sedeid']==$h['id']){
                $course['sede'] = $h['nombre'];
                $course['direccion'] = $h['direccion'];
                break;
            }
        }
        foreach($rooms as $r){
            if($course['aulaid']==$r['id']){
                $course['aula'] = $r['nombre'];
                break;
            }
        }
        foreach($teachers as $t){
            if($course['facilitadorid']==$t['id']){
                $course['facilitador'] = $t['nombre'].' '.$t['apellido'];
                break;
            }
        }
    }else{
        exitPage();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../layouts/css.php'; ?>
    
    <link href="<?php echo $base ?>public/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/accordion.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/form.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    
    <script src="<?php echo $base?>public/assets/scripts/jquery-4.0.0.min.js"></script>
    <title>Traing Presencial - Cursos</title>
</head>
<body>
    <div class="main-container">
        <?php include '../../layouts/header-user.php'; ?>
        <div class="body-container body-container-dashboard">
            <div id="app" class="app-closed">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Curso <?php echo $course['nombre'] ?></h1>
                <!--<div class="app-container">-->
                    <div class="accordion-wrap">
                        <div class="accordion-container accordion-container-expanded">
                            <div class="accordion-header" onclick="toggleAccordion(this)">
                                <p><?php echo $course['nombre']?></p>
                                <button>
                                    <img src="<?php echo $base ?>public/assets/images/accordion/accordion-icon.svg" />
                                </button>
                            </div>
                            <div class="accordion-body">
                                <div class="accordion-content">
                                    <div class="accordion-content-col1">
                                        <div class="accordion-content-img">
                                            <?php 
                                            $imgurl = '../../public/cursos/'.$course['id'].'/thumbnail.jpg';
                                            if(file_exists($imgurl)===false){
                                                $imgurl = '../../public/cursos/'.$course['id'].'/thumbnail.png';
                                            }
                                            ?>
                                            <img src="<?php echo $imgurl ?>" />
                                        </div>
                                        <div class="accordion-content-info">
                                            <div class="accordion-content-info-col">
                                                <h4>Fecha y hora</h4>
                                                <p><?php echo $course['fecha']?></p>
                                            </div>
                                            <div class="accordion-content-info-col">
                                                <h4>Sede</h4>
                                                <p><?php echo $course['sede']?></p>
                                            </div>
                                            <div class="accordion-content-info-col">
                                                <h4>Aula</h4>
                                                <p><?php echo $course['aula']?></p>
                                            </div>
                                            <div class="accordion-content-info-col">
                                                <h4>Ubicación</h4>
                                                <div>
                                                    <div>
                                                        <img src="<?php echo $base ?>public/assets/images/accordion/accordion-mapa-icon.svg" />
                                                    </div>
                                                    <span><?php echo $course['direccion']?></span>
                                                </div>
                                            </div>
                                            <div class="accordion-content-info-col">
                                                <h4>Facilitador</h4>
                                                <p><?php echo $course['facilitador']?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-content-col2">
                                        <!--validar si el curso está cerrado-->
                                        
                                        <?php if($course['status']==2){?>
                                            <button 
                                                id="confirmar-salida-btn-<?php echo $course['id'] ?>" 
                                                type="button" 
                                                class="loading"
                                            >
                                                <span>Confirmar Salida</span>
                                                <div></div>
                                            </button>
                                        <?php } ?>

                                        <!--<a id="confirmar-certificado-btn-<?php echo $course['id'] ?>" class="accordion-certificado-btn locked" href="#">
                                            <span>Descargar certificado</span>
                                            <img src="<?php echo $base ?>public/assets/images/check-icon.svg" />
                                        </a>-->
                                    </div>
                                    <p id="hora-salida-txt"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--</div>-->
            </div>
        </div>
    </div>

    <!--modales-->
    <?php include '../../components/sweetalert/sweetalert.php'; ?>

    <script src="<?php echo $base ?>public/assets/scripts/accordion.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/student/curso-user.js"></script>

    <script>
        var confirming_entry = true

        var course_status = Number(<?php echo $course['status']?>);
        var course_id = Number(<?php echo $course['id']?>);
        var ingreso_btn = null;
        var salida_btn = null;
        var url_action = ""

        window.onload = function(){
            
            <?php if($course['status']==2){?>
            
            salida_btn = getE('confirmar-salida-btn-<?php echo $course['id']?>')

            checkIngresoSalida()
            
            <?php } else if($course['status']==0){?>
            openModalAlert({
                status:'warning',
                title:'¡Todavía no!',
                text:'El curso todavia no ha iniciado, por favor vuelve más tarde'
            })
            <?php } else if($course['status']==1){?>
            openModalAlert({
                status:'warning',
                title:'¡Curso finalizado!',
                text:'El curso todavía no ha finalizado, por favor vuelve más tarde'
            })
            <?php } ?>
        }

    </script>
</body>
</html>

<?php } ?>