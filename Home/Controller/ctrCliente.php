<?php
require_once '../../Config/Conexion.php';
require_once '../Model/Cliente.php';
$cliente = new Cliente();

try {
    switch ($_GET['op_cliente']) {

        case 'get_tipo_cliente':
            $option = '';
            $datos = $cliente->get_tipo_cliente();
            foreach ($datos as $key => $row) {
                $option .= '<option value="' . $row['id'] . '">' . $row['tipo_cliente'] . '</option>';
            }
            echo $option;
            break;

        case 'insert_nuevo_cliente':
            $cliente->insert_nuevo_cliente($_SESSION['root_id'], $_SESSION['empresa_id'], $_POST['id_tipo_cliente'], $_POST['cliente_cuit_cuil'], $_POST['cliente_nombre'], $_POST['cliente_razon_social']);
            break;

        case 'get_total_cliente':
            $datos = $cliente->get_total_cliente($_SESSION['empresa_id']);
            $results = array();
            if (is_array($datos) && count($datos) > 0) {
                $data = array();
                foreach ($datos as $key => $row) {
                    $sub_array = array();
                    $sub_array[] = $row['cliente_nombre'];
                    $sub_array[] = $row['cliente_razon_social'];
                    $sub_array[] = $row['cliente_cuit_cuil'];
                    $sub_array[] = date("d-m-Y", strtotime($row['fecha_creacion']));
                    $sub_array[] = $row['cliente_est'] === 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-secondary">Inactivo</span>';
                    $sub_array[] = '<span style="font-size:.9em" class="badge bg-light tet-dark data-toggle="tooltip" data-placement="top" title="Consultar detalle del Cliente""><a href="' . URL . '/Home/View/Empresa_cliente/Mis_clientes/Ver_cliente/?cliente=' . urlencode(openssl_encrypt($row['cliente_id'], AES, KEY)) . '">Detalle</a></span>';
                    $data[] = $sub_array;
                }
                $results = array(
                    "sEcho" => 1,
                    "iTotalRecords" => count($data),
                    "iTotalDisplayRecords" => count($data),
                    "aaData" => $data
                );
            }
            echo json_encode($results);
            break;

        case 'get_total_clientes_iconos':
            echo json_encode($cliente->get_total_clientes_iconos($_SESSION['empresa_id']));
            break;


        case 'get_estado_cliente':
            echo json_encode($cliente->get_estado_cliente($_POST['cliente_id']));
            break;

        case 'update_cliente_inactivar':
            echo json_encode($cliente->update_cliente_inactivar($_POST['cliente_id'], $_SESSION['empresa_id']));
            break;

        case 'update_cliente_activar':
            echo json_encode($cliente->update_cliente_activar($_POST['cliente_id'], $_SESSION['empresa_id']));
            break;

        case 'get_datos_cliente':
            echo json_encode($cliente->get_datos_cliente($_POST['cliente_id'], $_SESSION['empresa_id']));
            break;
        default:
            echo "Error en el controller ctrCliente";
            break;
    }
} catch (\PDOException $e) {
    echo "Error " . $e->getMessage();
}
