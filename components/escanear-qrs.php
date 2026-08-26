<div id="modal-codigos-qr" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModalIndividual()">
                <img src="./public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-label">Nombre del curso</p>
            <p id="modal-curso-nombre-txt">...</p>
            <div class="modal-curso-col">
                <div class="modal-curso-row">
                    <img id="modal-curso-image-txt" src="" />
                </div>
                <div class="modal-curso-row">
                    <div class="modal-curso-formgroup">
                        <h4>Fecha y hora</h4>
                        <p id="modal-curso-fecha-txt">...</p>
                    </div>
                    <div class="modal-curso-formgroup">
                        <h4>Sede</h4>
                        <p id="modal-curso-sede-txt">...</p>
                    </div>
                    <div class="modal-curso-formgroup">
                        <h4>Ubicación</h4>
                        <div>
                            <div>
                                <img src="./public/assets/images/accordion/accordion-mapa-icon.svg" />
                            </div>
                            <span id="modal-curso-ubicacion-txt">...</span>
                        </div>
                    </div>
                    <div class="accordion-content-info-col">
                        <h4>Facilitador</h4>
                        <p id="modal-curso-fecha-txt">...</p>
                    </div>
                </div>
            </div>

            <div class="modal-qr-container">
                <div class="modal-qr-header">
                    <p id="modal-title-txt">...</p>
                </div>
                <div class="modal-qr-body">
                    <p>Escanear Código QR</p>
                    <div class="modal-camera">
                        <img src="./public/assets/images/modal/camera-icon.svg" />
                    </div>
                    <div class="modal-curso-formgroup">
                        <h4>Nombre completo</h4>
                        <p id="modal-usuario-nombre-txt">...</p>
                    </div>
                    <div class="modal-curso-formgroup">
                        <h4>Documento</h4>
                        <p id="modal-usuario-documento-txt">...</p>
                    </div>
                    <div class="modal-curso-formgroup">
                        <h4>Hora de ingreso</h4>
                        <p id="modal-usuario-hora-txt">...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="boton-principal" onclick="closeModalIndividual()">
                Guardar
            </button>
        </div>
    </div>
</div>