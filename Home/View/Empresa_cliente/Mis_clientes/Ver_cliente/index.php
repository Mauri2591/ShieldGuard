<?php
require_once '../../../../../Config/Conexion.php';
if (isset($_SESSION['usuario_empresa_id']) && !empty($_SESSION['usuario_empresa_id'])) {
    include_once '../../../../Template_shieldGuard/head.php';
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    if (isset($_GET)) {
        $cliente = urldecode(openssl_decrypt($_GET['cliente'], AES, KEY));
    }
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
            background-color: #b5b5b5;
        }

        .btn.moveall.btn-outline-secondary:hover {
            background-color: #f5f5f5;
            color: gray;
        }

        .btn.move.btn-outline-secondary:hover {
            background-color: #f5f5f5;
            color: gray;
        }

        .btn.remove.btn-outline-secondary:hover {
            background-color: #f5f5f5;
            color: gray;
        }

        .btn.removeall.btn-outline-secondary:hover {
            background-color: #f5f5f5;
            color: gray;
        }
    </style>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo URL ?>/Template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo URL ?>/Template/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?php echo URL ?>/Template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL ?>/Template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL ?>/Template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

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
                                            <i class="fas fa fa-plus-square right fas fa-angle-left text-light"></i>
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
                                    <?php include_once '../../../../Template_shieldGuard/titulo.php'; ?>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="card">
                        <div class="card-header  pt-0 pb-0 pl-0">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        <?php
        require_once '../../Mis_clientes/Ver_cliente/Gestionar_cliente/Activos/Modales_activos/mdlActivos.php';
        include '../../../../Template_shieldGuard/js.php';
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


            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            $(document).ready(function() {

                tabla = $("#table_nuevo_escaneo").DataTable({
                    "aProcessing": true,
                    "aServerSide": true,
                    dom: 'Bfrtip',
                    "searching": false,
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
                        url: "../../../Controller/ctrCliente.php?op_cliente=get_total_cliente",
                        type: "post",
                        dataType: "json",
                        data: {
                            // est: 1
                        },
                        error: function(e) {
                            // (e.responseText);
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
                    "autoWith": true,
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
                })

                tabla = $("#table_nuevo_tarea").DataTable({
                    "aProcessing": true,
                    "aServerSide": true,
                    dom: 'Bfrtip',
                    "searching": false,
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
                        url: "../../../Controller/ctrCliente.php?op_cliente=get_total_cliente",
                        type: "post",
                        dataType: "json",
                        data: {
                            // est: 1
                        },
                        error: function(e) {
                            // (e.responseText);
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
                    "iDisplayLength": 5, //cantidad de tuplas o filas a mostrar
                    "autoWith": true,
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
                })

                $.post("../../../../Controller/ctrCliente.php?op_cliente=get_datos_cliente", {
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

                /********************* Inicio escaneo ******************* */

                function data_escaneo() {
                    //Obtener el titulo del escaneo
                    let escaneo_titulo = document.getElementById("escaneo_titulo").value;
                    let fecha = document.getElementById("fecha_escaneo").value;
                    let hora = document.getElementById("hora_escaneo").value;
                    let escaneo_fecha = fecha + " " + hora

                    // Obtener las opciones seleccionadas de ips
                    let ipsElement = document.getElementById("mover_ips_lanzar_escaneos");
                    let selectedIps = Array.from(ipsElement.selectedOptions).map(option => option.value);

                    // Obtener las opciones seleccionadas de urls
                    let urlsElement = document.getElementById("mover_urls_lanzar_escaneos");
                    let selectedUrls = Array.from(urlsElement.selectedOptions).map(option => option.value);

                    // Crear el objeto de datos con ips y urls seleccionados
                    let data = {
                        escaneo_titulo: escaneo_titulo,
                        ips: selectedIps,
                        urls: selectedUrls,
                        escaneo_fecha: escaneo_fecha
                    };

                    return data
                }

                // function ajax_data_escaneo(registro){
                //     $.ajax({
                //         type: "POST",
                //         url: "../../../Controller/",
                //         data: "data",
                //         dataType: "dataType",
                //         success: function (response) {

                //         }
                //     });
                // }

                document.getElementById("btn_lanzar_escaneo").addEventListener("click", function() {
                    console.log(data_escaneo())
                });

                /************************* Fin escaneo ************************************ */


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

                document.getElementById("btn_gestionar_escaneo_proyecto_creado").addEventListener("click", function() {
                    $("#mdlLanzarEscaneoProyectoCreado").modal("show");
                });

                $.post("../../../../Controller/ctrProyectosCliente.php?proy=get_ips_x_cliente", {
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

                $.post("../../../../Controller/ctrProyectosCliente.php?proy=get_urls_x_cliente", {
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

                $.post("../../../../Controller/ctrCliente.php?op_cliente=get_datos_cliente", {
                        cliente_id: cliente_id
                    },
                    function(data, textStatus, jqXHR) {
                        document.getElementById("nom_cliente").innerText = data.cliente_nombre;
                        (data);
                    },
                    "json"
                );

                tabla = $("#usuarios_cliente").DataTable({
                    "aProcessing": true,
                    "aServerSide": true,
                    dom: 'Bfrtip',
                    "searching": false,
                    lenghtChange: false,
                    colReorder: true,
                    buttons: [],
                    "ajax": {
                        url: "../../../../Controller/ctrActivos.php?activo=get_datos_cuentas_cliente",
                        type: "post",
                        dataType: "json",
                        data: {
                            cliente_id: cliente_id
                        },
                        error: function(e) {
                            (e.responseText);
                        }
                    },
                    "order": [
                        [0, "desc"]
                    ], //Ordenar descendentemente
                    "bDestroy": true,
                    "responsive": true,
                    "bInfo": true,
                    "iDisplayLength": 5, //cantidad de tuplas o filas a mostrar
                    "autoWith": false,
                    "language": {
                        "sProcessing": "Procesando..",
                        "sLengthMenu": "Mostrar _MENU_ cuentas",
                        "sZeroRecords": "No se encontraron resultados..",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando un total de _TOTAL_ cuentas",
                        "sInfoEmpty": "Mostrando un total de 0 cuentas",
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

                $.post("../../../../Controller/ctrActivos.php?activo=get_datos_cuentas_cliente_estados", {
                        cliente_id: cliente_id
                    },
                    function(data, textStatus, jqXHR) {
                        (data);
                        document.getElementById("cantidad_cuentas_usuarios_activos").innerText = data.total_activos
                        document.getElementById("cantidad_cuentas_usuarios_inactivo").innerText = data.total_inactivos
                    },
                    "json"
                );

                tabla = $("#ips_cliente").DataTable({
                    "aProcessing": true,
                    "aServerSide": true,
                    dom: 'Bfrtip',
                    "searching": false,
                    lenghtChange: false,
                    colReorder: true,
                    buttons: [],
                    "ajax": {
                        url: "../../../../Controller/ctrActivos.php?activo=get_ips",
                        type: "post",
                        dataType: "json",
                        data: {
                            cliente_id: cliente_id
                        },
                        error: function(e) {
                            (e.responseText);
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
                        "sLengthMenu": "Mostrar _MENU_ ip's",
                        "sZeroRecords": "No se encontraron resultados..",
                        "sEmptyTable": "Ningún dato disponible en estip's",
                        "sInfo": "Mostrando un total de _TOTAL_ ip's",
                        "sInfoEmpty": "Mostrando un total de 0 ip's",
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

                $.post("../../../../Controller/ctrActivos.php?activo=get_cantidad_ips", {
                        cliente_id: cliente_id
                    },
                    function(data, textStatus, jqXHR) {
                        (data);
                        document.getElementById("cantidad_ips_activas").innerText = data.total_activos
                        document.getElementById("cantidad_ips_inactivas").innerText = data.total_inactivos
                    },
                    "json"
                );

                tabla = $("#urls_cliente").DataTable({
                    "aProcessing": true,
                    "aServerSide": true,
                    dom: 'Bfrtip',
                    "searching": false,
                    lenghtChange: false,
                    colReorder: true,
                    buttons: [],
                    "ajax": {
                        url: "../../../../Controller/ctrActivos.php?activo=get_urls",
                        type: "post",
                        dataType: "json",
                        data: {
                            cliente_id: cliente_id
                        },
                        error: function(e) {
                            (e.responseText);
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
                        "sLengthMenu": "Mostrar _MENU_ url's",
                        "sZeroRecords": "No se encontraron resultados..",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando un total de _TOTAL_ url's",
                        "sInfoEmpty": "Mostrando un total de 0 url's",
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

                $.post("../../../../Controller/ctrActivos.php?activo=get_cantidad_urls", {
                        cliente_id: cliente_id
                    },
                    function(data, textStatus, jqXHR) {
                        (data);
                        document.getElementById("cantidad_urls_activas").innerText = data.total_activos
                        document.getElementById("cantidad_urls_inactivas").innerText = data.total_inactivos
                    },
                    "json"
                );

                $("#custom-tabs-two-home-tab").click(function() {
                    window.location.reload()
                })
            });

            // ***************************** Inicio Alta Usuario Cliente  ***************************************

            function limpiar_formulario_usuario_cliente() {
                $("#email_usuario_cliente").val('');
                $("#password_usuario_cliente").val('');
            }

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

            function get_datos_usuario_cliente() {
                let registro = {
                    rol_id: $("#rol_id").val(),
                    cliente_id: cliente_id,
                    email_usuario_cliente: $("#email_usuario_cliente").val(),
                    password_usuario_cliente: $("#password_usuario_cliente").val()
                }
                return registro;
            }

            function get_datos_ajax(registro) {
                $.ajax({
                    type: "POST",
                    url: "../../../../Controller/ctrActivos.php?activo=insert_usuario_cliente",
                    data: registro,
                    dataType: "json",
                    success: function(response) {
                        // (response);
                    }
                });
            }

            $("#btnAgregarUsuarioCliente").on("click", function() {
                let registro = get_datos_usuario_cliente();
                if (registro.email_usuario_cliente == '') {
                    Swal.fire({
                        icon: "warning",
                        title: "Error",
                        text: "Hay campos vacios!",
                        showConfirmButton: true,
                        showCancelButton: true
                    })
                } else {
                    get_datos_ajax(registro);
                    Toast.fire({
                        icon: "success",
                        title: "Usuario creado correctamente",
                    })
                    $("#alta_usuario_cliente").modal("hide");
                    $("#usuarios_cliente").DataTable().ajax.reload();
                    // setTimeout(() => {
                    //     window.location.reload();
                    // }, 2500);
                }
            });

            function alta_cuenta() {
                limpiar_formulario_usuario_cliente();
                $("#alta_usuario_cliente").modal("show");
                let keysegura = generateSecureKey();
                $("#password_usuario_cliente").val(keysegura);

                $.post("../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=get_rol_para_usuario",
                    function(data, textStatus, jqXHR) {
                        document.getElementById("rol_id").innerHTML = data;
                    }
                );
            }

            // ***************************** Fin Alta Usuario Cliente  ***************************************


            // ***************************** Inicio Alta Ips Cliente  ***************************************
            function alta_ip(cliente_id) {
                $("#ip").val('');
                $("#alta_ips_cliente").modal("show");

                function format_ips(ips) {
                    return ips.split(/[\s,]+/).map(ip => ip.trim().replace(/[^0-9.]/g, '')).filter(ip => ip !== '').join('\n');
                }

                function validate_ip(ip) {
                    const regex = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
                    return regex.test(ip);
                }

                function get_datos_insert_ips() {
                    let ips = $("#ip").val().split(/[\n,]+/); // Separar las IPs por líneas o comas
                    let registros = ips.map(ip => ({
                        ip: ip.trim(), // Eliminar espacios en blanco
                        cliente_id: cliente_id
                    }));
                    return registros;
                }

                function get_datos_insert_ips_ajax(registro) {
                    $.ajax({
                        type: "POST",
                        url: "../../../../Controller/ctrActivos.php?activo=insert_ips",
                        data: registro,
                        dataType: "json",
                        success: function(response) {
                            if (response.status === "error") {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error!",
                                    text: response.message
                                });
                            } else {
                                toastr.success('Insertado correctamente.')
                                $("#ips_cliente").DataTable().ajax.reload();
                                $("#alta_ips_cliente").modal("hide");
                            }
                        },
                        error: function(e) {
                            // (e);
                        }
                    });
                }

                document.getElementById("ip").addEventListener("paste", function(event) {
                    setTimeout(() => {
                        let ips = $("#ip").val();
                        $("#ip").val(format_ips(ips));
                    }, 100);
                });

                $("#btnAgregarIpsCliente").off("click").on("click", function() {
                    let registros = get_datos_insert_ips();
                    let invalid_ips = registros.filter(registro => !validate_ip(registro.ip));

                    if (registros.length === 0 || registros[0].ip === '') {
                        Swal.fire({
                            icon: "warning",
                            title: "Error!",
                            text: "Debe ingresar al menos una dirección IP",
                            showCancelButton: true,
                            showConfirmButton: true
                        });
                    } else if (invalid_ips.length > 0) {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: "Una o más IPs tienen un formato inválido. Por favor, revise las IPs ingresadas."
                        });
                        $("#ip").val(''); // Limpiar el campo de texto
                    } else {
                        registros.forEach(registro => get_datos_insert_ips_ajax(registro));
                    }
                });
            }

            function btnEditarIp(id) {
                $("#update_ips_cliente").modal("show");
                $.post("../../../../Controller/ctrActivos.php?activo=get_ip_x_id", {
                        id: id
                    },
                    function(data, textStatus, jqXHR) {
                        document.getElementById("ip_update").value = data.ip;
                    },
                    "json"
                );
                document.getElementById("btnUpdateIpsCliente").addEventListener("click", function() {
                    $.post("../../../../Controller/ctrActivos.php?activo=update_ips", {
                            ip: document.getElementById("ip_update").value,
                            id: id
                        },
                        function(data, textStatus, jqXHR) {},
                        "json"
                    );
                    Toast.fire({
                        icon: "success",
                        title: "IP actualizada correctamente"
                    })
                    $("#update_ips_cliente").modal("hide");
                    $("#ips_cliente").DataTable().ajax.reload();
                })
            }

            function btnInactivarIp(id) {
                Swal.fire({
                    icon: "warning",
                    title: "Desea inhabilitar esta Ip?",
                    showCancelButton: true,
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../../../Controller/ctrActivos.php?activo=cambiar_estado_ip", {
                                est: 0,
                                id: id
                            },
                            function(data, textStatus, jqXHR) {},
                            "json"
                        );
                        toastr.success('Ip desabilitada correctamente.')
                        $("#ips_cliente").DataTable().ajax.reload();
                    }
                })
            }

            function btnActivarIp(id) {
                Swal.fire({
                    icon: "warning",
                    title: "Desea habilitar esta Ip?",
                    showCancelButton: true,
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../../../Controller/ctrActivos.php?activo=cambiar_estado_ip", {
                                est: 1,
                                id: id
                            },
                            function(data, textStatus, jqXHR) {},
                            "json"
                        );
                        toastr.success('Ip habilitada correctamente.')
                        $("#ips_cliente").DataTable().ajax.reload();
                    }
                })
            }
            // ***************************** Fin Alta Ips Cliente  ***************************************

            // ***************************** Inicio Alta Urls Cliente  ***************************************
            function alta_url(cliente_id) {
                $("#url").val('');
                $("#alta_urls_cliente").modal("show");

                // Función para formatear las URLs: Elimina espacios en blanco, separa por saltos de línea y filtra entradas vacías.
                function format_urls(urls) {
                    return urls.split(/[\s,]+/)
                        .map(url => url.trim())
                        .filter(url => url !== '')
                        .join('\n');
                }

                // Función para validar una URL utilizando una expresión regular robusta.
                function validate_url(url) {
                    const regex = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
                    return regex.test(url);
                }

                // Función para preparar los datos de inserción de URLs.
                // Formatea las URLs, luego valida cada una, y solo añade las válidas a la lista de registros.
                function get_datos_insert_urls(cliente_id) {
                    let urls = $("#url").val().split(/[\n,]+/); // Separar las URLs por líneas o comas
                    let registros = urls.map(url => ({
                        url: url.trim(), // Eliminar espacios en blanco
                        cliente_id: cliente_id
                    }));
                    return registros;
                }

                function get_datos_insert_urls_ajax(registro) {
                    $.ajax({
                        type: "POST",
                        url: "../../../../Controller/ctrActivos.php?activo=insert_urls",
                        data: registro,
                        dataType: "json",
                        success: function(response) {
                            if (response.status === "error") {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error!",
                                    text: response.message
                                });
                            } else {
                                Toast.fire({
                                    icon: "success",
                                    text: "Agregado correctamente"
                                });
                                $("#alta_urls_cliente").modal("hide");
                                $("#urls_cliente").DataTable().ajax.reload();
                            }
                        },
                        error: function(e) {
                            (e);
                        }
                    });
                }

                document.getElementById("url").addEventListener("paste", function(event) {
                    setTimeout(() => {
                        let urls = $("#url").val();
                        $("#url").val(format_urls(urls));
                    }, 100);
                });

                $("#btnAgregarUrlsCliente").off("click").on("click", function() {
                    let registros = get_datos_insert_urls(cliente_id); // Aquí pasas el cliente_id correctamente
                    let invalid_urls = registros.filter(registro => !validate_url(registro.url));

                    if (registros.length === 0 || registros[0].url === '') {
                        Swal.fire({
                            icon: "warning",
                            title: "Error!",
                            text: "Debe ingresar al menos una URL",
                            showCancelButton: true,
                            showConfirmButton: true
                        });
                    } else if (invalid_urls.length > 0) {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: "Una o más URLs tienen un formato inválido. Por favor, revise las URLs ingresadas."
                        });
                        $("#url").val(''); // Limpiar el campo de texto
                    } else {
                        registros.forEach(registro => get_datos_insert_urls_ajax(registro));
                    }
                });
            }


            function btnEditarUrl(id) {
                $("#alta_urls_cliente").modal("show");
                $.post("../../../../Controller/ctrActivos.php?activo=get_url_x_id", {
                        id: id
                    },
                    function(data, textStatus, jqXHR) {
                        document.getElementById("url_update").value = data.url;
                    },
                    "json"
                );
                document.getElementById("btnAgregarUrlsCliente").addEventListener("click", function() {
                    $.post("../../../../Controller/ctrActivos.php?activo=update_urls", {
                            ip: document.getElementById("url_update").value,
                            id: id
                        },
                        function(data, textStatus, jqXHR) {},
                        "json"
                    );
                    Toast.fire({
                        icon: "success",
                        title: "Url actualizada correctamente"
                    })
                    $("#alta_urls_cliente").modal("hide");
                    $("#urls_cliente").DataTable().ajax.reload();
                })
            }

            function btnInactivarUrl(id) {
                Swal.fire({
                    icon: "warning",
                    title: "Desea inhabilitar esta Url?",
                    showCancelButton: true,
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../../../Controller/ctrActivos.php?activo=cambiar_estado_url", {
                                est: 0,
                                id: id
                            },
                            function(data, textStatus, jqXHR) {},
                            "json"
                        );
                        toastr.success('Url inhabilitada correctamente.')
                        $("#urls_cliente").DataTable().ajax.reload();
                    }
                })
            }

            function btnActivarUrl(id) {
                Swal.fire({
                    icon: "warning",
                    title: "Desea habilitar esta Ip?",
                    showCancelButton: true,
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../../../Controller/ctrActivos.php?activo=cambiar_estado_url", {
                                est: 1,
                                id: id
                            },
                            function(data, textStatus, jqXHR) {},
                            "json"
                        );
                        toastr.success('Url habilitada correctamente.')
                        $("#urls_cliente").DataTable().ajax.reload();
                    }
                })
            }
            // ***************************** Fin Alta Urls Cliente  ***************************************
        </script>

        </html>