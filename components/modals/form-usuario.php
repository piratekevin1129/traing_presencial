<div id="modal-formulario-usuario" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModalIndividual()">
                <img src="./public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-switch-container">
                <p class="modal-label">Selecciona tipo de usuario</p>
                <div id="tipo-trabajador-txt" class="modal-switch-buttons">
                    <div data-value="e" class="modal-switch-option selected" onclick="toggleSwitch(this)">
                        <span>Estudiante</span>
                    </div>
                    <div data-value="c" class="modal-switch-option" onclick="toggleSwitch(this)">
                        <span>Contratista</span>
                    </div>
                </div>
            </div>

            <div class="modal-form-row2">
                <div class="modal-form-col">
                    <select id="tipo-documento-txt">
                        <option value="0">Tipo de documento</option>
                        <option value="cc">Cédula de ciudadanía</option>
                        <option value="ce">Cédula extranjera</option>
                    </select>
                </div>
                <div class="modal-form-col">
                    <input id="numero-documento-txt" type="text" placeholder="Número de documento" maxlength="20" autocomplete="off" />
                </div>
            </div>
            <div class="modal-form-row2">
                <div class="modal-form-col">
                    <input id="nombres-txt" type="text" placeholder="Nombres" maxlength="100" autocomplete="off" />
                </div>
                <div class="modal-form-col">
                    <input id="apellidos-txt" type="text" placeholder="Apellidos" maxlength="100" autocomplete="off" />
                </div>
            </div>
            <div class="modal-form-row1">
                <div class="modal-form-col">
                    <input id="correo-txt" type="text" placeholder="Correo electrónico" maxlength="100" autocomplete="off" />
                </div>
            </div>
            <div class="modal-form-row2">
                <div class="modal-form-col">
                    <input id="ciudad-txt" type="text" placeholder="Ciudad" maxlength="100" autocomplete="off" />
                </div>
                <div class="modal-form-col">
                    <input id="empresa-txt" type="text" placeholder="Empresa" maxlength="100" autocomplete="off" />
                </div>
            </div>

            <p class="modal-subtitle">Cursos disponibles</p>

            <div class="modal-dropdown-container">
                <button id="cursos-dropdown-1" class="modal-dropdown modal-dropdown-collapsed" onfocus="toggleDropdown(this,'on')" onblur="toggleDropdown(this,'off')">
                    <span>Agrega cursos</span>
                    <div class="modal-dropdown-box">
                        <?php foreach($courses as $c=>$course){?>                            
                            <div onclick="dropdownClickItem(this,<?php echo $c; ?>,1)" class="" data-img="<?php echo $course['img']?>" data-value="<?php echo $course['id']?>">
                                <div></div>
                                <p><?php echo $course['nombre']?></p>
                            </div>
                        <?php } ?>
                    </div>
                </button>
            </div>

            <div id="modal-cursos-preview-1" class="modal-cursos-preview">
                <!--<div class="modal-curso-preview"></div>-->
            </div>
        </div>
        <div class="modal-footer">
            <button class="boton-principal" onclick="closeModalIndividual()">
                Guardar
            </button>
        </div>
    </div>
</div>