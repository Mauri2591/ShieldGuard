<?php
if (isset($_SESSION['usuario_empresa_id'])) {
?>

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
                    Gestion
                      <i class="right fa fa-users text-light"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="../View/Empresa_usuario/Mi_empresa/" class="nav-link">
                        <p>Mi Empresa</p>
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
              </ul>
              </li>
              </ul>
            </nav>
          </div>
        </aside>
    <?php }
    } else {
      header("Location:" . URL);
    } ?>