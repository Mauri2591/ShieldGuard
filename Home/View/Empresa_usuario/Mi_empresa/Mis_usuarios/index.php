<?php
require_once '../../../../../Config/Conexion.php';
if (isset($_SESSION['usuario_empresa_id']) && !empty($_SESSION['usuario_empresa_id'])) {
    include_once '../../../../Template_shieldGuard/head.php';
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
                                    <h5 style="font-family: monospace; color:#2d438b; font-weight:bold">Mis Usuarios</h5>
                                </div>
                            </div>

                            <?php if ($_SESSION['rol_id'] === 1) : ?>
                                <button id="btn_alta_usuario" type="button" class="btn btn-secondary btn-xs">Nuevo Usuario +</button>
                                <button id="btn_ver_logs_actividad_usuario" type="button" data-toggle="tooltip" data-placement="top" title="Ver Actividades" class="btn btn-secondary btn-xs"><i class="fas fa-eye"></i></button>
                            <?php endif; ?>

                        </div>
                    </section>
                    <section class="content">
                        <div class="card">
                            <div class="card-header bg-secondary py-3">
                            </div>
                            <div class="container p-2 bg-light">
                                <div class="container-fluid border p-2">
                                    <table id="table_consultar_usuarios_mi_empresa">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th style="width: 300px;">Email</th>
                                                <th style="width: 300px;">Rol</th>
                                                <th style="width: 300px;">Fecha de Alta</th>
                                                <th style="width: 300px;">Estado</th>
                                                <th style="width: 200px;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                            <tr>
                                                <td style="width: 300px;"></td>
                                                <td style="width: 300px;"></td>
                                                <td style="width: 300px;"></td>
                                                <td style="width: 300px;"></td>
                                                <td style="width: 200px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php
                require_once './Modal_nuevo_usuario/mdlNuevoUsuario.php';
                require_once './Modal_nuevo_usuario/mdlInfoDelUsuario.php';
                require_once './Modal_nuevo_usuario/mdlReset_Password_Usuario_empresa.php';
                require_once './Modal_nuevo_usuario/MdlLogsUsuarios/mdlLogsEventosUsuarios.php';
                ?>
            <?php } else { ?>
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
        <?php }
            include '../../../../Template_shieldGuard/js.php';
        } else {
            header("Location:" . URL . "/Home/View/Logout/");
        }
        ?>
        <script src="mis_usuarios.js"></script>
        <script src="./Modal_nuevo_usuario/MdlLogsUsuarios/mdlLogsEventosUsuarios.js"></script>

        </html>