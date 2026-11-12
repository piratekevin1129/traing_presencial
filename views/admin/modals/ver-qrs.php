<div id="modal-codigos-qr2" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModal()">
                <img src="<?php echo $base ?>public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            
            <div class="modal-qr-col">
                <div class="modal-qr-row">
                    <p id="modal-qr-title">...</p>
                    <div>
                        <img id="qr-img" src="" />
                    </div>
                    <a id="qr-link" target="_blank">
                        <img src="<?php echo $base ?>public/assets/images/button-download2-icon.svg" />
                        <span>Descargar</span>
                    </a>
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