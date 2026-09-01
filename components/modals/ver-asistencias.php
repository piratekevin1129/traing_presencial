<div id="modal-ver-asistencias" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModal()">
                <img src="./public/assets/images/modal/close-modal-icon.svg" />
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
                        <tbody>
                            <?php foreach($users as $user){ ?>
                            <tr>
                                <td><?php echo $tipos_trabajador[$user[1]] ?></td>
                                <td><?php echo $user[2].' '.$user[3] ?></td>
                                <td><?php echo $user[5] ?></td>
                                <td><?php echo $user[6] ?></td>
                                <td><?php echo $user[7] ?></td>
                                <td><?php echo $user[8] ?></td>
                                <td class="td-boton">
                                    <?php if($user[9]==0){ ?>
                                        <div class="table-tag table-tag-gris">
                                            <img src="./public/assets/images/loading-icon.svg" />
                                            <p>Esperando</p>
                                        </div>
                                    <?php } else if($user[9]==1){ ?>
                                        <div class="table-tag table-tag-verde">
                                            <img src="./public/assets/images/check-icon.svg" />
                                            <p>Confirmado</p>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
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
    
