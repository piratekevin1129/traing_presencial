<div id="modal-detalles-curso" class="modal modal-off">
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
                                <th style="width: 5%;">Id</th>
                                <th style="width: 25%;">Nombre</th>
                                <th style="width: 25%;">Facilitador</th>
                                <th style="width: 25%;">Ubicación</th>
                                <th style="width: 20%;">Fecha y hora</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-detalles-tdbody">
                            
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
    
