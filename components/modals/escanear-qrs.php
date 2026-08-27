<div id="modal-codigos-qr" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModal()">
                <img src="./public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            
            <div class="modal-curso-col">
                <div class="modal-curso-row">
                    <img id="modal-curso-image-txt" src="" />

                    <div class="modal-curso-formgroup">
                        <h4>Nombre del curso</h4>
                        <p id="modal-curso-nombre-txt">...</p>
                    </div>
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
                    <div class="modal-curso-formgroup">
                        <h4>Facilitador</h4>
                        <p id="modal-curso-facilitador-txt">...</p>
                    </div>
                </div>
            </div>

            <div class="modal-qr-container">
                <div class="modal-qr-header">
                    <p id="modal-qr-title-txt">...</p>
                </div>
                <div class="modal-qr-body">
                    <div class="modal-qr-body-col1">
                        <div class="modal-camera" onclick="clickEscanearQr()">
                            <div>
                                <img src="./public/assets/images/modal/camera-icon.svg" />
                            </div>
                        </div>
                        <p>Haz click para escanear el código QR</p>
                    </div>
                    <div class="modal-qr-body-col2">
                        <div class="modal-curso-formgroup">
                            <h4>Nombre completo</h4>
                            <p id="modal-usuario-nombre-txt">Armando Mendoza Suarez</p>
                        </div>
                        <div class="modal-curso-formgroup">
                            <h4>Documento</h4>
                            <p id="modal-usuario-documento-txt">123456789</p>
                        </div>
                        <div class="modal-curso-formgroup">
                            <h4>Hora de ingreso</h4>
                            <p id="modal-usuario-hora-txt">...</p>
                        </div>
                    </div>
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

<div id="modal-camara" class="modal-camara-off">
    <canvas id="qr-canvas" width="300" height="300"></canvas>
    <button class="boton-cancelar" onclick="clickCerrarQr()">
        <span>Cancelar</span>
    </button>
</div>