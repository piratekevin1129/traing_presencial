<?php $menu_active = [1,1];?>
<?php require('./data/users.php');?>
<?php require('./data/courses.php');?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include './layouts/css.php'; ?>
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
                            <button class="boton-normal">
                                <span>Editar</span>
                            </button>
                            <button class="boton-normal">
                                <span>Eliminar</span>
                            </button>
                        </div>
                    </div>
                    <div class="tabla-container">
                        <table class="traing-tabla">
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
                                    <th style="width: 5%;">
                                        <span>Ver</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user){?>
                                <tr>
                                    <td class="td-checkbox">
                                        <label class="traing-check">
                                            <input type="radio" name="traing-check" value="<?php echo $user[0]?>" />
                                            <span class="traing-check-box"></span>
                                            <span class="traing-check-name"></span>
                                        </label>
                                    </td>
                                    <td><?php echo $user[1]?></td>
                                    <td><?php echo $user[2]?></td>
                                    <td><?php echo $user[3]?></td>
                                    <td><?php echo $user[4]?></td>
                                    <td><?php echo $user[5]?></td>
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

    <?php include './components/registrar-usuarios.php'; ?>
    <?php include './components/form-usuario.php'; ?>

    <script src="./public/assets/scripts/menu.js"></script>
    <script src="./public/assets/scripts/modal.js"></script>
    <script src="./public/assets/scripts/form.js"></script>
    <script src="./public/assets/scripts/dropdown.js"></script>
    <script src="./public/assets/scripts/registrar-masivamente.js"></script>
    <script src="./data/usuarios-demo.js"></script>

    <script>
        var cursos_data = []
        <?php foreach($courses as $course){ ?>
        cursos_data.push({
            id:<?php echo $course['id']?>,
            nombre:"<?php echo $course['nombre']?>",
            img:"<?php echo $course['img']?>"
        })
        <?php } ?>
    </script>
</body>
</html>