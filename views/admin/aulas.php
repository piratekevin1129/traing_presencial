<?php $menu_active = [4,1];?>
<?php require('../../api/env.php');?>
<?php require('../../data/rooms.php');?>
<?php require('../../data/headquarters.php');?>

<?php 
foreach($rooms as $indx => $r){
    foreach($headquarters as $h){
        if($r['sedeid']==$h['id']){
            $rooms[$indx]['sede'] = $h['nombre'];
        }
    }
}
?>

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
    <title>Traing Presencial - Aulas</title>
</head>
<body>
    <div class="main-container">
        <?php include '../../layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include '../../layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todas las aulas</h1>
                <div class="app-container">
                    <div class="botones-container">
                        <div class="botones-container-row">
                            <button class="boton-principal" onclick="agregarAula(this)">
                                <span>Registro individual</span>
                            </button>
                            <!--<button class="boton-upload">
                                <img src="<?php echo $base ?>public/assets/images/button-upload-icon.svg" />
                                <span>Cargar aulas masivamente</span>
                            </button>-->
                        </div>
                        <div class="botones-container-row">
                            <?php if(count($rooms)>0){?>
                            <button class="boton-normal" onclick="editarAula()">
                                <span>Editar</span>
                            </button>
                            <button class="boton-normal" onclick="eliminarAula()">
                                <span>Eliminar</span>
                            </button>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if(count($rooms)==0){?>
                    <p class="text">No hay aulas registradas</p>
                    <?php } else { ?>
                    <div class="tabla-container">
                        <table id="tabla-aulas" class="traing-tabla">
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
                                <tr id="tabla-aula-row-<?php echo $room['id']?>">
                                    <td class="td-checkbox">
                                        <label class="traing-check">
                                            <input type="radio" name="aula" value="<?php echo $room['id']?>" />
                                            <span class="traing-check-box"></span>
                                            <span class="traing-check-name"></span>
                                        </label>
                                    </td>
                                    <td><?php echo $room['nombre']?></td>
                                    <td><?php echo $room['sede']?></td>
                                    <td><?php echo $room['extra']?></td>
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

    <?php include './modals/form-aula.php'; ?>
    <?php include '../../components/sweetalert/sweetalert.php'; ?>
    <?php include '../../components/loader/loader.php'; ?>

    <script src="<?php echo $base ?>public/assets/scripts/modal.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/form.js"></script>
    <script src="<?php echo $base ?>public/assets/scripts/admin/aulas.js"></script>

    <script>
        var aulas_data = []
        <?php foreach($rooms as $room){?>
        aulas_data.push({
            id:<?php echo $room['id']?>,
            nombre:"<?php echo $room['nombre']?>",
            extra:"<?php echo $room['extra']?>",
            sedeid:<?php echo $room['sedeid']?>
        })
        <?php } ?>

        function findRoom(id){
            var ind = -1
            for(var i = 0;i<aulas_data.length;i++){
                if(aulas_data[i].id==id){
                    ind = i
                }
            }
            return ind
        }
    </script>
</body>
</html>