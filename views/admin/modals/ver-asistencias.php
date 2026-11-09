<div id="modal-ver-asistencias" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModal()">
                <img src="<?php echo $base ?>public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-preview-tabla">                
                <div class="modal-preview-tabla-container">
                    <table class="modal-preview-table">
                        <thead>
                            <tr>
                                <th style="width: 12%;">Tipo trabajador</th>
                                <th style="width: 16%;">Nombre completo</th>
                                <th style="width: 14%;">Documento</th>
                                <th style="width: 14%;">Ciudad</th>
                                <th style="width: 13%;">Empresa</th>
                                <th style="width: 16%;">Correo</th>
                                <th style="width: 15%;">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-asistencia-tdbody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="boton-normal" onclick="actualizarModal()">
                Actualizar
            </button>
            <button class="boton-principal" onclick="closeModalAsistencias()">
                Cerrar
            </button>
        </div>
    </div>
</div>
    
