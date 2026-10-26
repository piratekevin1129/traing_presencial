<div id="modal-registro-usuarios-masivo" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModalMasivo()">
                <img src="./public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">            
            <div class="modal-input-container">
                <div class="modal-input">
                    <form>
                        <input id="lista-usuarios-txt" type="file" name="archivo" onchange="updateCursoFile(this)" accept=".xlsx"  />
                    </form>
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
                                <th style="width: 24%;">Nombre completo</th>
                                <th style="width: 12%;">Documento</th>
                                <th style="width: 12%;">Ciudad</th>
                                <th style="width: 12%;">Empresa</th>
                                <th style="width: 22%;">Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jefferson Gutierrez</td>
                                <td>123456789</td>
                                <td>Neiva</td>
                                <td>Isagen</td>
                                <td>jeffersongutierres@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Angie Yepes</td>
                                <td>987654321</td>
                                <td>Ibagué</td>
                                <td>Isagen</td>
                                <td>angieyepes@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Diego Benitez</td>
                                <td>111234567</td>
                                <td>Cartagena</td>
                                <td>Isagen</td>
                                <td>diegobenitez@gmail.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="boton-download" href="./public/docs/facilitadores-prueba.xlsx" target="_blank">
                <img src="./public/assets/images/button-download-icon.svg" />
                <span>Descarga de archivo guía en excel</span>
            </a>
            <button class="boton-principal" onclick="closeModalMasivo()">
                Registrar facilitadores
            </button>
        </div>
    </div>
</div>
    
