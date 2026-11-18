<div id="modal-registro-usuarios-masivo" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModalMasivo()">
                <img src="<?php echo $base ?>public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">            
            <div class="modal-input-container">
                <div class="modal-input">
                    <form id="lista-facilitadores-form">
                        <input id="lista-facilitadores-txt" type="file" name="archivo" onchange="updateCursoFile(event)" accept=".xlsx"  />
                    </form>
                    <p id="lista-facilitadores-name">Subir archivo excel</p>
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
                                <th style="width: 24%;">Nombre completo</th>
                                <th style="width: 12%;">Documento</th>
                                <th style="width: 12%;">Ciudad</th>
                                <th style="width: 12%;">Empresa</th>
                                <th style="width: 22%;">Correo</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-facilitadores-tbody">
                            <!---->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="boton-download" href="<?php echo $base ?>public/docs/facilitadores-prueba.xlsx" target="_blank">
                <img src="<?php echo $base ?>public/assets/images/button-download-icon.svg" />
                <span>Descarga de archivo guía en excel</span>
            </a>
            <button class="boton-principal" onclick="guardarFacilitadoresMasivo()">
                Registrar facilitadores
            </button>
        </div>
    </div>
</div>
    
