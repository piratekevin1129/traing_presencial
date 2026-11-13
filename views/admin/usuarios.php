<?php $menu_active = [1,1];?>
<?php require('../../api/env.php');?>
<?php require('../../data/users.php');?>
<?php require('../../data/courses.php');?>

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
    
    <link href="<?php echo $base ?>components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>components/loader/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $base ?>public/assets/scripts/jquery-4.0.0.min.js"></script>
    <title>Traing Presencial - Usuarios</title>
</head>
<body>
    <div class="main-container">
        <?php include '../../layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include '../../layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todos los usuarios</h1>
                <div class="app-container">
                    <div class="botones-container">
                        <div class="botones-container-row">
                            <button class="boton-principal" onclick="agregarUsuario(this)">
                                <span>Registro individual</span>
                            </button>
                            <button class="boton-upload" onclick="openModal(this,'modal-registro-usuarios-masivo')">
                                <img src="<?php echo $base ?>public/assets/images/button-upload-icon.svg" />
                                <span>Cargar usuarios masivamente</span>
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
                                    <!--<th style="width: 5%;" class="text-center">
                                        <span>Ver</span>
                                    </th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user){?>
                                <tr id="tabla-usuario-row-<?php echo $user['id']?>">
                                    <td class="td-checkbox">
                                        <label class="traing-check">
                                            <input type="radio" name="usuario" value="<?php echo $user['id']?>" autocomplete="off" />
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

    <?php include './modals/registrar-usuarios.php'; ?>
    <?php include './modals/form-usuario.php'; ?>
    <?php include '../../components/sweetalert/sweetalert.php'; ?>
    <?php include '../../components/loader/loader.php'; ?>

    <!-- use version 0.20.3 -->
    <script type="text/javascript" src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/form.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/dropdown.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/admin/usuarios.js"></script>

    <script>
        var cursos_data = []
        <?php foreach($courses as $course){ ?>
        cursos_data.push({
            id:<?php echo $course['id']?>,
            nombre:"<?php echo $course['nombre']?>",
            img:"<?php echo $course['img']?>",
            fecha:"<?php echo $course['fecha']?>"
        })
        <?php } ?>

        var usuarios_data = []
        <?php foreach($users as $user){?>
        usuarios_data.push({
            id:<?php echo $user['id']?>,
            tipou:"<?php echo $user['tipou']?>",
            nombre:"<?php echo $user['nombre']?>",
            apellido:"<?php echo $user['apellido']?>",
            tipod:"<?php echo $user['tipod']?>",
            documento:<?php echo $user['documento']?>,
            ciudad:"<?php echo $user['ciudad']?>",
            empresa:"<?php echo $user['empresa']?>",
            correo:"<?php echo $user['correo']?>",
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