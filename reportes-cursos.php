<?php $menu_active = [5,1];?>
<?php require('./data/courses.php');?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include './layouts/css.php'; ?>
    <?php include './layouts/scripts.php'; ?>
    <link href="./public/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/tabla.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/form.css" rel="stylesheet" type="text/css" />
    
    <title>Traing Presencial - Reportes</title>
</head>
<body>
    <div class="main-container">
        <?php include './layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include './layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Reportes</h1>
                <div class="app-container">
                    <div class="reportes-botones-container">
                        <a class="reporte-boton reporte-boton-active" href="#">
                            <div style="mask: url(./public/assets/images/reportes/cursos-btn-icon.svg);"></div>
                            <span>Cursos creados</span>
                        </a>
                        <a class="reporte-boton" href="./reportes-usuarios.php">
                            <div style="mask: url(./public/assets/images/reportes/estudiantes-btn-icon.svg);"></div>
                            <span>Estudiantes</span>
                        </a>
                        <a class="reporte-boton">
                            <div style="mask: url(./public/assets/images/reportes/sedes-btn-icon.svg);"></div>
                            <span>Sedes</span>
                        </a>
                        <a class="reporte-boton">
                            <div style="mask: url(./public/assets/images/reportes/auditoria-btn-icon.svg);"></div>
                            <span>Auditoría</span>
                        </a>
                    </div>
                    <div class="card-container">
                        <div class="card-container-header">
                            <p>Cursos creados <span id="cursos-creados-txt">3</span></p>
                            <div>
                                <a class="boton-reporte" href="./public/docs/reporte-curso-1.xlsx">
                                    <img src="./public/assets/images/button-excel-icon.svg" />
                                    <span>Exportar reporte</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-container-body">
                            <div class="tabla-container">
                                <table id="tabla-cursos" class="traing-tabla">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">
                                                <!--input radio-->
                                            </th>
                                            <th style="width: 40%;">
                                                <span>Nombre del curso</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 15%;">
                                                <span>Usuarios registrados</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 15%;">
                                                <span>Usuarios certificados</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 15%;">
                                                <span>Usuarios inactivos</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 10%;" class="text-center">
                                                <span>Detalles</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($courses as $course){?>
                                        <tr id="tabla-curso-row-<?php echo $course['id']?>">
                                            <td class="td-checkbox">
                                                <label class="traing-check">
                                                    <input type="radio" name="usuario" value="<?php echo $curso[0]?>" autocomplete="off" />
                                                    <span class="traing-check-box"></span>
                                                    <span class="traing-check-name"></span>
                                                </label>
                                            </td>
                                            <td><?php echo $course['nombre']?></td>
                                            <td><?php echo $course['registrados']?></td>
                                            <td><?php echo $course['certificados']?></td>
                                            <td><?php echo $course['inactivos']?></td>
                                            <td class="td-boton">
                                                <button>
                                                    <img src="./public/assets/images/button-ver-icon.svg" />
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

    <script src="./public/assets/scripts/form.js"></script>
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