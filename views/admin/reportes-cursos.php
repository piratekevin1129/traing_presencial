<?php $menu_active = [6,1];?>
<?php require('../../api/env.php');?>
<?php require('../../data/courses.php');?>
<?php require('../../data/courses_users.php');?>

<?php 
foreach($courses as $indx => $c){
    
    foreach($courses_users as $cu){
        if($c['id']==$cu['id']){
            $certificados = 0;
            foreach($cu['users'] as $cu_u){
                if($cu_u['status']==2){
                    $certificados++;
                }
            }
            $courses[$indx]['registrados'] = count($cu['users']);
            $courses[$indx]['certificados'] = $certificados;
            break;
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
    <link href="<?php echo $base ?>components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/form.css" rel="stylesheet" type="text/css" />
    
    <script src="<?php echo $base ?>public/assets/scripts/jquery-4.0.0.min.js"></script>
    <title>Traing Presencial - Reportes</title>
</head>
<body>
    <div class="main-container">
        <?php include '../../layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include '../../layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Reportes</h1>
                <div class="app-container">
                    <div class="reportes-botones-container">
                        <a class="reporte-boton reporte-boton-active" href="#">
                            <div style="mask: url(<?php echo $base ?>public/assets/images/reportes/cursos-btn-icon.svg);"></div>
                            <span>Cursos creados</span>
                        </a>
                        <a class="reporte-boton" href="./reportes-usuarios.php">
                            <div style="mask: url(<?php echo $base ?>public/assets/images/reportes/estudiantes-btn-icon.svg);"></div>
                            <span>Usuarios</span>
                        </a>
                        <!--<a class="reporte-boton">
                            <div style="mask: url(<?php echo $base ?>public/assets/images/reportes/sedes-btn-icon.svg);"></div>
                            <span>Sedes</span>
                        </a>
                        <a class="reporte-boton">
                            <div style="mask: url(<?php echo $base ?>public/assets/images/reportes/auditoria-btn-icon.svg);"></div>
                            <span>Auditoría</span>
                        </a>-->
                    </div>
                    <div class="card-container">
                        <div class="card-container-header">
                            <p>Cursos creados <span><?php echo count($courses)?></span></p>
                            <div>
                                <a class="boton-reporte" href="<?php echo $base ?>api/reporte-cursos.php">
                                    <img src="<?php echo $base ?>public/assets/images/button-excel-icon.svg" />
                                    <span>Exportar reporte</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-container-body">
                            <div class="tabla-container">
                                <table id="tabla-cursos" class="traing-tabla">
                                    <thead>
                                        <tr>
                                            <th style="width: 55%;">
                                                <span>Nombre del curso</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 15%;">
                                                <span>Usuarios registrados</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 15%;">
                                                <span>Usuarios completados</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 15%;" class="text-center">
                                                <span>Acciones</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($courses as $course){?>
                                        <tr>
                                            <td><?php echo $course['nombre']?></td>
                                            <td><?php echo $course['registrados']?></td>
                                            <td><?php echo $course['certificados']?></td>
                                            <td class="td-botones-flex">
                                                <button onclick="verDetallesCurso(<?php echo $course['id']?>)">
                                                    <img src="<?php echo $base ?>public/assets/images/button-ver-icon.svg" />
                                                </button>
                                                <a class="boton-td" href="#" target="_blank">
                                                    <img src="<?php echo $base ?>public/assets/images/button-download2-icon.svg" />
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
        </div>
    </div>

    <!--modales-->
    <?php include './modals/detalles-curso.php'; ?>
    <?php include '../../components/sweetalert/sweetalert.php'; ?>

    <script src="<?php echo $base ?>public/assets/scripts/form.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/admin/reportes-cursos.js"></script>
    <script>
        

    </script>
</body>
</html>