<?php
require_once '../../../../../../Config/Conexion.php';
if (isset($_SESSION['usuario_empresa_id']) && !empty($_SESSION['usuario_empresa_id'])) {
    include_once '../../../../../Template_shieldGuard/head.php';
?>

    <link rel="stylesheet" href="<?php echo URL; ?>/Template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/Template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/Template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.10em 0;
            font-size: 0.75em;
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
            <?php if (isset($_SESSION['empresa_id'])) { ?>
                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #203b99">
                    <div class="sidebar" style="background-color: #203b99">
                        <nav class="mt-5">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>
                                            Empresas
                                            <i class="right fa fa-users text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_usuario/Mi_empresa/" class="nav-link">
                                                <p>Mi Empresa</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <?php if ($_SESSION['root_id'] === 1) : ?>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="<?php echo URL; ?>/Home/View/Empresa_usuario/Mis_empresas_clientes/" class="nav-link">
                                                    <p>Mis Partners</p>
                                                </a>
                                            </li>
                                        </ul>
                                    <?php endif; ?>
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
                            </ul>
                            </li>
                            </ul>
                        </nav>
                    </div>
                </aside>

                <div class="content-wrapper">
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h5 id="nombre_partner" style="font-family: monospace; color:#2d438b;"></h5>
                                </div>
                            </div>

                            <?php if ($_SESSION['rol_id'] === 1) : ?>
                                <button id="btn_alta_usuario" type="button" class="btn btn-secondary btn-xs">Nuevo Usuario +</button>
                                <button id="btn_ver_logs_actividad_usuarios_partners" type="button" data-toggle="tooltip" data-placement="top" title="Ver Actividades" class="btn btn-secondary btn-xs"><i class="fas fa-eye"></i></button>
                            <?php else : ?>
                            <?php endif; ?>

                        </div>
                    </section>
                    <section class="content">
                        <div class="card">
                            <div class="card-header bg-secondary py-3">
                            </div>
                            <div class="container p-2 bg-light">
                                <div class="container-fluid border p-2">
                                    <table id="table_consultar_usuarios_partners">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th style="width: 700px;">Email</th>
                                                <th style="width: 200px;">Rol</th>
                                                <th style="width: 200px;">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                            <tr>
                                                <td style="width: 300px;"></td>
                                                <td style="width: 300px;"></td>
                                                <td style="width: 300px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php
                require_once '../../../../Empresa_usuario/Mi_empresa/Mis_usuarios/Modal_nuevo_usuario/mdlNuevoUsuario.php';
                require_once  '../../../../Empresa_usuario/Mi_empresa/Mis_usuarios/Modal_nuevo_usuario/mdlInfoDelUsuario.php';
                require_once  '../../../../Empresa_usuario/Mi_empresa/Mis_usuarios/Modal_nuevo_usuario/mdlReset_Password_Usuario_empresa.php';
                require_once '../Modal_nuevo_partner/MdlLogsPartners/mdlLogsEventosUsuariosPartners.php';
                ?>
            <?php } else { ?>
                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #203b99">
                    <div class="sidebar" style="background-color: #203b99">
                        <nav class="mt-5">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p style="font-family: monospace;">
                                            Empresas
                                            <i class="right fa fa-users text-light"></i>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p style="font-family:monospace">
                                            Clientes
                                            <i class="fa fa-user-circle right text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <a href="<?php echo URL; ?>/Home/View/Empresa_cliente/Mis_clientes/" class="nav-link">
                                            <p>Mis Clientes</p>
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
        <?php }
            include '../../../../../Template_shieldGuard/js.php';
        } else {
            header("Location:" . URL . "/Home/View/Logout/");
        }
        ?>

        <script src="<?php echo URL; ?>/Template/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/jszip/jszip.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo URL; ?>/Template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


        <script>
            var url = "http://127.0.0.1/shieldguard";
            var valor_empresa_id_openssl_decode = <?php echo urldecode(openssl_decrypt($_GET['empresa_id'], AES, KEY)); ?>

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1200
            });

            $(document).ready(function() {
            console.log(valor_empresa_id_openssl_decode);

                $.post("../../../../../Controller/ctrEmpresa.php?empre=get_datos_empresa", {
                        empresa_id: valor_empresa_id_openssl_decode
                    },
                    function(data, textStatus, jqXHR) {
                        console.log(data);
                        document.getElementById("nombre_partner").innerText = "Usuarios Partner - " + data.empresa_nombre;
                    },
                    "json"
                );

                tabla = $("#table_consultar_usuarios_partners").DataTable({
                    "aProcessing": true,
                    "aServerSide": true,
                    dom: 'Bfrtip',
                    "searching": true,
                    lenghtChange: false,
                    colReorder: true,
                    buttons: [{
                            extend: 'copyHtml5',
                            className: 'btn btn-secondary btn-xs'
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-secondary btn-xs'
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'btn btn-secondary btn-xs'
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-secondary btn-xs'
                        }
                    ],
                    "ajax": {
                        url: "../../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=get_consultar_usuarios_partner",
                        type: "post",
                        dataType: "json",
                        data: {
                            empresa_id: valor_empresa_id_openssl_decode
                        },
                        error: function(e) {
                            console.log(e.responseText);
                        }
                    },
                    "order": [
                        [0, "desc"]
                    ], //Ordenar descendentemente
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
                            "sLast": "Ultimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ":Activar para ordenar la columna de manera ascendiente",
                            "sSortDescending": ":Activar para ordenar la columna de manera descendiente"
                        }
                    }
                });
            });

            function generateSecureKey(length = 32) {
                const characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{}|;:,.<>?';
                const charactersLength = characters.length;
                let secureKey = '';

                for (let i = 0; i < length; i++) {
                    const randomIndex = crypto.getRandomValues(new Uint32Array(1))[0] % charactersLength;
                    secureKey += characters[randomIndex];
                }
                return secureKey;
            }

            document.getElementById("btn_alta_usuario").addEventListener("click", function() {
                $("#password_usuario_empresa").val('');
                $("#email_usuario_empresa").val('');
                $("#mdlAltaUsuario").modal("show");

                const claveSegura = generateSecureKey();
                $("#password_usuario_empresa").val(claveSegura);

                $.post("../../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=get_rol_para_usuario",
                    function(data, textStatus, jqXHR) {
                        console.log(data);
                        document.getElementById("rol_id").innerHTML = data;
                    }
                );
            });

            function agregar_usuario_empresa() {

                function datos() {
                    let registro = {
                        rol_id: $("#rol_id").val(),
                        empresa_id: valor_empresa_id_openssl_decode,
                        email_usuario_empresa: $("#email_usuario_empresa").val(),
                        password_usuario_empresa: $("#password_usuario_empresa").val()
                    }
                    return registro;
                }

                function ajax_agregar_usuario_empresa() {
                    $.ajax({
                        type: "POST",
                        url: "../../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=crear_usuario_partner",
                        data: registro,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }

                let registro = datos();
                if (registro.email_usuario_empresa == '') {
                    Swal.fire({
                        icon: "warning",
                        title: "Error",
                        text: "Debe completar los campos!",
                        showConfirmButton: true,
                        showCancelButton: true
                    })
                } else {
                    ajax_agregar_usuario_empresa(registro);
                    $("#mdlAltaUsuario").modal("hide");
                    $("#table_consultar_usuarios_partners").DataTable().ajax.reload();
                    $("#tableLogsEventosUsuarios").DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: 'Usuario agregado correctamente!'
                    });
                }
            }

            document.getElementById("btnAgregarUsuarioEmpresa").addEventListener("click", function() {
                agregar_usuario_empresa();
                $("#tableLogsEventosUsuariosPartners").DataTable().ajax.reload();
            });

            document.getElementById("btn_ver_logs_actividad_usuarios_partners").addEventListener("click", function() {
                $("#mdlLogsEventosUsuariosPartners").modal("show");
            });

            tabla = $("#tableLogsEventosUsuariosPartners").DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                "searching": true,
                lenghtChange: false,
                colReorder: true,
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-light btn-xs'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-light btn-xs'
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'btn btn-light btn-xs'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-light btn-xs'
                    }
                ],
                "ajax": {
                    url: "../../../../../Controller/ctrEmpresa.php?empre=logs_usuarios_empresas_partners",
                    type: "post",
                    dataType: "json",
                    data: {
                        empresa_id: valor_empresa_id_openssl_decode
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                },
                "order": [
                    [0, "desc"]
                ], //Ordenar descendentemente
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
        </script>