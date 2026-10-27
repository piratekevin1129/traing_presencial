<div id="modal-repetir-curso" class="modal modal-off">
    <div class="modal-box">
        <div class="modal-header">
            <h1>...</h1>
            <button onclick="closeModal()">
                <img src="./public/assets/images/modal/close-modal-icon.svg" />
            </button>
        </div>
        <div class="modal-body col-height">
            <div class="col-full">
                <div class="select">
                    <select name="periodo" onchange="selectRepetirPeriodo(this)">
                        <option value="0">Selecciona una opción</option>
                        <option value="1">Todos los dias</option>
                        <option value="2">Dos veces a la semana</option>
                        <option value="3">Una vez a la semana</option>
                        <option value="4">Cada 8 días</option>
                        <option value="5">Cada 15 días</option>
                        <option value="6">Una vez al mes</option>
                    </select>
                    <label>Seleccione la secuencia para repetir el curso (Mes de <span id="current-mes-txt"></span>)</label>
                </div>
            </div>

            <div id="curso-presencial-opciones-repetir-o1" class="content-hidden">
                <!--al seleccionar todos los dias-->
                <div class="switch">
                    <label class="switch-radio">
                        <p>Incluir sábados y domingos</p>
                        <input onchange="toggleRepetirO1(this)" value="0" type="checkbox" />
                        <span></span>
                    </label>
                </div>
            </div>

            <div id="curso-presencial-opciones-repetir-o2" class="content-hidden">
                <!--al seleccionar dos veces a la semana-->
                <div class="col-mid">
                    <div class="dropdown" id="dropdown-dias-semana-o2" data-limit="2">
                        <div class="dropdown-list">
                            <div class="dropdown-list-item">
                                <label class="dropdown-list-radio">
                                    <p>Domingo</p>
                                    <input value="0" type="checkbox" name="dias-semana-o2" />
                                    <span></span>
                                </label>
                            </div>
                            <div class="dropdown-list-item">
                                <label class="dropdown-list-radio">
                                    <p>Lunes</p>
                                    <input value="1" type="checkbox" name="dias-semana-o2" />
                                    <span></span>
                                </label>
                            </div>
                            <div class="dropdown-list-item">
                                <label class="dropdown-list-radio">
                                    <p>Martes</p>
                                    <input value="2" type="checkbox" name="dias-semana-o2" />
                                    <span></span>
                                </label>
                            </div>
                            <div class="dropdown-list-item">
                                <label class="dropdown-list-radio">
                                    <p>Miércoles</p>
                                    <input value="3" type="checkbox" name="dias-semana-o2" />
                                    <span></span>
                                </label>
                            </div>
                            <div class="dropdown-list-item">
                                <label class="dropdown-list-radio">
                                    <p>Jueves</p>
                                    <input value="4" type="checkbox" name="dias-semana-o2" />
                                    <span></span>
                                </label>
                            </div>
                            <div class="dropdown-list-item">
                                <label class="dropdown-list-radio">
                                    <p>Viernes</p>
                                    <input value="5" type="checkbox" name="dias-semana-o2" />
                                    <span></span>
                                </label>
                            </div>
                            <div class="dropdown-list-item">
                                <label class="dropdown-list-radio">
                                    <p>Sábado</p>
                                    <input value="6" type="checkbox" name="dias-semana-o2" />
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="dropdown-box">
                            <div class="dropdown-text">Selecciona los días</div>
                            <div class="dropdown-arrow"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="curso-presencial-opciones-repetir-o3" class="content-hidden">
                <!--al seleccionar una vez a la semana-->
                <div class="col-mid">
                    <div class="select">
                        <select name="periodo-o3"><!--onchange="selectRepetirOpcion3(this)"-->
                            <option value="0">Selecciona una opción</option>
                            <option value="1">Domingo</option>
                            <option value="2">Lunes</option>
                            <option value="3">Martes</option>
                            <option value="4">Miércoles</option>
                            <option value="5">Jueves</option>
                            <option value="6">Viernes</option>
                            <option value="7">Sábado</option>
                        </select>
                        <label>Selecciona el día de la semana</label>
                    </div>
                </div>
            </div>

            <div id="curso-presencial-opciones-repetir-o4" class="content-hidden">
                <!--al seleccionar cada 8 dias-->
                <div class="col-mid">
                    <div class="select">
                        <select name="periodo-o4"><!--onchange="selectRepetirOpcion4(this)"-->
                            <option value="0">Selecciona una opción</option>
                            <option value="1">Domingo</option>
                            <option value="2 selected">Lunes</option>
                            <option value="3">Martes</option>
                            <option value="4">Miércoles</option>
                            <option value="5">Jueves</option>
                            <option value="6">Viernes</option>
                            <option value="7">Sábado</option>
                        </select>
                        <label>Comenzar desde el dia Lunes</label>
                    </div>
                </div>
            </div>

            <div id="curso-presencial-opciones-repetir-o5" class="content-hidden">
                <!--al seleccionar cada 15 dias-->
                <div class="col-mid">
                    <div class="select">
                        <select name="periodo-o5"><!--onchange="selectRepetirOpcion5(this)"-->
                            <option value="0">Selecciona una opción</option>
                            <option value="1">Domingo</option>
                            <option value="2 selected">Lunes</option>
                            <option value="3">Martes</option>
                            <option value="4">Miércoles</option>
                            <option value="5">Jueves</option>
                            <option value="6">Viernes</option>
                            <option value="7">Sábado</option>
                        </select>
                        <label>Comenzar desde el dia Lunes</label>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <button class="boton-cancelar" onclick="closeModal()">
                Cerrar
            </button>
            <button class="boton-principal" onclick="aplicarRepetir()">
                Aplicar
            </button>
        </div>
    </div>
</div>