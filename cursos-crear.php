<?php $menu_active = [2,2];?>
<?php require('./data/users.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include './layouts/css.php'; ?>
    <?php include './layouts/scripts.php'; ?>
    <link href="./public/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
    <link href="./public/traing/assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="./public/traing/assets/css/presencial.css" rel="stylesheet" type="text/css" />

    <title>Demo</title>
</head>
<body>
    <div class="main-container">
        <?php include './layouts/header.php'; ?>
        <div class="body-container body-container-dashboard">
            <?php include './layouts/menu.php' ?>
            <div id="app" class="app-opened">
                <!--contenido aqui ↓↓↓-->
                <h1 class="main-title">CREAR CURSO/INDUCCIONES</h1>
                <div class="app-container">
                    <div class="col-mid">
                        <div class="input">
                            <input type="text" maxlength="100" autocomplete="off" name="nombre" />
                            <label>Mínimo 3 máximo 100 caracteres</label>
                        </div>
                    </div>

                    <div class="steps-container">
                        <div class="step-item selected">
                            <div class="step-line"></div>
                            <div class="step-item-icon">
                                <div></div>
                            </div>
                            <p class="step-text">Información básica</p>
                        </div>
                        <div class="step-item">
                            <div class="step-line"></div>
                            <div class="step-item-icon">
                                <div></div>
                            </div>
                            <p class="step-text">Contenidos</p>
                        </div>
                        <div class="step-item">
                            <div class="step-line"></div>
                            <div class="step-item-icon">
                                <div></div>
                            </div>
                            <p class="step-text">Certificado</p>
                        </div>
                        <div class="step-item">
                            <div class="step-line"></div>
                            <div class="step-item-icon">
                                <div></div>
                            </div>
                            <p class="step-text">Asignación</p>
                        </div>
                    </div>

                    <div class="row">
                        <!--70%-->
                        <div class="col-formulario">
                            <!--
                            <div class="col-flex">
                                <div class="switch">
                                    <label class="switch-radio">
                                        <p>Curso autoasignable</p>
                                        <input value="0" type="checkbox" name="cursoautoasignable" />
                                        <span></span>
                                    </label>
                                </div>
                                <div class="switch">
                                    <label class="switch-radio">
                                        <p>Curso presencial</p>
                                        <input onchange="togglePresencialOptions(this)" value="0" type="checkbox" name="cursoautoasignable" />
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            -->

                            <div class="textarea">
                                <textarea autocomplete="off" name="descripcion"></textarea>
                                <label>Mínimo 3 máximo 500 caracteres</label>
                            </div>

                            <div class="hr"></div>

                            <!--<div class="col-mid">
                                <div class="dropdown" id="dropdown-categoria">
                                    <div class="dropdown-list">
                                        <div class="dropdown-list-item">
                                            <label class="dropdown-list-radio">
                                                <p>Opción 1</p>
                                                <input value="1" type="checkbox" name="categoria" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="dropdown-list-item">
                                            <label data-value="2" class="dropdown-list-radio">
                                                <p>Opción 2</p>
                                                <input value="2" type="checkbox" name="categoria" />
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="dropdown-box">
                                        <div class="dropdown-text">Selecciona categorías</div>
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="hr"></div>-->
                        
                            <p class="text">Asigna los responsables encargados de tu curso</p>

                            <div class="col-mid">
                                <div class="dropdown" id="dropdown-encargado">
                                    <div class="dropdown-list">
                                        <div class="dropdown-list-item">
                                            <label class="dropdown-list-radio">
                                                <p>Opción 1</p>
                                                <input value="1" type="checkbox" name="encargado" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="dropdown-list-item">
                                            <label class="dropdown-list-radio">
                                                <p>Opción 2</p>
                                                <input value="2" type="checkbox" name="encargado" />
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="dropdown-box">
                                        <div class="dropdown-text">Selecciona responsables</div>
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="hr"></div>

                            <p class="text">Opciones del curso presencial</p>
        
                            <div class="switch">
                                <label class="switch-radio">
                                    <p>Repetir curso</p>
                                    <input onchange="toggleRepetir(this)" value="0" type="checkbox" name="repetircurso" />
                                    <span></span>
                                </label>
                            </div>

                            <div id="curso-presencial-opciones-repetir" class="content-hidden">
                                <div class="col-mid">
                                    <div class="select">
                                        <select name="periodo" onchange="toggleRepetirPeriodo(this)">
                                            <option value="0">Selecciona una opción</option>
                                            <option value="1">Todos los dias</option>
                                            <option value="2">Dia por medio</option>
                                            <option value="3">Dos veces a la semana</option>
                                            <option value="4">Una vez a la semana</option>
                                            <option value="5">Cada 8 días</option>
                                            <option value="6">Cada 15 días</option>
                                            <option value="7">Una vez al mes</option>
                                            <option value="8">Otro</option>
                                        </select>
                                        <label>Seleccione la secuencia para repetir el curso (Mes de <span id="current-mes-txt"></span>)</label>
                                    </div>
                                </div>
                            </div>

                            <div id="curso-presencial-opciones-periodo" class="content-visible">
                                <div class="calendario" id="curso-presencial-calendario">

                                </div>
                            </div>
                            
                            <div class="hr"></div>

                        </div>
                        <!--30%-->
                        <div class="col-imagen">
                            <div class="imagen-curso">
                                <img src="./public/assets/images/cursos/thumbnail-1.jpg" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--modales-->

    <script src="./assets/scripts/dropdown.js"></script>
    <script src="./assets/scripts/calendario.js"></script>
    <script>
        window.onload = function(){
            setDropdown()
            setCalendario('curso-presencial-calendario')
        }

        getE('current-mes-txt').innerHTML = meses[new Date().getUTCMonth()]

        function toggleRepetir(inpu){
            if(inpu.checked){
                getE('curso-presencial-opciones-repetir').className = 'content-visible'
            }else{
                getE('curso-presencial-opciones-repetir').className = 'content-hidden'
            }    
        }

        function toggleRepetirPeriodo(inpu){

        }
        
    </script>
</body>
</html>