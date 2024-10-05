<?php
require_once '../../../../../../../Config/Conexion.php';
if (isset($_SESSION['usuario_empresa_id']) && !empty($_SESSION['usuario_empresa_id'])) {
    include_once '../../../../../../Template_shieldGuard/head.php';
    date_default_timezone_set("America/Argentina/Buenos_Aires");
?>
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.10em 0;
            font-size: 0.75em;
        }

        .btn.moveall.btn-outline-secondary,
        .btn.move.btn-outline-secondary,
        .btn.remove.btn-outline-secondary,
        .btn.removeall.btn-outline-secondary {
            padding: 0;
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
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars text-light"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?php echo URL; ?>/Home/View/" class="nav-link text-light">Inicio</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto" style="align-items: center;">

                    <li class="nav-item dropdown">
                        <marquee behavior="" direction=""><span class="badge text-light"
                                style="font-family: monospace;"><?php echo $_SESSION['email_usuario_empresa'] ?></span>
                        </marquee>
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
                                <span class="float-right text-muted text-sm">
                                    <!-- aqui agregar hora si se requiere -->
                                </span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo URL; ?>/Home/View/Logout/" class="dropdown-item">
                                <i class="fas fa-sign-out-alt mr-2" style="color:#2d438b;"></i> Salir
                                <span class="float-right text-muted text-sm">
                                    <!-- aqui agregar hora si se requiere -->
                                </span>
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
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
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
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_usuario/Mis_Empresas_clientes/"
                                                class="nav-link">
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
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_cliente/Mis_clientes/"
                                                class="nav-link">
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
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Unidad_negocio/?cliente=" . urlencode($_GET['cliente']);  ?>"
                                                class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Unidades de Negocio</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Sectores/?cliente=" . urlencode($_GET['cliente']);  ?>"
                                                class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Sectores</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Activos/?cliente=" . urlencode($_GET['cliente']);  ?>"
                                                class="nav-link">
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
                                            <i class="far fa-plus-square right fas fa-angle-left text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Gestion_vuln/?cliente=" . urlencode($_GET['cliente']); ?>"
                                                class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Gest. de Vulnerabilidades</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Inc_resp/?cliente=" . urlencode($_GET['cliente']); ?>"
                                                class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Incident Response</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Soc_lite/?cliente=" . urlencode($_GET['cliente']); ?>"
                                                class="nav-link">
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
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
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
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_usuario/Mis_Empresas_clientes/"
                                                class="nav-link">
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
                                            <a href="<?php echo URL; ?>/Home/View/Empresa_cliente/Mis_clientes/"
                                                class="nav-link">
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
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Unidad_negocio/?cliente=" . urlencode($_GET['cliente']);  ?>"
                                                class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Unidades de Negocio</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Sectores/?cliente=" . urlencode($_GET['cliente']);  ?>"
                                                class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Sectores</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Gestionar_cliente/Activos/?cliente=" . urlencode($_GET['cliente']);  ?>"
                                                class="nav-link">
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
                                            <i class="fas fa fa-plus-square right fas fa-angle-left text-light"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Gestion_vuln/?cliente=" . urlencode($_GET['cliente']); ?>"
                                                class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Gest. de Vulnerabilidades</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Inc_resp/?cliente=" . urlencode($_GET['cliente']); ?>"
                                                class="nav-link">
                                                <i style="font-size: .7em;" class="far fa-circle nav-icon"></i>
                                                <p>Incident Response</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo URL . "/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/Servicios/Soc_lite/?cliente=" . urlencode($_GET['cliente']); ?>"
                                                class="nav-link">
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
                            <h5 class="card-title">Gestion de Vulnerabilidades</h5>

                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" data-placement="top" title="Desplegar Acciones"
                                        class="btn btn-tool dropdown-toggle text-primary" data-toggle="dropdown">
                                        <i class="fas fa-wrench text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right bg-primary" role="menu">
                                        <a type="button"
                                            onclick="nuevo_gestion_vuln(<?php echo urldecode(openssl_decrypt($_GET['cliente'], AES, KEY)) ?>,'Escaneo')"
                                            class="dropdown-item text-primary">Escaneo</a>
                                        <a type="button"
                                            onclick="nuevo_gestion_vuln_discovery(<?php echo urldecode(openssl_decrypt($_GET['cliente'], AES, KEY)) ?>,'Discovery')"
                                            class="dropdown-item text-primary">Solo Discovery</a>
                                        <a type="button"
                                            onclick="rechequeo_gestion_vuln(<?php echo urldecode(openssl_decrypt($_GET['cliente'], AES, KEY)) ?>)"
                                            class="dropdown-item text-primary">Rechequeo</a>
                                    </div>
                                </div>
                                <button type="button" data-toggle="tooltip" class="btn btn-tool"
                                    data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <table id="table_get_escaneo_nombre" style="font-size: .9em; text-align: center;">
                                        <thead>
                                            <tr class="text-center">
                                                <th style="width: 10%;">Tipo</th>
                                                <th style="width: 35%;">Titulo</th>
                                                <th style="width: 10%;">Usuario</th>
                                                <th style="width: 10%;">Fecha</th>
                                                <th style="width: 10%;">Assets</th>
                                                <th style="width: 5%;">Consultar</th>
                                                <th style="width: 10%;">Estado</th>
                                                <th style="width: 10%;">Accion</th>
                                                <th style="width: 10%;">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
            require_once './Modales_gestionVuln/mdlGestionarEscaneo.php';
            require_once './Modales_gestionVuln/mdlDetalleAssets.php';
            require_once './Modales_gestionVuln/mdlDetalleEscaneo.php';
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

                function nuevo_gestion_vuln(id, tipo) {
                    document.getElementById("tipo_gestion").value = tipo
                    document.getElementById("titulo_tipo_gestion").innerText = tipo
                    document.getElementById("escaneo_titulo").value = ""

                    $("#mdlGestionaEscaneoNombre").modal("show")
                }

                function nuevo_gestion_vuln_discovery(id, tipo) {
                    document.getElementById("tipo_gestion").value = tipo
                    document.getElementById("titulo_tipo_gestion").innerText = tipo
                    document.getElementById("escaneo_titulo").value = ""
                    $("#mdlGestionaEscaneoNombre").modal("show")
                }

                function rechequeo_gestion_vuln() {
                    alert("Rechequeo gestion vuln")
                }

                $.post("../../../../../../Controller/ctrProyectosCliente.php?proy=get_ips_x_cliente", {
                        cliente_id: cliente_id
                    },
                    function(data, textStatus, jqXHR) {
                        document.getElementById("mover_ips_lanzar_escaneos").innerHTML = data;
                        $('#mover_ips_lanzar_escaneos').bootstrapDualListbox({
                            nonSelectedListLabel: 'IPs Disponibles',
                            selectedListLabel: 'IPs Seleccionadas',
                            preserveSelectionOnMove: 'movido',
                            moveOnSelect: false
                        });
                    },
                    "html"
                );

                $.post("../../../../../../Controller/ctrProyectosCliente.php?proy=get_urls_x_cliente", {
                        cliente_id: cliente_id
                    },
                    function(data, textStatus, jqXHR) {
                        document.getElementById("mover_urls_lanzar_escaneos").innerHTML = data;
                        $('#mover_urls_lanzar_escaneos').bootstrapDualListbox({
                            nonSelectedListLabel: 'URLs Disponibles',
                            selectedListLabel: 'URLs Seleccionadas',
                            preserveSelectionOnMove: 'movido',
                            moveOnSelect: false
                        });
                    },
                    "html"
                );

                /********************* Inicio escaneo ******************* */

                function verDetalleEscaneo(id) {
                    $("#mdlDetalleEscaneo").modal("show");
                    $.post("../../../../../../Controller/ctrEscaneo.php?escan=get_historial_escaneo_nombre", {
                            escaneo_id: id
                        },
                        function(data, textStatus, jqXHR) {
                            document.getElementById("timeline_detalle_escaneo").innerHTML = data;
                        },
                        "html"
                    );
                }

                function get_data_escaneo() {
                    // Obtener el título del escaneo
                    let escaneo_titulo = document.getElementById("escaneo_titulo").value;
                    let tipo_gestion = document.getElementById("tipo_gestion").value;
                    let fecha = document.getElementById("fecha_escaneo").value;
                    let hora = document.getElementById("hora_escaneo").value;
                    let escaneo_fecha = fecha + " " + hora;

                    // Crear el objeto de datos con ips y urls seleccionados
                    let data = {
                        cliente_id: cliente_id, // Asegúrate de que 'cliente_id' está definido en el ámbito adecuado
                        escaneo_titulo: escaneo_titulo,
                        tipo_gestion: tipo_gestion,
                        escaneo_fecha: escaneo_fecha
                    };
                    return data;
                }

                function agregar_activos_ips_urls(id) {
                    // Mostrar el modal
                    $("#mdlGestionarAssetsIpsUrls").modal("show");
                    // Eliminar cualquier event listener previo antes de agregar uno nuevo
                    $("#btn_agregar_assets_ips_urls").off("click").on("click", function() {
                        let data_ip = get_data_ips_escaneo(id);
                        let data_urls = get_data_urls_escaneo(id);

                        // Verifica si al menos una IP o una URL ha sido seleccionada
                        if (data_ip.ips_id.length === 0 && data_urls.urls_id.length === 0) {
                            Swal.fire({
                                icon: "warning",
                                title: "Error",
                                text: "Datos vacíos, debe agregar por lo menos una IP o una URL.",
                                showConfirmButton: true,
                                showCancelButton: false
                            });
                        } else {
                            // Enviar datos de IPs seleccionadas
                            $.ajax({
                                type: "POST",
                                url: "../../../../../../Controller/ctrEscaneo.php?escan=insert_ips_escaneo_nombre",
                                data: data_ip,
                                dataType: "json",
                                success: function(response) {
                                    // Manejar la respuesta del servidor si es necesario
                                }
                            });
                            // Enviar datos de URLs seleccionadas
                            $.ajax({
                                type: "POST",
                                url: "../../../../../../Controller/ctrEscaneo.php?escan=insert_urls_escaneo_nombre",
                                data: data_urls, // Corregido para enviar data_urls
                                dataType: "json",
                                success: function(response) {
                                    // Manejar la respuesta del servidor si es necesario
                                }
                            });
                            $.ajax({
                                type: "POST",
                                url: "../../../../../../Controller/ctrEscaneo.php?escan=insert_nuevo_escaneo_historial_escaneos",
                                data: {
                                    escaneo_id: id,
                                    id_estado_escaneo: 2
                                },
                                dataType: "json",
                                success: function(response) {}
                            });
                            toastr.success('Assets agregado correctamente.');
                            $("#mdlGestionarAssetsIpsUrls").modal("hide");
                            $("#table_get_escaneo_nombre").DataTable().ajax.reload();
                        }
                    });
                }

                function get_data_ips_escaneo(id) {
                    let ipsElement = document.getElementById("mover_ips_lanzar_escaneos");
                    let selectedIps = Array.from(ipsElement.selectedOptions).map(option => option.value);

                    return {
                        escaneo_id: id,
                        ips_id: selectedIps || [] // Cambiado a ips_id para coincidir con el campo en la base de datos
                    };
                }

                function get_data_urls_escaneo(id) {
                    let urlsElement = document.getElementById("mover_urls_lanzar_escaneos");
                    let selectedUrls = Array.from(urlsElement.selectedOptions).map(option => option.value);

                    return {
                        escaneo_id: id,
                        urls_id: selectedUrls || [] // Cambiado a urls_id para coincidir con el campo en la base de datos
                    };
                }



                function get_data_ips_escaneo(id) {
                    let ipsElement = document.getElementById("mover_ips_lanzar_escaneos");
                    let selectedIps = Array.from(ipsElement.selectedOptions).map(option => option.value);

                    return {
                        escaneo_id: id,
                        ips_id: selectedIps || [] // Cambiado a ips_id para coincidir con el campo en la base de datos
                    };
                }

                function get_data_urls_escaneo(id) {
                    let urlsElement = document.getElementById("mover_urls_lanzar_escaneos");
                    let selectedUrls = Array.from(urlsElement.selectedOptions).map(option => option.value);

                    return {
                        escaneo_id: id,
                        urls_id: selectedUrls || [] // Cambiado a urls_id para coincidir con el campo en la base de datos
                    };
                }

                function ajax_data_escaneo(registro) {
                    $.ajax({
                        type: "POST",
                        url: "../../../../../../Controller/ctrEscaneo.php?escan=gestionar_nuevo_escaneo",
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


                document.getElementById("btn_preparar_escaneo").addEventListener("click", function() {
                    let data = get_data_escaneo();
                    if (data.escaneo_titulo == '') {
                        Swal.fire({
                            icon: "question",
                            title: "Atencion",
                            text: "Debe ingresar un titulo",
                            showConfirmButton: true,
                            showCancelButton: true
                        })
                    } else {
                        ajax_data_escaneo(data);
                        toastr.success('Escaneo creado correctamente!');
                        $("#table_get_escaneo_nombre").DataTable().ajax.reload();
                        $("#mdlGestionaEscaneoNombre").modal("hide");
                    }
                });

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

                    document.getElementById("btn_gestionar_escaneo").addEventListener("click", function() {
                        $("#mdlLanzarEscaneo").modal("show");
                        $('.duallistbox').bootstrapDualListbox()
                    })


                    function actualizarHora() {
                        var ahora = new Date();
                        var horas = String(ahora.getHours()).padStart(2, '0');
                        var minutos = String(ahora.getMinutes()).padStart(2, '0');

                        var horaActual = horas + ':' + minutos;
                        document.getElementById('hora_escaneo').value = horaActual;
                    }
                    // Actualiza la hora cada 60 segundos
                    setInterval(actualizarHora, 60000);
                    actualizarHora();


                    document.getElementById("btn_importar_escaneo").addEventListener("click", function() {
                        $("#mdlImportarEscaneo").modal("show");
                    });

                    document.getElementById("btn_gestionar_escaneo_proyecto_creado").addEventListener("click",
                        function() {
                            $("#mdlLanzarEscaneoProyectoCreado").modal("show");
                        });
                });

                tabla = $("#table_get_escaneo_nombre").DataTable({
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
                        url: "../../../../../../Controller/ctrEscaneo.php?escan=get_creacion_escaneo",
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

                function btn_lanzar_escaneo(id) {
                    Swal.fire({
                        title: "¿Desea lanzar este scanner?",
                        text: "Antes se le recomienda verificar el horario y los assets. Si son los correctos, presione aceptar.",
                        showCancelButton: true,
                        confirmButtonText: "Aceptar",
                        cancelButtonText: "Cancelar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "../../../../../../Controller/ctrEscaneo.php?escan=insert_nuevo_escaneo_historial_escaneos",
                                data: {
                                    escaneo_id: id,
                                    id_estado_escaneo: 3
                                },
                                dataType: "json",
                                success: function(response) {}
                            });
                            $("#table_get_escaneo_nombre").DataTable().ajax.reload();
                        }
                    })
                }

                function verAssetsAgregador(id) {
                    $("#mdlDetalleAssets").modal("show");
                    $.post("../../../../../../Controller/ctrEscaneo.php?escan=get_assets_escaneo", {
                            id: id
                        },
                        function(data, textStatus, jqXHR) {
                            document.getElementById("mdl_option_assets").innerHTML = data;
                        },
                        "html",
                    );
                }

                function eliminarEscaneo(id) {
                    Swal.fire({
                        icon: "question",
                        title: "¿Estás seguro de eliminar este scanner?",
                        text: "No podrás recuperar este escaneo una vez eliminado.",
                        showCancelButton: true,
                        confirmButtonText: "Eliminar",
                        cancelButtonText: "Cancelar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post("../../../../../../Controller/ctrEscaneo.php?escan=disabled_escanner", {
                                    id: id
                                },
                                function(data, textStatus, jqXHR) {

                                },
                                "json"
                            );
                            toastr.success('Escanner eliminado correctamente!');
                        }
                        $("#table_get_escaneo_nombre").DataTable().ajax.reload();

                    })
                }
            </script>

            </html>