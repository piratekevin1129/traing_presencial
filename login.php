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
                    <div class="login-row-container">
                        <div class="login-row-container-col">
                            <div>
                                <img src="./public/assets/images/logo_u.png" />
                            </div>
                            <div>
                                <h1>Bienvenidos al sistema de</h1>
                                <h2>Registro de formación presencial</h2>
                            </div>
                        </div>
                        <br>
                        <div class="login-row-container-col2">
                            <div>
                                <img src="./public/assets/images/login-icon-1.svg" />
                            </div>
                            <div>
                                <h4>Registrar eventos:</h4>
                                <p>Registra cualquier tipo de capacitación, formación, o entrenamiento sin importar su duración</p>
                            </div>
                        </div>
                        <div class="login-row-container-col2">
                            <div>
                                <img src="./public/assets/images/login-icon-2.svg" />
                            </div>
                            <div>
                                <h4>Asistencia:</h4>
                                <p>Registro de los trabajadores que asistieron y aprobaron un curso específico.</p>
                            </div>
                        </div>
                        <div class="login-row-container-col2">
                            <div>
                                <img src="./public/assets/images/login-icon-3.svg" />
                            </div>
                            <div>
                                <h4>Documentación:</h4>
                                <p>Adjuntar el archivo de asistencia escaneado como soporte de un evento.</p>
                            </div>
                        </div>
                        <div class="login-row-container-col2">
                            <div>
                                <img src="./public/assets/images/login-icon-4.svg" />
                            </div>
                            <div>
                                <h4>Informes:</h4>
                                <p>Generar informes generales y específicos por curso, usuario, equipo, etc.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="login-row">
                    <div class="login-row-form">
                        <div class="login-row-form-head">
                            <p>Ingresar</p>
                        </div>
                        <div class="login-row-form-body">
                            <div class="login-row-form-input">
                                <input type="text" placeholder="Cédula *" maxlength="20" autocomplete="off" />
                            </div>
                            <div class="login-row-form-input">
                                <input type="password" placeholder="Contraseña *" maxlength="20" autocomplete="off" />
                            </div>
                            <button class="login-row-form-btn1" type="button">
                                Ingresar
                            </button>
                            
                            <a class="login-row-form-link">¿Olvidaste tu contraseña?</a>
                            
                            <button class="login-row-form-btn2" type="button">
                                Recuperar contraseña
                            </button>
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