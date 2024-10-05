<div class="modal fade" id="mdlSector">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Sector</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group row">
                    <label for="inputEmail3" style="font-weight: 400; font-size: .8em;" class="col-sm-12 col-form-label text-danger">Unidad de Negocio </label>
                    <div class="col-sm-12">
                      <select id="select_sector" class="form-control form-control-sm">

                    </select>
                    </div>
                  </div>
                <input id="sector_nombre" class="form-control form-control-sm" type="text" autofocus placeholder="Ingrese el nuevo Sector">
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button id="btnInsertSector" type="button" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Update -->
<div class="modal fade" id="mdlEditarSector">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Sector</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group row">
                    <label for="inputEmail3" style="font-weight: 400; font-size: .8em;" class="col-sm-12 col-form-label text-danger">Cambiar Unidad de Negocio </label>
                    <div class="col-sm-12">
                      <select id="select_sector_update" class="form-control form-control-sm">

                    </select>
                    </div>
                  </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button id="btnUpdateSector" type="button" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
 <!-- Update -->
