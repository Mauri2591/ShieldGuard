<div class="modal fade" id="mdlAltaUsuario">
    <div class="modal-dialog">
        <div class="modal-content border-dark">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" style="font-family: monospace; font-weight: bold;"> Dar de Alta Usuario <i class="fas fa-user text-info"> +</i> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="font-family: monospace;">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-sm" id="email_usuario_empresa" placeholder="Ingrese el correo del Usuario">
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
                        <input type="text" class="form-control form-control-sm" readonly id="password_usuario_empresa">
                    </div>
                </div>
                <span style="font-size: 14px; color: red;">ATENCION: Al momento de iniciar sesion con esta nueva cuenta, debera hacerlo con esta password segura, luego podrá cambiarla.</span>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnAgregarUsuarioEmpresa" class="btn btn-sm btn-info">Agregar</button>
            </div>
        </div>
    </div>
</div>