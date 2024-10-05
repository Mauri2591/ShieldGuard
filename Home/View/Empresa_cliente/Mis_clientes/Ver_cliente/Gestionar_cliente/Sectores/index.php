<?php
require_once '../../../../../../../Config/Conexion.php';
if (isset($_SESSION['usuario_empresa_id']) && !empty($_SESSION['usuario_empresa_id'])) {
    include_once '../../../../../../Template_shieldGuard/head.php';
?>
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.10em 0;
            font-size: 0.75em;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_empty,
        .dataTables_wrapper .dataTables_loading {
            font-size: .8em;
            text-align: center;
            /* Cambia este valor según tus necesidades */
        }
    </style>

    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #3c539f;">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-light"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?php echo URL; ?>/Home/View/" class="nav-link text-light">Inicio</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto" style="align-items: center;">

                    <li class="nav-item dropdown">
                        <marquee behavior="" direction=""><span class="badge text-light" style="font-family: monospace;"><?php echo $_SESSION['email_usuario_empresa'] ?></span></marquee>
                    </li>
                    <li class="nav-item text-light">
                        <a class="nav-link text-light" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown text-light">
                        <a class="nav-link text-light" data-toggle="dropdown" href="#">
                            <i class="fas fa-th-large"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo URL; ?>/Home/View/Empresa_usuario/Perfil" class="dropdown-item">
                                <i class="fas fa-user mr-2" style="color:#2d438b;"></i>Perfil
                                <span class="float-right text-muted text-sm"><!-- aqui agregar hora si se requiere --></span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo URL; ?>/Home/View/Logout/" class="dropdown-item">
                                <i class="fas fa-sign-out-alt mr-2" style="color:#2d438b;"></i> Salir
                                <span class="float-right text-muted text-sm"><!-- aqui agregar hora si se requiere --></span>
                            </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            <?php if ($_SESSION['root_id'] === 1) { ?>
                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #203b99">
                    <div class="sidebar" style="background-color: #203b99">
                        <nav class="mt-5">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>
                                            Company
                                            <i class="right fa fa-users text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_usuario/Mi_empresa/" class="nav-link">
                                                <p>Mi Empresa</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_usuario/Mis_Empresas_clientes/" class="nav-link">
                                                <p>Mis Partners</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>
                                            Clientes
                                            <i class="fa fa-user-circle right text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_cliente/Mis_clientes/" class="nav-link">
                                                <p>Mis Clientes</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>
                                            Gestionar Cliente
                                            <i class="fas fa fa-cog right fas fa-angle-left text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Unidad_negocio/?cliente=" . urlencode($_GET['cliente']);  ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Unidades de Negocio</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Sectores/?cliente=" . urlencode($_GET['cliente']);  ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Sectores</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Activos/?cliente=" . urlencode($_GET['cliente']);  ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Activos</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>
                                            Servicios
                                            <i class="fas fa-plus-square right fas fa-angle-left text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Gestion_vuln/?cliente=" . urlencode($_GET['cliente']); ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Gest. de Vulnerabilidades</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Inc_resp/?cliente=" . urlencode($_GET['cliente']); ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Incident Response</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Soc_lite/?cliente=" . urlencode($_GET['cliente']); ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Soc Lite</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
            <?php } else { ?>
                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #203b99">
                    <div class="sidebar" style="background-color: #203b99">
                        <nav class="mt-5">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>
                                            Company
                                            <i class="right fa fa-users text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_usuario/Mi_empresa/" class="nav-link">
                                                <p>Mi Empresa</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_usuario/Mis_Empresas_clientes/" class="nav-link">
                                                <p>Mis Partners</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>
                                            Clientes
                                            <i class="fa fa-user-circle right text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_cliente/Mis_clientes/" class="nav-link">
                                                <p>Mis Clientes</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>
                                            Gestionar Cliente
                                            <i class="fas fa fa-cog right fas fa-angle-left text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Unidad_negocio/?cliente=" . urlencode($_GET['cliente']);  ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Unidades de Negocio</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Sectores/?cliente=" . urlencode($_GET['cliente']);  ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Sectores</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Activos/?cliente=" . urlencode($_GET['cliente']);  ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Activos</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>
                                            Servicios
                                            <i class="fas fa-plus-square right fas fa-angle-left text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Gestion_vuln/?cliente=" . urlencode($_GET['cliente']); ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Gest. de Vulnerabilidades</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Inc_resp/?cliente=" . urlencode($_GET['cliente']); ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Incident Response</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Soc_lite/?cliente=" . urlencode($_GET['cliente']); ?>" class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Soc Lite</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
            <?php } ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">

                                <section class="content-header">
                                    <?php include_once '../../../../../../Template_shieldGuard/titulo.php'; ?>
                                </section>

                            </div>
                        </div>
                    </div>
                </section>
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header bg-light border-secondary">
                            <h5 class="card-title"><span class="badge bg-primary border"><span class="text-light">Sectores</span< /span>
                            </h5>

                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" data-placement="top" title="Desplegar Acciones" class="btn btn-tool dropdown-toggle text-primary" data-toggle="dropdown">
                                        <i class="fas fa-wrench text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right bg-primary" role="menu">
                                        <a type="button" onclick="alta_sector(<?php echo urldecode(openssl_decrypt($_GET['cliente'], AES, KEY)) ?>)" class="dropdown-item text-primary">Alta de Sector</a>
                                    </div>
                                </div>
                                <button type="button" data-toggle="tooltip" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="card card-primary card-tabs">
                                        <div class="card-header p-0 pt-1">
                                            <ul class="nav nav-tabs" style="height: 1.9em;" id="custom-tabs-one-tab" role="tablist">
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="activos_cliente_nav_cuentas_cliente" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                    <table id="table_sectores" style="justify-content: center; font-size: 13px; width: 100%;">
                                                        <thead style="text-align: center;">
                                                            <tr>
                                                                <th style="width: 30%;">Sector</th>
                                                                <th style="width: 30%;">Unidad de Negocio</th>
                                                                <th style="width: 10%;">Estado</th>
                                                                <th style="width: 10%;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="text-align: center;">
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            <?php
            require_once './Modales_sectores/mdlSector.php';
            include_once '../../../../../../Template_shieldGuard/js.php';
        } else {
            header("Location:" . URL . "/Home/View/Logout/");
        }
            ?>

            <script>
                var url = "http://127.0.0.1/shieldguard";
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1000
                });
                var tabla;
                var cliente_id = <?php echo urldecode(openssl_decrypt($_GET['cliente'], AES, KEY)); ?>

                function alta_sector(id) {
                    $.post("../../../../../../Controller/ctrUnidadNegocio.php?uni_negocio=select_get_unidades_negocio", {
                            cliente_id: cliente_id
                        },
                        function(data, textStatus, jqXHR) {
                            document.getElementById("select_sector").innerHTML = data
                            if (data == '') {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Error",
                                    text: "No posee ninguna Unidad de Negocio, debe crear al menos una!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Ir a Unidad de Negocio",
                                    showCancelButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = url + "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Unidad_negocio/?cliente=" + "<?php echo urlencode($_GET['cliente']); ?>";
                                    }
                                })
                            } else {
                                $("#mdlSector").modal("show");
                                $("#sector_nombre").val('');
                            }
                        },
                        "html"
                    );
                }

                function edit_estado_sector(id) {
                    $.post("../../../../../../Controller/ctrSector.php?sector=get_sector", {
                            id: id,
                            cliente_id: cliente_id
                        },
                        function(data, textStatus, jqXHR) {
                            if (data.est == 1) {
                                Swal.fire({
                                    icon: "question",
                                    title: "¿Desea cambiar el estado del sector?",
                                    text: "El sector se encuentra activo, ¿desea Inhabilitarlo?",
                                    showCancelButton: true,
                                    showConfirmButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.post("../../../../../../Controller/ctrSector.php?sector=update_sector", {
                                                est: 0,
                                                id: id
                                            },
                                            function(data, textStatus, jqXHR) {
                                                toastr.success('Sector Inhabilitado correctamente.')
                                                $("#table_sectores").DataTable().ajax.reload();
                                            },
                                            "json"
                                        );
                                    }
                                })
                            } else {
                                Swal.fire({
                                    icon: "question",
                                    title: "¿Desea cambiar el estado del sector?",
                                    text: "El sector se encuentra inactivo, ¿desea Habilitarlo?",
                                    showCancelButton: true,
                                    showConfirmButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.post("../../../../../../Controller/ctrSector.php?sector=update_sector", {
                                                est: 1,
                                                id: id
                                            },
                                            function(data, textStatus, jqXHR) {
                                                toastr.success('Sector Habilitado correctamente.')
                                                $("#table_sectores").DataTable().ajax.reload();
                                            },
                                            "json"
                                        );
                                    }
                                })
                            }
                        },
                        "json"
                    );
                }

                function edit_uniNegocio_sector(id) {
                    $.post("../../../../../../Controller/ctrUnidadNegocio.php?uni_negocio=select_get_unidades_negocio", {
                            cliente_id: cliente_id
                        },
                        function(data, textStatus, jqXHR) {
                            document.getElementById("select_sector_update").innerHTML = data;
                        },
                        "html"
                    );
                    $("#mdlEditarSector").modal("show");

                    document.getElementById("btnUpdateSector").addEventListener("click", function() {
                        Swal.fire({
                            icon: "question",
                            title: "Atencion",
                            text: "Desea modificar la unidad de negocio de este sector?",
                            showConfirmButton: true,
                            showCancelButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.post("../../../../../../Controller/ctrUnidadNegocio.php?uni_negocio=update_unidad_negocio_sector", {
                                        uninegocio_id: $("#select_sector_update").val(),
                                        cliente_id: cliente_id
                                    },
                                    function(data, textStatus, jqXHR) {},
                                    "json"
                                );
                                toastr.success('Sector modificado correctamente.')
                                $("#mdlEditarSector").modal("hide");
                                $("#table_sectores").DataTable().ajax.reload();
                            }
                        })
                    })
                }

                $(document).ready(function() {
                    $.post("../../../../../../Controller/ctrCliente.php?op_cliente=get_datos_cliente", {
                            cliente_id: cliente_id
                        },
                        function(data, textStatus, jqXHR) {
                            document.getElementById("nombre_cliente_para_tarea").innerText = data.cliente_nombre
                        },
                        "json"
                    );


                    tabla = $("#table_sectores").DataTable({
                        "aProcessing": true,
                        "aServerSide": true,
                        dom: 'Bfrtip',
                        "searching": true,
                        lenghtChange: false,
                        colReorder: true,
                        buttons: [ //Edito los botones
                            // {
                            //     extend: 'copyHtml5',
                            //     className: 'btn btn-light btn-xs'
                            // },
                            // {
                            //     extend: 'excelHtml5',
                            //     className: 'btn btn-light btn-xs'
                            // },
                            // {
                            //     extend: 'csvHtml5',
                            //     className: 'btn btn-light btn-xs'
                            // },
                            // {
                            //     extend: 'pdfHtml5',
                            //     className: 'btn btn-light btn-xs'
                            // }
                        ],
                        "ajax": {
                            url: "../../../../../../Controller/ctrSector.php?sector=get_sectores",
                            type: "post",
                            dataType: "json",
                            data: {
                                cliente_id: cliente_id
                            },
                            error: function(e) {
                                // console.log(e.responseText);
                            },
                            // success: function(data) {
                            //     if (data) {
                            //         document.getElementById("snipper_table_vulns_cve").style.display = "none";
                            //     } else {
                            //         document.getElementById("snipper_table_vulns_cve").style.display = "flex";
                            //     }
                            //     // Asigno los datos recibidos a la tabla DataTable
                            //     tabla.clear().rows.add(data.aaData).draw();
                            // }
                        },
                        "order": [
                            [0, "desc"]
                        ],
                        "bDestroy": true,
                        "responsive": true,
                        "bInfo": true,
                        "iDisplayLength": 10, //cantidad de tuplas o filas a mostrar
                        "autoWith": false,
                        "language": {
                            "sProcessing": "Procesando..",
                            "sLengthMenu": "Mostrar _MENU_ registros",
                            "sZeroRecords": "No se encontraron resultados..",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sInfo": "Mostrando un total de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando un total de 0 registros",
                            "sInfoFiltered": "(Filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar: ",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Ùltimo",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ":Activar para ordenar la columna de manera ascendiente",
                                "sSortDescending": ":Activar para ordenar la columna de manera descendiente"
                            }
                        }
                    });

                    function get_datos_unidad_negocio() {
                        let registro = {
                            cliente_id: cliente_id,
                            uninegocio_id: $("#select_sector").val(),
                            sector_nombre: $("#sector_nombre").val()
                        }
                        return registro
                    }

                    function ajax_datos_sector(registro) {
                        $.ajax({
                            type: "POST",
                            url: "../../../../../../Controller/ctrSector.php?sector=insert_sector",
                            data: registro,
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }

                    function insert_sector() {
                        let data = get_datos_unidad_negocio();
                        if (data.sector_nombre == '') {
                            Swal.fire({
                                icon: "warning",
                                title: "Error",
                                text: "Datos vacios, debe llenar todos los campos!",
                                showConfirmButton: true,
                                showCancelButton: false
                            });
                        } else {
                            ajax_datos_sector(data);
                            toastr.success('Sector agregado correctamente.')
                            $("#table_sectores").DataTable().ajax.reload();
                        }
                    }

                    document.getElementById("btnInsertSector").addEventListener("click", function() {
                        let data = get_datos_unidad_negocio();
                        if ($("#select_sector").val() == '') {
                            Swal.fire({
                                icon: "warning",
                                title: "Error",
                                text: "Debe crear una unidad de Negocio por lo menos!",
                                showConfirmButton: true,
                                showCancelButton: false
                            });
                        } else if (data.sector_nombre == '') {
                            Swal.fire({
                                icon: "warning",
                                title: "Error",
                                text: "Debe crear una unidad de Negocio por lo menos!",
                                showConfirmButton: true,
                                showCancelButton: false
                            });
                        } else {
                            try {
                                insert_sector()
                                $("#table_sectores").DataTable().ajax.reload();
                                toastr.success('Agregado correctamente.')
                                $("#mdlSector").modal("hide");
                            } catch (error) {
                                console.log(error);
                            }
                        }
                    });
                });
            </script>

            </html>