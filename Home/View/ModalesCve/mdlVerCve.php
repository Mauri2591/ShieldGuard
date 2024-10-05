<div class="modal fade" id="mdl_ver_cve_detalle">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <span class="right badge badge-danger">
                    <h6 class="modal-title" id="titulo_cve"></h6>
                    <div id="snipper_mdl_vulns_cve" class="overlay"><i class="fas fa-2x fa-sync-alt text-secondary fa-spin"></i>
                        <!-- <div class="text-bold pt-2">Cargando data...</div> -->
                    </div>
                </span>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="activity">
                                                <!-- Post -->
                                                <div class="post">
                                                    <div class="user-block">
                                                        <span class="right" style="font-weight: bold; font-size: 1.2em;">Descripcion</span>
                                                        <span class="description">Ultima Modificacion: <span id="last_modif_cve" class="description"></span></span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p id="descrip_cve" style="font-size: .9em;">
                                                    </p>
                                                </div>

                                                <p class="right" style="font-weight: bold; font-size: .9em;">Referencias:</p>
                                                <ul id="lista_referencias_cve" class="list-group list-group-unbordered mb-3">
                                                <a id="referencias_cve" href="${elem.url}" target="_blank" rel="noopener noreferrer"></a>
                                                </ul>
                                                <!-- /.tab-content -->
                                            </div><!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div><!-- /.container-fluid -->
                </section>
            </div>
            <div class="modal-footer justify-content-end bg-light">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->