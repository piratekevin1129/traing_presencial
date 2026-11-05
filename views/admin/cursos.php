<?php $menu_active = [2,1];?>
<?php require('../../api/env.php');?>
<?php require('../../data/users.php');?>
<?php require('../../data/courses.php');?>
<?php require('../../data/headquarters.php');?>
<?php require('../../data/rooms.php');?>
<?php require('../../data/teachers.php');?>
<?php require('../../data/courses_users.php');?>
<?php 

//fill extra data for courses
foreach($courses as $indx => $c){
    foreach($headquarters as $h){
        if($c['sedeid']==$h['id']){
            $courses[$indx]['sede'] = $h['nombre'];
            $courses[$indx]['direccion'] = $h['direccion'];
        }
    }

    foreach($rooms as $r){
        if($c['aulaid']==$r['id']){
            $courses[$indx]['aula'] = $r['nombre'];
        }
    }

    foreach($teachers as $t){
        if($c['facilitadorid']==$t['id']){
            $courses[$indx]['facilitador'] = $t['nombre'].' '.$t['apellido'];
        }
    }

    foreach($courses_users as $cu){
        if($c['id']==$cu['id']){
            $courses[$indx]['registrados'] = count($cu['users']);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../layouts/css.php'; ?>
    <?php include '../../layouts/scripts.php'; ?>
    <link href="<?php echo $base ?>public/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/tabla.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/form.css" rel="stylesheet" type="text/css" />
    
    <script src="<?php echo $base ?>public/assets/scripts/jquery-4.0.0.min.js"></script>
    <title>Traing Presencial - Cursos</title>
</head>
<body>
    <div class="main-container">
        <?php include '../../layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include '../../layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todos los cursos</h1>
                <div class="app-container">
                    <div class="tabla-container">
                        <table id="tabla-usuarios" class="traing-tabla">
                            <thead>
                                <tr>
                                    <th style="width: 28%;">
                                        <span>Nombre</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 20%;" class="text-center">
                                        <span>Fecha y ubicación</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 20%;" class="text-center">
                                        <span>Facilitador</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 7%;" class="text-center">
                                        <span>Código QR</span>
                                    </th>
                                    <th style="width: 7%;" class="text-center">
                                        <span>Usuarios</span>
                                    </th>
                                    <th style="width: 9%;" class="text-center">
                                        <span>Editar</span>
                                    </th>
                                    <th style="width: 9%;" class="text-center">
                                        <span>Abrir</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($courses as $course){?>
                                <tr>
                                    <td>
                                        <?php echo $course['nombre']?>
                                    </td>
                                    <td>
                                        <?php 
                                        echo $course['fecha'].'<br>';
                                        echo '<span>Sede: </span>'.$course['sede'].'<br>';
                                        echo '<span>Aula: </span>'.$course['aula'].'<br>';
                                        echo '<span>Dirección: </span>'.$course['direccion'] 
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php //echo $course['registrados']?>
                                        <?php echo $course['facilitador']?>
                                    </td>
                                    <td class="td-boton">
                                        <button class="button-qr" onclick="verQRS(<?php echo $course['id']?>)">
                                            <img src="<?php echo $base ?>public/assets/images/button-qr-icon.svg" />
                                        </button>
                                    </td>
                                    <td class="td-boton">
                                        <button onclick="verAsistencias(<?php echo $course['id']?>)">
                                            <img src="<?php echo $base ?>public/assets/images/button-ver-icon.svg" />
                                        </button>
                                    </td>
                                    <td class="td-boton">
                                        <button onclick="editarCurso(<?php echo $course['id']?>)">
                                            <img src="<?php echo $base ?>public/assets/images/button-edit-icon.svg" />
                                        </button>
                                    </td>
                                    <td class="td-boton">
                                        <a class="boton-td" href="<?php echo $base ?>public/docs/curso-medio-ambiente.pdf" target="_blank">
                                            <img src="<?php echo $base ?>public/assets/images/button-link-icon.svg" />
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--modales-->
    <?php include './modals/ver-qrs.php'; ?>
    <?php include './modals/ver-asistencias.php'; ?>
    <?php include '../../components/sweetalert/sweetalert.php'; ?>
    
    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/sweetalert.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/cursos.js"></script>

    <script>
        var cursos_data = []
        <?php foreach($courses as $course){ ?>
        cursos_data.push({
            id:<?php echo $course['id']?>,
            nombre:"<?php echo $course['nombre']?>",
            fecha:"<?php echo $course['fecha']?>",
            sede:"<?php echo $course['sede']?>",
            aula:"<?php echo $course['aula']?>",
            direccion:"<?php echo $course['direccion']?>",
            facilitador:"<?php echo $course['facilitador']?>",
            img:"<?php echo $course['img']?>",
            usuarios:[]
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