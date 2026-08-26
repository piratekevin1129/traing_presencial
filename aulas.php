<?php $menu_active = [3,1];?>
<?php require('./data/rooms.php');?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include './layouts/css.php'; ?>
    <link href="./public/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/tabla.css" rel="stylesheet" type="text/css" />
    
    <title>Traing Presencial - Aulas</title>
</head>
<body>
    <div class="main-container">
        <?php include './layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include './layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todas las aulas</h1>
                <div class="app-container">
                    <div class="botones-container">
                        <div class="botones-container-row">
                            <button class="boton-principal">
                                Registro individual
                            </button>
                            <button class="boton-upload">
                                <img src="./public/assets/images/button-upload-icon.svg" />
                                <span>Cargar sedes masivamente</span>
                            </button>
                        </div>
                        <div class="botones-container-row">
                            <button class="boton-normal">
                                Editar
                            </button>
                            <button class="boton-normal">
                                Eliminar
                            </button>
                        </div>
                    </div>
                    <div class="tabla-container">
                        <table class="traing-tabla">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">
                                        <!--input radio-->
                                    </th>
                                    <th style="width: 30%;">
                                        <span>Nombre aula</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 30%;">
                                        <span>Sede</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 35%;">
                                        <span>Información</span>
                                        <button></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rooms as $room){?>
                                <tr>
                                    <td class="td-checkbox">
                                        <label class="traing-check">
                                            <input type="radio" name="traing-check" value="<?php echo $room[0]?>" />
                                            <span class="traing-check-box"></span>
                                            <span class="traing-check-name"></span>
                                        </label>
                                    </td>
                                    <td><?php echo $room[1]?></td>
                                    <td><?php echo $room[2]?></td>
                                    <td><?php echo $room[3]?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="./public/assets/scripts/menu.js"></script>
</body>
</html>