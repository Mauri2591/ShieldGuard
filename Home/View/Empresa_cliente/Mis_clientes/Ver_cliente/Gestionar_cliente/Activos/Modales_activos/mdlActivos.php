<div class="modal fade" id="alta_usuario_cliente">
    <div class="modal-dialog">
        <div class="modal-content border-dark">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" style="font-family: monospace; font-weight: bold;"> Dar de alta una Cuenta <i class="far fa-user-circle text-info"></i> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="font-family: monospace;">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-sm" id="email_usuario_cliente" placeholder="Ingrese el correo del Usuario">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="font-family: monospace;">Rol</label>
                    <div class="col-sm-10">
                        <select id="rol_id" class="form-control form-control-sm">

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="font-family: monospace;">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" readonly id="password_usuario_cliente">
                    </div>
                </div>
                <span style="font-size: 14px; color: red;">ATENCION: Al momento de iniciar sesion con esta nueva cuenta, debera hacerlo con esta password segura, luego podrá cambiarla.</span>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnAgregarUsuarioCliente" class="btn btn-sm btn-info">Agregar</button>
            </div>
        </div>
    </div>
</div>

<!-- Inicio Alta ips-->
<div class="modal fade" id="alta_ips_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" style="font-family: monospace; font-weight: bold;"> Alta de Ip's <i class="fas fa-globe text-primary"></i> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="ip" class="col-sm-2 col-form-label">IP</label>
                    <div class="col-sm-10">
                        <textarea id="ip" class="form-control form-control-sm" rows="10" placeholder="Ingrese las ip's ..."></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ambiente_ips" class="col-sm-2 col-form-label">Ambiente</label>
                    <div class="col-sm-10">
                        <select id="ambiente_ips" class="form-control form-control-sm">

                        </select>
                    </div>
                    <span style="font-size: .8em; color: red; margin-top:1em; margin-left:1em;">ATENCION: <br> Las ips a ingresar deben tener el formato:<strong> 10.0.0.1</strong><br>Los grupos deben tener el siguiente formato: <strong>10.0.0.1, 10.0.0.2, 10.0.0.3</strong><br>Si no elige un ambiente, se le asignara por defecto el de <strong>Produccion</strong></span>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btnAgregarIpsCliente" type="button" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal Alta ips-->

<!-- Update ips-->
<div class="modal fade" id="update_ips_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" style="font-family: monospace; font-weight: bold;"> Modificar Ip <i class="fas fa-globe text-primary"></i> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="form-group row mx-2 my-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label" style="font-family: monospace;">Ip</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="ip_update" placeholder="Ingrese la ip">
                </div>
                <span style="font-size: 14px; color: red; margin-top:1em; margin-left:1em;">ATENCION: La ip debe tener el siguiente formato <strong> 10.0.0.1</strong></span>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btnUpdateIpsCliente" type="button" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal Update ips-->


<!-- Inicio Alta urls-->
<div class="modal fade" id="alta_urls_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" style="font-family: monospace; font-weight: bold;"> Alta de Urls's <i class="fas fa-globe text-primary"></i> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="url" class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                        <textarea id="url" class="form-control form-control-sm" rows="10" placeholder="Ingrese las Url's ..."></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ambiente_urls" class="col-sm-2 col-form-label">Ambiente</label>
                    <div class="col-sm-10">
                        <select id="ambiente_urls" class="form-control form-control-sm">

                        </select>
                    </div>
                    <span style="font-size: 14px; color: red; margin-top:1em; margin-left:1em;">ATENCION: <br> Las Urls a ingresar deben tener el formato:<strong>http://ejemplo.com</strong><br>Los grupos deben tener el siguiente formato: <strong><br> http://ejemplo1.com, http://ejemplo2.com, http://ejemplo3.com</strong><br>Si no elige un ambiente, se le asignara por defecto el de <strong>Produccion</strong></span>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btnAgregarUrlsCliente" type="button" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal Alta urls-->


<!-- Update urls-->
<div class="modal fade" id="update_urls_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" style="font-family: monospace; font-weight: bold;"> Modificar Url <i class="fas fa-globe text-primary"></i> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="url" class="col-sm-2 col-form-label">Url</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="url_update" placeholder="Ingrese la url">
                    </div>
                    <span style="font-size: 14px; color: red; margin-top:1em; margin-left:1em;">ATENCION: Las url's a ingresar deben tener el formato<strong> http://ejemplo.com</strong></span>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btnAgregarUrlsCliente" type="button" class="btn btn-sm btn-primary">Guardar</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal fin Update urls-->