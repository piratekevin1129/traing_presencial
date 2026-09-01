<?php $menu_active = [1,1];?>
<?php require('./data/users.php');?>
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
    <link href="./public/assets/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/form.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/dropdown.css" rel="stylesheet" type="text/css" />
    
    <title>Traing Presencial - Usuarios</title>
</head>
<body>
    <div class="main-container">
        <?php include './layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include './layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todos los usuarios</h1>
                <div class="app-container">
                    <div class="botones-container">
                        <div class="botones-container-row">
                            <button class="boton-principal" onclick="openModal(this,'modal-formulario-usuario')">
                                <span>Registro individual</span>
                            </button>
                            <button class="boton-upload" onclick="openModal(this,'modal-registro-usuarios-masivo')">
                                <img src="./public/assets/images/button-upload-icon.svg" />
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
                                    <th style="width: 18%;">
                                        <span>Correo electrónico</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 5%;" class="text-center">
                                        <span>Ver</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user){?>
                                <tr id="tabla-usuario-row-<?php echo $user[0]?>">
                                    <td class="td-checkbox">
                                        <label class="traing-check">
                                            <input type="radio" name="usuario" value="<?php echo $user[0]?>" autocomplete="off" />
                                            <span class="traing-check-box"></span>
                                            <span class="traing-check-name"></span>
                                        </label>
                                    </td>
                                    <td><?php echo $tipos_trabajador[$user[1]]?></td>
                                    <td><?php echo $user[2]?></td>
                                    <td><?php echo $user[3]?></td>
                                    <td><?php echo $user[5]?></td>
                                    <td><?php echo $user[6]?></td>
                                    <td><?php echo $user[7]?></td>
                                    <td><?php echo $user[8]?></td>
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

    <?php include './components/modals/registrar-usuarios.php'; ?>
    <?php include './components/modals/form-usuario.php'; ?>

    <script src="./public/assets/scripts/modal.js"></script>
    <script src="./public/assets/scripts/form.js"></script>
    <script src="./public/assets/scripts/dropdown.js"></script>
    <script src="./public/assets/scripts/usuarios.js"></script>

    <script>
        var cursos_data = []
        <?php foreach($courses as $course){ ?>
        cursos_data.push({
            id:<?php echo $course['id']?>,
            nombre:"<?php echo $course['nombre']?>",
            img:"<?php echo $course['img']?>"
        })
        <?php } ?>

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