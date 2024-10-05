<div class="modal fade" id="mdlNuevoCliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style=" text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);">Nuevo Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body py-0">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del Cliente</label>
                        <input id="cliente_nombre" class="form-control form-control-sm" type="text" placeholder="Ingrese el nombre del Cliente">
                    </div>
                    <div class="form-group mt-1">
                        <label for="exampleInputEmail1">Razon Social</label>
                        <input id="cliente_razon_social" class="form-control form-control-sm" type="text" placeholder="Ingrese la razon social del Cliente">
                    </div>
                    <div class="form-group pl-0 pt-2">
                        <div class="d-flex pl-0">
                            <label class="col-2 pl-0">Tipo</label>
                            <select id="id_tipo_cliente" class="form-control col-3 form-control-sm">

                            </select>
                            <input id="cliente_cuil_cuit" class="form-control form-control-sm col-7 ml-2" type="text">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btn_insertar_cliente" type="button" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->