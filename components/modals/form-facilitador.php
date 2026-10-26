<div id="modal-formulario-usuario" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModalIndividual()">
                <img src="./public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-form-row2">
                <div class="modal-form-col">
                    <select id="tipo-documento-txt">
                        <option value="0">Tipo de documento</option>
                        <option value="cc">Cédula de ciudadanía</option>
                        <option value="ce">Cédula extranjera</option>
                    </select>
                </div>
                <div class="modal-form-col">
                    <input id="numero-documento-txt" type="text" placeholder="Número de documento" maxlength="20" autocomplete="off" />
                </div>
            </div>
            <div class="modal-form-row2">
                <div class="modal-form-col">
                    <input id="nombres-txt" type="text" placeholder="Nombres" maxlength="100" autocomplete="off" />
                </div>
                <div class="modal-form-col">
                    <input id="apellidos-txt" type="text" placeholder="Apellidos" maxlength="100" autocomplete="off" />
                </div>
            </div>
            <div class="modal-form-row1">
                <div class="modal-form-col">
                    <input id="correo-txt" type="text" placeholder="Correo electrónico" maxlength="100" autocomplete="off" />
                </div>
            </div>
            <div class="modal-form-row2">
                <div class="modal-form-col">
                    <input id="ciudad-txt" type="text" placeholder="Ciudad" maxlength="100" autocomplete="off" />
                </div>
                <div class="modal-form-col">
                    <input id="empresa-txt" type="text" placeholder="Empresa" maxlength="100" autocomplete="off" />
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