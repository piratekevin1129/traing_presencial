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
                                            <img src="<?php echo $base ?>public/assets/images/cursos/<?php echo $course['img']?>" />
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
                                        <button 
                                            id="confirmar-ingreso-btn-<?php echo $course['id'] ?>" 
                                            type="button" 
                                            class="loading" 
                                        >
                                            <span>Confirmar Ingreso</span>
                                            <div></div>
                                        </button>

                                        <!--<button id="confirmar-salida-btn-<?php echo $course['id'] ?>" type="button" class="accordion-salida-btn locked" onclick="clickConfirmarSalida(<?php echo $course['id']?>)" disabled>
                                            <span>Confirmar Salida</span>
                                            <img src="<?php echo $base ?>public/assets/images/check-icon.svg" />
                                        </button>

                                        <a id="confirmar-certificado-btn-<?php echo $course['id'] ?>" class="accordion-certificado-btn locked" href="#">
                                            <span>Descargar certificado</span>
                                            <img src="<?php echo $base ?>public/assets/images/check-icon.svg" />
                                        </a>-->
                                    </div>
                                    <p id="hora-ingreso-txt"></p>
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

        window.onload = function(){
            //verificar el estado de ingreso
            $.ajax({
                method: 'POST',
                url: base+'api/controllers/student.php?action=checkEntry',
                success: function(response){
                    var response_data = JSON.parse(response)
                    if(response_data.status=='success'){
                        //console.log(response_data.data)
                        if(response_data.data.status==0){
                            setButtonIngresoDefault()
                        }else if(response_data.data.status==1){
                            setButtonIngresoReady()
                            getE('hora-ingreso-txt').innerHTML = 'Hora de ingreso: '+response_data.data.horaentrada
                        }else if(response_data.data.status==2){
                            setButtonIngresoFinalizado()
                        }
                    }else{
                        setButtonIngresoDefault()
                        openModalAlert({
                            status:'warning',
                            title:'¡Algo salió mal!',
                            text:"Ocurrió un error verificando el ingreso"
                        });
                    }
                    confirming_entry = false
                },
                error: function(xhr, status, error) {
                    console.log("Error de servidor");
                    console.log(xhr);
                    openModalAlert({
                        status:'warning',
                        title:'¡Algo salió mal!',
                        text:"No se pudo verificar el ingreso"
                    });
                    confirming_entry = false
                }
            })
        }

        var ingreso_btn = getE('confirmar-ingreso-btn-<?php echo $course['id']?>')

        function setButtonIngresoReady(){
            ingreso_btn.className = 'ready'
            ingreso_btn.disabled = true
            ingreso_btn.innerHTML = '<span>Ingreso confirmado</span><div></div>'
        }

        function setButtonIngresoDefault(){
            ingreso_btn.className = 'unlocked'
            ingreso_btn.setAttribute('onclick','clickConfirmarIngreso(<?php echo $course['id']?>)')
            ingreso_btn.disabled = false
            ingreso_btn.innerHTML = '<span>Confirmar ingreso</span><div></div>'
        }

        function setButtonIngresoLoading(){
            ingreso_btn.className = 'loading'
            ingreso_btn.disabled = true
            ingreso_btn.innerHTML = '<span>Espere</span><div></div>'
        }

        function setButtonIngresoFinalizado(){
            ingreso_btn.className = 'ready'
            ingreso_btn.innerHTML = '<span>Curso finalizado</span><div></div>'
            ingreso_btn.disabled = true
        }
    </script>
</body>
</html>

<?php } ?>