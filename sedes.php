<?php $menu_active = [2,1];?>
<?php require('./data/headquarters.php');?>

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
    
    <title>Traing Presencial - Sedes</title>
</head>
<body>
    <div class="main-container">
        <?php include './layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include './layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todas las sedes</h1>
                <div class="app-container">
                    <div class="botones-container">
                        <div class="botones-container-row">
                            <button class="boton-principal">
                                <span>Registro individual</span>
                            </button>
                            <button class="boton-upload">
                                <img src="./public/assets/images/button-upload-icon.svg" />
                                <span>Cargar sedes masivamente</span>
                            </button>
                        </div>
                        <div class="botones-container-row">
                            <!--<button class="boton-normal">
                                <span>Editar</span>
                            </button>
                            <button class="boton-normal">
                                <span>Eliminar</span>
                            </button>-->
                        </div>
                    </div>
                    <div class="tabla-container">
                        <table class="traing-tabla">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">
                                        <!--input radio-->
                                    </th>
                                    <th style="width: 18%;">
                                        <span>Nombre sede</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 18%;">
                                        <span>Departamento</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 18%;">
                                        <span>Ciudad / Municipio</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 21%;">
                                        <span>Dirección</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 20%;">
                                        <span>Ubicación en el mapa</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($headquarters as $headquarter){?>
                                <tr>
                                    <td class="td-checkbox">
                                        <label class="traing-check">
                                            <input type="radio" name="traing-check" value="<?php echo $headquarter[0]?>" />
                                            <span class="traing-check-box"></span>
                                            <span class="traing-check-name"></span>
                                        </label>
                                    </td>
                                    <td><?php echo $headquarter[1]?></td>
                                    <td><?php echo $headquarter[2]?></td>
                                    <td><?php echo $headquarter[3]?></td>
                                    <td><?php echo $headquarter[4]?></td>
                                    <td class="td-boton">
                                        <button>
                                            <img src="./public/assets/images/button-mapa-icon.svg" />
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

</body>
</html>