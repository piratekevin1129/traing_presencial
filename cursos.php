<?php $menu_active = [2,1];?>
<?php require('./data/users.php');?>
<?php require('./data/courses.php');?>
<?php require('./data/courses_users.php');?>
<?php 

foreach($courses as $indx => $c){
    foreach($courses_users as $cu){
        if($c['id']==$cu['id']){
            $courses[$indx]['registrados'] = count($cu['users']);
        }
    }
}

?>

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
    
    <title>Traing Presencial - Cursos</title>
</head>
<body>
    <div class="main-container">
        <?php include './layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include './layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">Todos los cursos</h1>
                <div class="app-container">
                    <div class="tabla-container">
                        <table id="tabla-usuarios" class="traing-tabla">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">
                                        <span>Nombre</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 25%;" class="text-center">
                                        <span>Fecha y ubicación</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 15%;" class="text-center">
                                        <span>Usuarios registrados</span>
                                        <button></button>
                                    </th>
                                    <th style="width: 15%;" class="text-center">
                                        <span>Código QR</span>
                                    </th>
                                    <th style="width: 8%;" class="text-center">
                                        <span>Asistencias</span>
                                    </th>
                                    <th style="width: 7%;" class="text-center">
                                        <span>Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($courses as $course){?>
                                <tr>
                                    <td><?php echo $course['nombre']?></td>
                                    <td>
                                        <?php 
                                        echo $course['fecha'].'<br>';
                                        echo '<span>Sede: </span>'.$course['sede'].'<br>';
                                        echo '<span>Aula: </span>'.$course['aula'].'<br>';
                                        echo '<span>Dirección: </span>'.$course['direccion'] 
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $course['registrados']?></td>
                                    <td class="td-boton">
                                        <button class="button-qr" onclick="verQRS(<?php echo $course['id']?>)">
                                            <img src="./public/assets/images/button-qr-icon.svg" />
                                        </button>
                                    </td>
                                    <td class="td-boton">
                                        <button onclick="verAsistencias(<?php echo $course['id']?>)">
                                            <img src="./public/assets/images/button-ver-icon.svg" />
                                        </button>
                                    </td>
                                    <td class="td-boton">
                                        <button onclick="editarCurso(<?php echo $course['id']?>)">
                                            <img src="./public/assets/images/button-edit-icon.svg" />
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

    <!--modales-->
    <?php include './components/modals/ver-qrs.php'; ?>
    <?php include './components/modals/ver-asistencias.php'; ?>
    
    
    <script src="./public/assets/scripts/modal.js"></script>
    <script src="./public/assets/scripts/cursos.js"></script>

    <script>
        var cursos_data = []
        <?php foreach($courses as $course){ ?>
        cursos_data.push({
            id:<?php echo $course['id']?>,
            nombre:"<?php echo $course['nombre']?>",
            fecha:"<?php echo $course['fecha']?>",
            sede:"<?php echo $course['sede']?>",
            aula:"<?php echo $course['aula']?>",
            direccion:"<?php echo $course['direccion']?>",
            facilitador:"<?php echo $course['facilitador']?>",
            img:"<?php echo $course['img']?>"
        })
        <?php } ?>

        function findCourse(id){
            var ind = -1
            for(var i = 0;i<cursos_data.length;i++){
                if(cursos_data[i].id==id){
                    ind = i
                }
            }
            return ind
        }

    </script>
</body>
</html>