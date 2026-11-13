<div id="modal-registro-usuarios-masivo" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModalMasivo()">
                <img src="<?php echo $base ?>public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-subtitle">Cursos disponibles</p>

            <div class="modal-dropdown-container">
                <button id="cursos-dropdown-2" class="modal-dropdown modal-dropdown-collapsed" onfocus="toggleDropdown(this,'on')" onblur="toggleDropdown(this,'off')">
                    <span>Agrega cursos</span>
                    <div class="modal-dropdown-box">
                        <?php foreach($courses as $c=>$course){?>                            
                        <div 
                            onclick="dropdownClickItem(this,<?php echo $c; ?>,2)" 
                            class="modal-dropdown-item" 
                            data-value="<?php echo $course['id']?>"
                        >
                            <div></div>
                            <p><?php echo $course['nombre']?></p>
                        </div>
                        <?php } ?>
                    </div>
                </button>
            </div>

            <div id="modal-cursos-preview-2" class="modal-cursos-preview">
                <!--<div class="modal-curso-preview"></div>-->
            </div>
            
            <div class="modal-input-container">
                <div class="modal-input">
                    <form>
                        <input id="lista-usuarios-txt" type="file" name="archivo" onchange="updateCursoFile(event)" accept=".xlsx"  />
                    </form>
                    <p>Subir archivo excel</p>
                    <img src="<?php echo $base ?>public/assets/images/button-upload-icon.svg" />
                </div>
            </div>
    
            <div id="modal-tabla-preview-tab" class="modal-preview-tabla modal-preview-tabla-off">
                <div class="modal-preview-tabla-header">
                    <p>Previsualización</p>
                </div>
                <div class="modal-preview-tabla-container">
                    <table class="modal-preview-table">
                        <thead>
                            <tr>
                                <th style="width: 16%;">Tipo trabajador</th>
                                <th style="width: 16%;">Nombre completo</th>
                                <th style="width: 16%;">Documento</th>
                                <th style="width: 16%;">Ciudad</th>
                                <th style="width: 16%;">Empresa</th>
                                <th style="width: 20%;">Correo</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-usuarios-tdbody">
                            <!---->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="boton-download" href="<?php echo $base ?>public/docs/usuarios-prueba.xlsx" target="_blank">
                <img src="<?php echo $base ?>public/assets/images/button-download-icon.svg" />
                <span>Descarga de archivo guía en excel</span>
            </a>
            <button class="boton-principal" onclick="guardarUsuariosMasivo()">
                Registrar usuarios
            </button>
        </div>
    </div>
</div>
    
