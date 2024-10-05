<?php
require_once '../../Config/Conexion.php';
if (isset($_SESSION['usuario_empresa_id']) && !empty($_SESSION['usuario_empresa_id'])) {
  include '../Template_shieldGuard/head.php';
  include '../Template_shieldGuard/header.php';
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

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 style="font-family: monospace; color:#2d438b">Inicio</h4>
          </div>
          <div class="callout callout-info bg-light" style="width: 100%; height: 30px; align-items: center; display: flex; margin-bottom: 0;">
            <p><i class="fas fa-info text-secondary"></i> Desde aqui puede consultar cualquier CVE registrado a la fecha</p>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div id="cont_api"></div>
      <div class="card">
        <div class="card-header bg-light">
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div id="snipper_table_vulns_cve" class="overlay"><i class="fas fa-2x fa-sync-alt text-secondary fa-spin"></i>
            <!-- <div class="text-bold pt-2">Cargando data...</div> -->
          </div>
          <?php require_once '../View/ModalesCve/mdlVerCve.php'; ?>

          <table id="table_vulns_cve" style="font-size: 14px;">
            <thead class="text-center">
              <tr>
                <th style="width: 20%;">CVE</th>
                <th style="width: 20%;">LastModified</th>
                <th style="width: 20%;">VulnStatus</th>
                <th style="width: 40%;">Vector</th>
                <th style="width: 15%;">Ver</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>

<?php
  include '../Template_shieldGuard/js.php';
} else {
  header("Location:" . URL . "/Home/View/Logout/");
}
?>

<script src="main.js"></script>

</html>