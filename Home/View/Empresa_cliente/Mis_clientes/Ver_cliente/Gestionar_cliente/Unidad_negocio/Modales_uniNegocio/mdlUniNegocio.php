<div class="modal fade" id="mdlUniNegocio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Unidad de Negocio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="uninegocio_nombre" class="form-control form-control-sm" type="text" autofocus placeholder="Ingrese el nombre de la nueva Unidad de Negocio">
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button id="btnInsertUnidadNegocio" type="button" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Editar Unidad de negocio -->
<div class="modal fade" id="mdlEditarUniNegocio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Unidad de Negocio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="desabled_uninegocio_nombre_editar" disabled class="form-control form-control-sm" type="text">
            </div>
            <div class="modal-body">
                <input id="uninegocio_nombre_editar" class="form-control form-control-sm" type="text" autofocus placeholder="Ingrese el nuevo nombre">
            </div>
            <div class="modal-body">
                <span class="text-danger" style="font-size: 0.85em;">Atención: Si renombra esta Unidad de Negocio, todos los registros seran actualizados con el nuevo nombre.</span>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button id="btnEditarInsertUnidadNegocio" type="button" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Editar Unidad de negocio -->