<?php $menu_active = [5,1];?>
<?php require('../../api/env.php');?>
<?php require('../../data/teachers.php');?>

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
    <link href="<?php echo $base ?>public/assets/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/form.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>public/assets/css/dropdown.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo $base ?>public/assets/css/sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $base ?>public/assets/scripts/jquery-4.0.0.min.js"></script>
    <title>Traing Presencial - Facilitadores</title>
</head>
<body>
    <div class="main-container">
        <?php include '../../layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include '../../layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todos los facilitadores</h1>
                <div class="app-container">
                    <div class="botones-container">
                        <div class="botones-container-row">
                            <button class="boton-principal" onclick="openModal(this,'modal-formulario-usuario')">
                                <span>Registro individual</span>
                            </button>
                            <button class="boton-upload" onclick="openModal(this,'modal-registro-usuarios-masivo')">
                                <img src="<?php echo $base ?>public/assets/images/button-upload-icon.svg" />
                                <span>Cargar facilitadores masivamente</span>
                            </button>
                        </div>
                        <div class="botones-container-row">
                            <button class="boton-normal" onclick="editarUsuario()">
                                <span>Editar</span>
                            </button>
                            <button class="boton-normal" onclick="eliminarUsuario()">
                                <span>Eliminar</span>
                            </button>
                        </div>
                    </div>
                    <div class="tabla-container">
                        <table id="tabla-usuarios" class="traing-tabla">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">
                                        <!--input radio-->
                                    </th>
                                    <th style="width: 16%;">
                                        <span>Nombres</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 16%;">
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
                                    <th style="width: 25%;">
                                        <span>Correo electrónico</span>
                                        <button></button>
                                    </th>
                                    <!--<th style="width: 5%;" class="text-center">
                                        <span>Ver</span>
                                    </th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($teachers as $teacher){?>
                                <tr id="tabla-usuario-row-<?php echo $teacher['id']?>">
                                    <td class="td-checkbox">
                                        <label class="traing-check">
                                            <input type="radio" name="usuario" value="<?php echo $teacher['id']?>" autocomplete="off" />
                                            <span class="traing-check-box"></span>
                                            <span class="traing-check-name"></span>
                                        </label>
                                    </td>
                                    <td><?php echo $teacher['nombre']?></td>
                                    <td><?php echo $teacher['apellido']?></td>
                                    <td><?php echo $teacher['documento']?></td>
                                    <td><?php echo $teacher['ciudad']?></td>
                                    <td><?php echo $teacher['empresa']?></td>
                                    <td><?php echo $teacher['correo']?></td>
                                    <!--<td class="td-boton">
                                        <button>
                                            <img src="<?php echo $base ?>public/assets/images/button-ver-icon.svg" />
                                        </button>
                                    </td>-->
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include './modals/registrar-facilitadores.php'; ?>
    <?php include './modals/form-facilitador.php'; ?>
    <?php include '../../components/sweetalert/sweetalert.php'; ?>

    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/sweetalert.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/form.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/dropdown.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/facilitadores.js"></script>

    <script>
        var cursos_data = []
        
        var facilitadores_data = []
        <?php foreach($teachers as $teacher){?>
        facilitadores_data.push({
            id:<?php echo $teacher['id']?>,
            nombre:"<?php echo $teacher['nombre']?>",
            apellido:"<?php echo $teacher['apellido']?>",
            tipod:"<?php echo $teacher['tipod']?>",
            documento:<?php echo $teacher['documento']?>,
            ciudad:"<?php echo $teacher['ciudad']?>",
            empresa:"<?php echo $teacher['empresa']?>",
            correo:"<?php echo $teacher['correo']?>"
        })
        <?php } ?>

        function findFacilitador(id){
            var ind = -1
            for(var i = 0;i<facilitadores_data.length;i++){
                if(facilitadores_data[i].id==id){
                    ind = i
                }
            }
            return ind
        }

    </script>
</body>
</html>