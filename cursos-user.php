<?php require('./data/courses.php');?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include './layouts/css.php'; ?>
    
    <link href="./public/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/accordion.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/form.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/camara.css" rel="stylesheet" type="text/css" />
    
    <title>Traing Presencial - Usuarios</title>
</head>
<body>
    <div class="main-container">
        <?php include './layouts/header-user.php'; ?>
        <div class="body-container body-container-dashboard">
            <div id="app" class="app-closed">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todos los cursos</h1>
                <div class="app-container">
                    <div class="accordion-wrap">
                        <?php foreach($courses as $course){?>
                            <div class="accordion-container accordion-container-collapsed">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    <p><?php echo $course['nombre']?></p>
                                    <button>
                                        <img src="./public/assets/images/accordion/accordion-icon.svg" />
                                    </button>
                                </div>
                                <div class="accordion-body">
                                    <div class="accordion-content">
                                        <div class="accordion-content-col1">
                                            <div class="accordion-content-img">
                                                <img src="./public/assets/images/cursos/<?php echo $course['img']?>" />
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
                                                    <h4>Ubicación</h4>
                                                    <div>
                                                        <div>
                                                            <img src="./public/assets/images/accordion/accordion-mapa-icon.svg" />
                                                        </div>
                                                        <span><?php echo $course['ubicacion']?></span>
                                                    </div>
                                                </div>
                                                <div class="accordion-content-info-col">
                                                    <h4>Facilitador</h4>
                                                    <p><?php echo $course['facilitador']?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-content-col2">
                                            <button id="confirmar-ingreso-btn-<?php echo $course['id'] ?>" type="button" class="accordion-ingreso-btn unlocked" onclick="clickConfirmarIngreso(<?php echo $course['id']?>)">
                                                <span>Confirmar Ingreso</span>
                                                <img src="./public/assets/images/accordion/accordion-check-icon.svg" />
                                            </button>
    
                                            <button id="confirmar-salida-btn-<?php echo $course['id'] ?>" type="button" class="accordion-salida-btn locked" onclick="clickConfirmarSalida(<?php echo $course['id']?>)" disabled>
                                                <span>Confirmar Salida</span>
                                                <img src="./public/assets/images/accordion/accordion-check-icon.svg" />
                                            </button>
    
                                            <a id="confirmar-certificado-btn-<?php echo $course['id'] ?>" class="accordion-certificado-btn locked" href="#">
                                                <span>Descargar certificado</span>
                                                <img src="./public/assets/images/accordion/accordion-check-icon.svg" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--modales-->
    <?php include './components/modals/escanear-qrs.php'; ?>

    <script src="./public/assets/scripts/accordion.js"></script>
    <script src="./public/assets/scripts/modal.js"></script>
    <script src="./public/assets/qr/qrCode.min.js"></script>
    <script src="./public/assets/scripts/qr.js"></script>
    <script src="./public/assets/scripts/cursos-user.js"></script>

    <script>
        var cursos_data = []
        <?php foreach($courses as $course){ ?>
        cursos_data.push({
            id:<?php echo $course['id']?>,
            nombre:"<?php echo $course['nombre']?>",
            fecha:"<?php echo $course['fecha']?>",
            sede:"<?php echo $course['sede']?>",
            ubicacion:"<?php echo $course['ubicacion']?>",
            facilitador:"<?php echo $course['facilitador']?>",
            img:"<?php echo $course['img']?>"
        })
        <?php } ?>

        function findCourse(id){
            var ind = -1
            for(var i = 0;i<cursos_data.length;i++){
                if(cursos_data[i].id==id){
                    ind = i
                }
            }
            return ind
        }

    </script>
</body>
</html>