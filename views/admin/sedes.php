<?php $menu_active = [3,1];?>
<?php require('../../api/env.php');?>
<?php require('../../data/headquarters.php');?>

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

    <link href="<?php echo $base ?>components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>components/loader/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $base ?>public/assets/scripts/jquery-4.0.0.min.js"></script>
    
    <title>Traing Presencial - Sedes</title>
</head>
<body>
    <div class="main-container">
        <?php include '../../layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include '../../layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todas las sedes</h1>
                <div class="app-container">
                    <div class="botones-container">
                        <div class="botones-container-row">
                            <button class="boton-principal" onclick="agregarSede(this)">
                                <span>Registro individual</span>
                            </button>
                            <!--<button class="boton-upload">
                                <img src="<?php echo $base ?>public/assets/images/button-upload-icon.svg" />
                                <span>Cargar sedes masivamente</span>
                            </button>-->
                        </div>
                        <div class="botones-container-row">
                            <?php if(count($headquarters)>0){?>
                            <button class="boton-normal" onclick="editarSede()">
                                <span>Editar</span>
                            </button>
                            <button class="boton-normal" onclick="eliminarSede()">
                                <span>Eliminar</span>
                            </button>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if(count($headquarters)==0){?>
                    <p class="text">No hay sedes registradas</p>
                    <?php } else { ?>
                    <div class="tabla-container">
                        <table id="tabla-sedes" class="traing-tabla">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">
                                        <!--input radio-->
                                    </th>
                                    <th style="width: 25%;">
                                        <span>Nombre sede</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 20%;">
                                        <span>Departamento</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 20%;">
                                        <span>Ciudad / Municipio</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 30%;">
                                        <span>Dirección</span>
                                        <button></button>
                                    </th>
                                    <!--<th style="width: 20%;" class="text-center">
                                        <span>Ubicación en el mapa</span>
                                    </th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($headquarters as $headquarter){?>
                                <tr id="tabla-sede-row-<?php echo $headquarter['id']?>">
                                    <td class="td-checkbox">
                                        <label class="traing-check">
                                            <input type="radio" name="sede" value="<?php echo $headquarter['id']?>" autocomplete="off" />
                                            <span class="traing-check-box"></span>
                                            <span class="traing-check-name"></span>
                                        </label>
                                    </td>
                                    <td><?php echo $headquarter['nombre']?></td>
                                    <td><?php echo $headquarter['departamento']?></td>
                                    <td><?php echo $headquarter['ciudad']?></td>
                                    <td><?php echo $headquarter['direccion']?></td>
                                    <!--<td class="td-boton">
                                        <button>
                                            <img src="<?php echo $base ?>public/assets/images/button-mapa-icon.svg" />
                                        </button>
                                    </td>-->
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include './modals/form-sede.php'; ?>
    <?php include '../../components/sweetalert/sweetalert.php'; ?>
    <?php include '../../components/loader/loader.php'; ?>

    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/form.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/admin/sedes.js"></script>

    <script>
        var sedes_data = []
        <?php foreach($headquarters as $headquarter){?>
        sedes_data.push({
            id:<?php echo $headquarter['id']?>,
            nombre:"<?php echo $headquarter['nombre']?>",
            departamento:"<?php echo $headquarter['departamento']?>",
            ciudad:"<?php echo $headquarter['ciudad']?>",
            direccion:"<?php echo $headquarter['direccion']?>"
        })
        <?php } ?>

        function findHeadquarter(id){
            var ind = -1
            for(var i = 0;i<sedes_data.length;i++){
                if(sedes_data[i].id==id){
                    ind = i
                }
            }
            return ind
        }
    </script>
</body>
</html>