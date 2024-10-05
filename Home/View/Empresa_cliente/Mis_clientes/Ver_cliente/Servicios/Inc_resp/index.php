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
                    <?php include_once '../../../../../../Template_shieldGuard/titulo.php';?>   
                </section>

                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header bg-light border-secondary">
                            <h5 class="card-title">Incident Response</h5>

                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" data-placement="top" title="Desplegar Acciones" class="btn btn-tool dropdown-toggle text-primary" data-toggle="dropdown">
                                        <i class="fas fa-wrench text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right bg-primary" role="menu">
                                        <a type="button" onclick="alta_servicio_ir(<?php echo urldecode(openssl_decrypt($_GET['cliente'], AES, KEY)) ?>)" class="dropdown-item text-primary">Alta de Servicio IR</a>
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

                function alta_servicio_ir() {
                    alert("IR")
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

                });
            </script>

            </html>