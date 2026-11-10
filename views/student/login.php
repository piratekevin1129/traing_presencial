<?php require('../../api/env.php');?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../layouts/css.php'; ?>
    <link href="<?php echo $base ?>public/assets/css/login.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base ?>components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $base ?>public/assets/scripts/jquery-4.0.0.min.js"></script>

    <title>Traing Presencial - Login</title>
</head>
<body>
    <div class="main-container">
        
        <?php include '../../layouts/header-login.php'; ?>
        <div class="body-container body-container-login">
            <!--contenido aqui ↓↓↓-->
            <div class="login-col">
                <div class="login-row">
                    <div class="login-row-form">
                        <div class="login-row-form-head">
                            <p>Ingresar</p>
                        </div>
                        <div class="login-row-form-body">
                            <div class="login-row-form-input">
                                <input type="text" placeholder="Cédula *" maxlength="20" autocomplete="off" id="cedula-txt" />
                            </div>
                            
                            <?php if(isset($_GET['courseid'])){ ?>
                            <input type="hidden" value="<?php echo $_GET['courseid']?>" id="curso-txt" />
                            <button href="curso-user.php" class="login-row-form-btn1" type="button" onclick="clickIngresar()">
                                Ingresar
                            </button>
                            <?php } ?>
                            
                        </div>
                        <div class="login-row-form-foot">
                            <p>Al ingresar manifiesto que he leido y acepto, la política de tratamiento de datos personales <a>(ver aqui)</a></p>
                            <br>
                            <p style="display: flex; align-items: center;">Navegador recomendado Chrome <img src="<?php echo $base ?>public/assets/images/google-chrome-icon.svg" /></p>
                        </div>
    
                    </div>
                </div>
            </div>
    
            <!--whatsapp-->
        </div>
    </div>

    <!--modales-->
    <?php include '../../components/sweetalert/sweetalert.php'; ?>

    <script src="<?php echo $base?>public/assets/scripts/student/login.js"></script>
    <script src="<?php echo $base?>public/assets/scripts/form.js"></script>
    <script>
        <?php if(!isset($_GET['courseid'])){ ?>
            openModalAlert({
                status:'warning',
                title:'¡Link incorrecto!',
                text:"Debes escanear el código QR al curso que deseas entrar",
                action: 'cerrarLogin'
            });
        <?php } ?>

        function cerrarLogin(){
            window.location.href = './prelogin.php'
        }
    </script>
</body>
</html>