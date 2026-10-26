<?php $menu_active = [5,1];?>
<?php require('./data/teachers.php');?>

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
    
    <title>Traing Presencial - Facilitadores</title>
</head>
<body>
    <div class="main-container">
        <?php include './layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include './layouts/menu.php' ?>
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
                                <img src="./public/assets/images/button-upload-icon.svg" />
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
                                    <th style="width: 3%;">
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
                                    <th style="width: 22%;">
                                        <span>Correo electrónico</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 5%;" class="text-center">
                                        <span>Ver</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($teachers as $teacher){?>
                                <tr id="tabla-usuario-row-<?php echo $teacher[0]?>">
                                    <td class="td-checkbox">
                                        <label class="traing-check">
                                            <input type="radio" name="usuario" value="<?php echo $teacher[0]?>" autocomplete="off" />
                                            <span class="traing-check-box"></span>
                                            <span class="traing-check-name"></span>
                                        </label>
                                    </td>
                                    <td><?php echo $teacher[1]?></td>
                                    <td><?php echo $teacher[2]?></td>
                                    <td><?php echo $teacher[4]?></td>
                                    <td><?php echo $teacher[5]?></td>
                                    <td><?php echo $teacher[6]?></td>
                                    <td><?php echo $teacher[7]?></td>
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

    <?php include './components/modals/registrar-facilitadores.php'; ?>
    <?php include './components/modals/form-facilitador.php'; ?>

    <script src="./public/assets/scripts/modal.js"></script>
    <script src="./public/assets/scripts/form.js"></script>
    <script src="./public/assets/scripts/dropdown.js"></script>
    <script src="./public/assets/scripts/facilitadores.js"></script>

    <script>
        var cursos_data = []
        
        var facilitadores_data = []
        <?php foreach($teachers as $teacher){?>
        facilitadores_data.push({
            id:<?php echo $teacher[0]?>,
            nombres:"<?php echo $teacher[1]?>",
            apellidos:"<?php echo $teacher[2]?>",
            tipodoc:"<?php echo $teacher[3]?>",
            documento:<?php echo $teacher[4]?>,
            ciudad:"<?php echo $teacher[5]?>",
            empresa:"<?php echo $teacher[6]?>",
            correo:"<?php echo $teacher[7]?>"
        })
        <?php } ?>

        function findUser(id){
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