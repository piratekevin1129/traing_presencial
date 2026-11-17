<div id="modal-formulario-sede" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModal()">
                <img src="<?php echo $base ?>public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-form-row1">
                <div class="modal-form-col">
                    <input id="nombre-txt" type="text" placeholder="Nombre de la sede" maxlength="100" autocomplete="off" />
                </div>
            </div>
            <div class="modal-form-row2">
                <div class="modal-form-col">
                    <input id="departamento-txt" type="text" placeholder="Departamento" maxlength="100" autocomplete="off" />
                </div>
                <div class="modal-form-col">
                    <input id="ciudad-txt" type="text" placeholder="Ciudad/Municipio" maxlength="100" autocomplete="off" />
                </div>
            </div>
            <div class="modal-form-row1">
                <div class="modal-form-col">
                    <input id="direccion-txt" type="text" placeholder="Dirección" maxlength="100" autocomplete="off" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="boton-principal" onclick="registrarSede()">
                Guardar
            </button>
        </div>
    </div>
</div>