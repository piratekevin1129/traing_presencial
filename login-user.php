<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include './layouts/css.php'; ?>
    <link href="./public/assets/css/login.css" rel="stylesheet" type="text/css" />

    <title>Traing Presencial - Login</title>
</head>
<body>
    <div class="main-container">
        
        <?php include './layouts/header-login.php'; ?>
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
                                <input type="text" placeholder="Cédula *" maxlength="20" autocomplete="off" />
                            </div>

                            <a href="cursos-user.php" class="login-row-form-btn1" type="button">
                                Ingresar
                            </a>
                            
                        </div>
                        <div class="login-row-form-foot">
                            <p>Al ingresar manifiesto que he leido y acepto, la política de tratamiento de datos personales <a>(ver aqui)</a></p>
                            <br>
                            <p style="display: flex; align-items: center;">Navegador recomendado Chrome <img src="./public/assets/images/google-chrome-icon.svg" /></p>
                        </div>
    
                    </div>
                </div>
            </div>
    
            <!--whatsapp-->
        </div>
    </div>
</body>
</html>