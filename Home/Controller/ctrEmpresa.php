<?php
require_once '../../Config/Conexion.php';
require_once '../Model/Empresa.php';

$empresa = new Empresa();

switch ($_GET['empre']) {

  case 'consultar_partners':
    $empresa->consultar_partners();
    $datos = $empresa->consultar_partners();
    $data = array();
    foreach ($datos as $row) {
      $sub_array = array();
      $sub_array[] = $row['empresa_nombre'];
      $sub_array[] = $row['empresa_cuit'];
      $sub_array[] = $row['empresa_razon_social'];
      $sub_array[] = date("d-m-Y H:m", strtotime($row['empresa_fecha_creacion']));
      $sub_array[] = $row['empresa_est'] == 1 ? "<span class='badge bg-success'>Activo</span>" : "<span class='badge bg-secondary'>Inactivo</span>";
      $sub_array[] = '<td>
      <div class="btn-group">

        <a type="button"  href="' . URL . "/Home/View/Empresa_usuario/Mis_empresas_clientes/Consultar_partners/Detalle_partners/?empresa_id=" . urlencode(openssl_encrypt($row['empresa_id'], AES, KEY)) . '" class="btn" data-toggle="tooltip" data-placement="top" title="Gestionar" target="_blank" rel="noopener noreferrer">      
          <i class="fa fa-folder-open text-primary"></i>
        </a>

        <button type="button" onClick="btnActivar_partner(' . $row['empresa_id'] . ')" class="btn" data-toggle="tooltip" data-placement="top" title="Activar Partner">
          <i class="fa fa-battery-full text-success"></i>
        </button>

        <button type="button" onClick="btnInactivar_partner(' . $row['empresa_id'] . ')" class="btn" data-toggle="tooltip" data-placement="top" title="Inactivar Partner">
          <i class="fas fa-battery-quarter text-secondary"></i>
        </button>      
        </div>
      </td>';
      $data[] = $sub_array;
    }
    $results = array(
      "sEcho" => 1,
      "iTotalRecords" => count($data),
      "iTotalDisplayRecords" => count($data),
      "aaData" => $data
    );
    echo json_encode($results);
    break;

  case 'get_count_total_empresas':
    echo json_encode($empresa->get_count_total_empresas());
    break;

  case 'get_count_total_empresas_alta':
    echo json_encode($empresa->get_count_total_empresas_alta());
    break;

  case 'get_count_total_empresas_baja':
    echo json_encode($empresa->get_count_total_empresas_baja());
    break;

  case 'agregar_empresa':
    $empresa->agregar_empresa($_SESSION['usuario_empresa_id'], $_POST['empresa_nombre'], $_POST['empresa_cuit'], $_POST['empresa_razon_social']);
    break;

  case 'update_inactivar_empresa':
    $empresa->update_inactivar_empresa($_POST['empresa_id']);
    break;

  case 'update_activar_empresa':
    $empresa->update_activar_empresa($_POST['empresa_id']);
    break;

  case 'logs_empresas_partners':
    $datos = $empresa->logs_empresas_partners($_SESSION['empresa_id']);
    if (is_array($datos) && count($datos) > 0) {
      $data = array();
      foreach ($datos as $key => $row) {
        $sub_array = array();
        $sub_array[] = $row['email_usuario_empresa'];
        $sub_array[] = $row['logs_accion'];
        $sub_array[] = $row['empresa_nombre'];
        $sub_array[] = $row['empresa_razon_social'];
        $sub_array[] = date("d-m-Y H:i", strtotime($row['fech_crea']));
        $data[] = $sub_array;
      }
      $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data
      );
      echo json_encode($results);
    }
    break;

  case 'logs_usuarios_empresas_partners':
    $datos = $empresa->logs_usuarios_empresas_partners($_POST['empresa_id']);
    if (is_array($datos) && count($datos) > 0) {
      $data = array();
      foreach ($datos as $key => $row) {
        $sub_array = array();
        $sub_array[] = $row['email_creador'];
        $sub_array[] = $row['logs_accion'];
        $sub_array[] = $row['email_pasivo'];
        $sub_array[] = $row['partner'];
        $sub_array[] = date("d-m-Y H:i", strtotime($row['fech_crea']));
        $data[] = $sub_array;
      }
      $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data
      );
      echo json_encode($results);
    }
    break;

  case 'get_datos_empresa':
    echo json_encode($empresa->get_datos_empresa($_POST['empresa_id']));
    break;

  default:
    echo "Error en el controller ctrEmpresa";
    break;
}
