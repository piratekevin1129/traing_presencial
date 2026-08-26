<div id="modal-registro-usuarios-masivo" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModal()">
                <img src="./public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-subtitle">Cursos disponibles</p>

            <div class="modal-dropdown-container">
                <button class="modal-dropdown modal-dropdown-collapsed" onfocus="toggleDropdown(this,'on')" onblur="toggleDropdown(this,'off')">
                    <span>Agrega cursos</span>
                    <div class="modal-dropdown-box">
                        <?php foreach($courses as $c=>$course){?>                            
                            <div onclick="dropdownClickItem(this,<?php echo $c; ?>,2) "class="" data-img="<?php echo $course['img']?>" data-value="<?php echo $course['id']?>">
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
                    <input type="file" name="archivo" onchange="updateCursoFile(this)" accept=".xlsx"  />
                    <p>Subir archivo excel</p>
                    <img src="./public/assets/images/button-upload-icon.svg" />
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
                        <tbody>
                            <tr>
                                <td>Contratista</td>
                                <td>Jefferson Gutierritos</td>
                                <td>123456789</td>
                                <td>Neiva</td>
                                <td>Isagen</td>
                                <td>jeffersongutierritos@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Contratista</td>
                                <td>Alvin Yakitori</td>
                                <td>987654321</td>
                                <td>Ibagué</td>
                                <td>Isagen</td>
                                <td>alvinyakitori@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Estudiante</td>
                                <td>Drake Bell</td>
                                <td>111234567</td>
                                <td>Cartagena</td>
                                <td>Isagen</td>
                                <td>drakebell@gmail.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="boton-download" href="./public/docs/usuarios-prueba.xlsx" target="_blank">
                <img src="./public/assets/images/button-download-icon.svg" />
                <span>Descarga de archivo guía en excel</span>
            </a>
            <button class="boton-principal" onclick="closeModal()">
                Registrar usuarios
            </button>
        </div>
    </div>
</div>
    
