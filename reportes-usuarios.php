<?php $menu_active = [5,1];?>
<?php require('./data/users.php');?>

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
                        <a class="reporte-boton" href="./reportes-cursos.php">
                            <div style="mask: url(./public/assets/images/reportes/cursos-btn-icon.svg);"></div>
                            <span>Cursos creados</span>
                        </a>
                        <a class="reporte-boton reporte-boton-active" href="#">
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
                            <p>Usuarios registrados <span id="cursos-creados-txt">3</span></p>
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
                                            <th style="width: 10%;">
                                                <span>Ciudad</span>
                                                <button></button>
                                            </th>
                                            <th style="width: 10%;">
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
                                        <tr id="tabla-curso-row-<?php echo $user[0]?>">
                                            <td class="td-checkbox">
                                                <label class="traing-check">
                                                    <input type="radio" name="usuario" value="<?php echo $curso[0]?>" autocomplete="off" />
                                                    <span class="traing-check-box"></span>
                                                    <span class="traing-check-name"></span>
                                                </label>
                                            </td>
                                            <td><?php echo $user[2].' '.$user[3]?></td>
                                            <td><?php echo $user[5]?></td>
                                            <td><?php echo $user[8]?></td>
                                            <td><?php echo $user[6]?></td>
                                            <td><?php echo $user[7]?></td>
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
        var usuarios_data = []
        <?php foreach($users as $user){?>
        usuarios_data.push({
            id:<?php echo $user[0]?>,
            tipo:"<?php echo $user[1]?>",
            nombres:"<?php echo $user[2]?>",
            apellidos:"<?php echo $user[3]?>",
            tipodoc:"<?php echo $user[4]?>",
            documento:<?php echo $user[5]?>,
            ciudad:"<?php echo $user[6]?>",
            empresa:"<?php echo $user[7]?>",
            correo:"<?php echo $user[8]?>",
        })
        <?php } ?>

        function findUser(id){
            var ind = -1
            for(var i = 0;i<usuarios_data.length;i++){
                if(usuarios_data[i].id==id){
                    ind = i
                }
            }
            return ind
        }

    </script>
</body>
</html>