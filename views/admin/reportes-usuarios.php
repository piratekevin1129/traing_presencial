<?php $menu_active = [6,1];?>
<?php require('../../api/env.php');?>
<?php require('../../data/users.php');?>

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
                        <a class="reporte-boton" href="./reportes-cursos.php">
                            <div style="mask: url(<?php echo $base ?>public/assets/images/reportes/cursos-btn-icon.svg);"></div>
                            <span>Cursos creados</span>
                        </a>
                        <a class="reporte-boton reporte-boton-active" href="#">
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
                            <p>Usuarios registrados <span><?php echo count($users)?></span></p>
                            <div>
                                <a class="boton-reporte" href="<?php echo $base ?>public/docs/reporte-usuario-1.xlsx">
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
                                            <th style="width: 30%;">
                                                <span>Nombre completo</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 10%;">
                                                <span>Número de documento</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 25%;">
                                                <span>correo electrónico</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 13%;">
                                                <span>Ciudad</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 12%;">
                                                <span>Empresa</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 10%;" class="text-center">
                                                <span>Detalles</span>
                                                <button></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($users as $user){?>
                                        <tr>
                                            <td><?php echo $user['nombre'].' '.$user['apellido']?></td>
                                            <td><?php echo $user['documento']?></td>
                                            <td><?php echo $user['correo']?></td>
                                            <td><?php echo $user['ciudad']?></td>
                                            <td><?php echo $user['empresa']?></td>
                                            <td>
                                                <button onclick="verDetallesUsuario(<?php echo $user['id']?>)">
                                                    <img src="<?php echo $base ?>public/assets/images/button-ver-icon.svg" />
                                                </button>
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
    <?php include './modals/detalles-usuario.php'; ?>
    <?php include '../../components/sweetalert/sweetalert.php'; ?>

    <script src="<?php echo $base ?>public/assets/scripts/form.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/admin/reportes-usuarios.js"></script>
    <script>
        var tipos_trabajador = [{
            key:'e',value:'Estudiante'
        },{
            key:'c',value:'Contratista'
        }]

        function getTipoTrabajador(key){
            var valor = ""
            for(var i = 0;i<tipos_trabajador.length;i++){
                if(tipos_trabajador[i].key==key){
                    valor = tipos_trabajador[i].value
                    break;
                }
            }
            return valor
        }
    </script>
    
</body>
</html>