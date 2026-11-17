<div id="modal-formulario-aula" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModal()">
                <img src="<?php echo $base ?>public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-form-row2">
                <div class="modal-form-col">
                    <input id="nombre-txt" type="text" placeholder="Nombre del aula" maxlength="100" autocomplete="off" />
                </div>
                <div class="modal-form-col">
                    <select id="sede-sel">
                        <option value="0">Seleccionar sede</option>
                        <?php foreach($headquarters as $headquarter){?>
                        <option value="<?php echo $headquarter['id'] ?>"><?php echo $headquarter['nombre']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="modal-form-row1">
                <div class="modal-form-col">
                    <input id="extra-txt" type="text" placeholder="Información adicional" maxlength="100" autocomplete="off" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="boton-principal" onclick="registrarAula()">
                Guardar
            </button>
        </div>
    </div>
</div>