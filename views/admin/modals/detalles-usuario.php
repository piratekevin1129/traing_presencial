<div id="modal-detalles-usuario" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModal()">
                <img src="<?php echo $base ?>public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <p>Información</p>
            <div class="modal-preview-tabla">                
                <div class="modal-preview-tabla-container">
                    <table class="modal-preview-table">
                        <thead>
                            <tr>
                                <th style="width: 13%;">Tipo trabajador</th>
                                <th style="width: 20%;">Nombre completo</th>
                                <th style="width: 12%;">Documento</th>
                                <th style="width: 15%;">Ciudad</th>
                                <th style="width: 15%;">Empresa</th>
                                <th style="width: 25%;">Correo</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-detalles-tdbody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <p>Cursos asignados</p>
            <div class="modal-preview-tabla">                
                <div class="modal-preview-tabla-container">
                    <table class="modal-preview-table">
                        <thead>
                            <tr>
                                <th style="width: 55%;">Curso</th>
                                <th style="width: 15%;">Estado</th>
                                <th style="width: 15%;">Hora de entrada</th>
                                <th style="width: 15%;">Hora de salida</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-detalles2-tdbody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="boton-principal" onclick="closeModal()">
                Cerrar
            </button>
        </div>
    </div>
</div>
    
