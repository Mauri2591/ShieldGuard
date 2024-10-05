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
                            <h5 class="card-title"><span class="badge bg-primary border"><span class="text-light"> Unidades de Negocio</span< /span>
                            </h5>

                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" data-placement="top" title="Desplegar Acciones" class="btn btn-tool dropdown-toggle text-primary" data-toggle="dropdown">
                                        <i class="fas fa-wrench text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right bg-primary" role="menu">
                                        <a type="button" onclick="alta_unidad_negocio(<?php echo urldecode(openssl_decrypt($_GET['cliente'], AES, KEY)) ?>)" class="dropdown-item text-primary">Alta de Unidad de Negocio</a>
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
                                                    <table id="table_unidad_negocio" style="justify-content: center; font-size: 13px; width: 100%;">
                                                        <thead style="text-align: center;">
                                                            <tr>
                                                                <th style="width: 40%;">Sector</th>
                                                                <th style="width: 10%;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="text-align: center;">
                                                            <tr>
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
            require_once './Modales_uniNegocio/mdlUniNegocio.php';
            include_once '../../../../../../Template_shieldGuard/js.php';
        } else {
            header("Location:" . URL . "/Home/View/Logout/");
        }
            ?>
            <script>
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1000
                });

                var tabla;
                var cliente_id = <?php echo urldecode(openssl_decrypt($_GET['cliente'], AES, KEY)); ?>

                function alta_unidad_negocio(id) {
                    $("#mdlUniNegocio").modal("show");
                    $("#uninegocio_nombre").val('');
                }

                function edit_estado_uniNegocio(id) {
                    $.post("../../../../../../Controller/ctrUnidadNegocio.php?uni_negocio=get_unidad_negocio", {
                            id: id,
                            cliente_id: cliente_id
                        },
                        function(data, textStatus, jqXHR) {
                            Swal.fire({
                                icon: "question",
                                title: 'Atencion',
                                text: "Desea renombrar esta Unidad de Negocio?",
                                showCancelButton: true,
                                showConfirmButton: true,
                                confirmButtonText: 'Si'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#uninegocio_nombre_editar").val('');
                                    $("#mdlEditarUniNegocio").modal("show");
                                    $("#desabled_uninegocio_nombre_editar").val(data.uninegocio_nombre);
                                    document.getElementById("btnEditarInsertUnidadNegocio").addEventListener("click", function() {
                                        $.post("../../../../../../Controller/ctrUnidadNegocio.php?uni_negocio=update_unidad_negocio_nombre", {
                                                id: id,
                                                cliente_id: cliente_id,
                                                uninegocio_nombre: $("#uninegocio_nombre_editar").val()
                                            },
                                            function(data, textStatus, jqXHR) {

                                            },
                                            "json"
                                        );
                                        $("#mdlEditarUniNegocio").modal("hide");
                                        toastr.success('Unidad de Negocio modificado correctamente.')
                                        $("#table_unidad_negocio").DataTable().ajax.reload();
                                    });
                                }
                            });
                        },
                        "json"
                    );
                }

                $(document).ready(function() {

                    $.post("../../../../../../Controller/ctrCliente.php?op_cliente=get_datos_cliente", {
                            cliente_id: cliente_id
                        },
                        function(data, textStatus, jqXHR) {
                            (data);

                            document.getElementById("nombre_cliente_para_tarea").innerText = data.cliente_nombre
                        },
                        "json"
                    );

                    tabla = $("#table_unidad_negocio").DataTable({
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
                            url: "../../../../../../Controller/ctrUnidadNegocio.php?uni_negocio=get_unidades_negocio",
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
                            uninegocio_nombre: $("#uninegocio_nombre").val()
                        }
                        return registro
                    }

                    function ajax_datos_unidad_negocio(registro) {
                        $.ajax({
                            type: "POST",
                            url: "../../../../../../Controller/ctrUnidadNegocio.php?uni_negocio=insert_unidad_negocio",
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

                    function insert_unidad_negocio() {
                        let data = get_datos_unidad_negocio();
                        ajax_datos_unidad_negocio(data);
                    }

                    document.getElementById("btnInsertUnidadNegocio").addEventListener("click", function() {
                        let data = get_datos_unidad_negocio();
                        if (data.uninegocio_nombre == '') {
                            Swal.fire({
                                icon: "warning",
                                title: "Error",
                                text: "Datos vacios, debe llenar todos los campos!",
                                showConfirmButton: true,
                                showCancelButton: false
                            });
                        } else {
                            try {
                                insert_unidad_negocio()
                                toastr.success('Agregado correctamente.');
                                $("#table_unidad_negocio").DataTable().ajax.reload();
                                $("#mdlUniNegocio").modal("hide");
                            } catch (error) {
                                console.log(error);
                            }
                        }
                    });
                });
            </script>

            </html>