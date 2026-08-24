<div id="modal-registro-usuarios-masivo" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>Registro masivo</h1>
            <button onclick="closeModal()">
                <img src="./public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-select-container">
                <select onchange="updateCursoPreview(this)">
                    <?php foreach($courses as $c=>$course){?>
                        <?php if($c==0){?>
                            <option data-img="<?php echo $course['img']?>" selected value="<?php echo $course['id']?>"><?php echo $course['nombre']?></option>
                        <?php }else{ ?>
                            <option data-img="<?php echo $course['img']?>" value="<?php echo $course['id']?>"><?php echo $course['nombre']?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-curso-preview">
                <div class="modal-curso-preview-img">
                    <img id="modal-curso-img" src="./public/assets/images/cursos/<?php echo $courses[0]['img']?>" />
                </div>
                <div class="modal-curso-preview-info">
                    <p id="modal-curso-name-txt"><?php echo $courses[0]['nombre']?></p>
                    <div>
                        <button>
                            <img src="./public/assets/images/modal/time-modal-icon.svg" />
                        </button>
                        <button>
                            <img src="./public/assets/images/modal/fecha-modal-icon.svg" />
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-input-container">
                <div class="modal-input">
                    <input type="file" name="archivo" onchange="updateCursoFile(this)" accept=".xlsx"  />
                    <p id="modal-input-file-txt">Subir archivo excel</p>
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
                                <td>Jefferson Gutierritos</td>
                                <td>123456789</td>
                                <td>Neiva</td>
                                <td>Isagen</td>
                                <td>jeffersongutierritos@gmail.com</td>
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
    
