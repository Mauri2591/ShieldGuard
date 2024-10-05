<div class="modal fade" id="mdlGestionaEscaneoNombre">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-1 ml-1">
                <h5 class="modal-title">Nuevo <span id="titulo_tipo_gestion"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <input type="hidden" hidden id="tipo_gestion" value="">

            <div class="modal-body p-0">
                <div class="container">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane text-left fade show active"
                                        id="vert-tabs-titulo_lanzar_escaneo" role="tabpanel"
                                        aria-labelledby="vert-tabs-home-tab">
                                        <div class="card card-light">
                                            <span class="badge bg-light d-flex"><span class="text-danger pr-2"
                                                    style="cursor:default" data-toggle="tooltip" data-placement="top"
                                                    title="Este campo es obligatorio">*</span>Nombre del Scanner</span>
                                            <div class="card-body">
                                                <div style="display: flex; margin-bottom: 1em;"><input
                                                        class="form-control form-control-sm" id="escaneo_titulo"
                                                        type="text" placeholder="Ingrese el nombre del Proyecto aqui">
                                                </div>
                                            </div>
                                            <span class="badge bg-light d-flex align-items-baseline">
                                                <label for="fecha_escaneo" class="mr-2"><span class="text-danger"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Puede cambiar la fecha y hora del escaneo o dejar la actual por defecto">*</span>
                                                    Fecha y hora</label>
                                                <input type="date" id="fecha_escaneo"
                                                    value="<?php echo date('Y-m-d'); ?>" style="outline:none">
                                                <input type="time" id="hora_escaneo" value="<?php echo date('H:i'); ?>"
                                                    style="height: 1.6em; outline:none;">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_preparar_escaneo" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="mdlGestionarAssetsIpsUrls">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Escaneo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-sm-3">
                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link py-1 active" id="vert-tabs-profile-tab" data-toggle="pill"
                                        href="#vert_tabs_ips_lanzar_escaneo" role="tab"
                                        aria-controls="vert-tabs-profile" aria-selected="false">Assets Ip's</a>
                                    <a class="nav-link py-1" id="vert-tabs-messages-tab" data-toggle="pill"
                                        href="#vert_tabs_urls_lanzar_escaneo" role="tab"
                                        aria-controls="vert_tabs_urls_lanzar_escaneo" aria-selected="false">Assets
                                        Url's</a>
                                </div>
                            </div>
                            <div class="col-7 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane show active fade" id="vert_tabs_ips_lanzar_escaneo"
                                        role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                        <div class="card-body bg-light pb-0">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <select multiple="multiple" id="mover_ips_lanzar_escaneos"
                                                            name="ips[]" style="height: 200px; outline: none;"
                                                            class="bg-light border border-light">
                                                            <!-- Aquí se cargarán las opciones dinámicamente -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="vert_tabs_urls_lanzar_escaneo" role="tabpanel"
                                        aria-labelledby="vert-tabs-messages-tab">
                                        <div class="card-body bg-light pb-0">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <select multiple="multiple" id="mover_urls_lanzar_escaneos"
                                                            name="urls[]" style="height: 200px; outline: none;"
                                                            class="bg-light border border-light">
                                                            <!-- Aquí se cargarán las opciones dinámicamente -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_agregar_assets_ips_urls" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>