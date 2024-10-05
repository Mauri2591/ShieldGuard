<?php
require_once '../../Config/Conexion.php';
require_once '../Model/Activos.php';
$activo = new Activos();
try {
    switch ($_GET['activo']) {
        case 'insert_usuario_cliente':
            $activo->insert_usuario_cliente($_POST['rol_id'], $_POST['cliente_id'], $_SESSION['empresa_id'], $_POST['email_usuario_cliente'], $_POST['password_usuario_cliente']);
            break;

        case 'get_datos_cuentas_cliente':
            $datos = $activo->get_datos_cuentas_cliente($_POST['cliente_id'], $_SESSION['empresa_id']);
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row['email_usuario_cliente'];
                $sub_array[] = $row['rol_id'] === 1 ? '<span class="badge text-primary">Admin</span>' : '<span class="badge text-secondary">Usuario</span>';
                $sub_array[] = $row['usuario_cliente_est'] === 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-secondary">Inactivo</span>';
                $sub_array[] = '
                <span type="button" onClick="btnEdit(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Editar Cuenta" class="badge text-primary fs-13" style="cursor: pointer;">
                    <i class="far fa-edit"></i>
                </span>
                <span type="button" onClick="btnElim(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Inabilitar Cuenta" class="badge text-secondary fs-13" style="cursor: pointer;">
                    <i class="fa fa-trash"></i>
                </span>';
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


        case 'get_datos_cuentas_cliente_estados':
            echo json_encode($activo->get_datos_cuentas_cliente_estados($_POST['cliente_id'], $_SESSION['empresa_id']));
            break;

        case 'get_ambientes':
            $dato = $activo->get_ambientes();
            if (is_array($dato) && count($dato) > 0) {
                $html = '';
                foreach ($dato as $key => $row) {
                    $html .= '<option value="' . $row['id'] . '">' . $row['nombre_ambiente'] . '</option>';
                }
                echo $html;
                break;
            }

        case 'insert_ips':
            $cliente_id = $_POST['cliente_id'];
            $ambiente_id = $_POST['ambiente_id'];
            $ip = $_POST['ip'];
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                $activo->insert_ips($cliente_id, $ambiente_id, $ip);
                echo json_encode(["status" => "success", "message" => "IP insertada correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "IP inválida"]);
            }
            break;

        case 'get_ips':
            $datos = $activo->get_ips($_POST['cliente_id']);
            $data = array();
            if (is_array($datos) && count($datos) > 0) {
                foreach ($datos as $row) {
                    $sub_array = array();
                    $sub_array[] = '<span class="badge" style="font-size:.9em">'.$row['ip'].'</span>';
                    $sub_array[] = $row['ambiente_id'] == 1 ? '<span class="badge text-secondary " style="font-size:.9em">Produccion</span>' : ($row['ambiente_id'] == 2 ? '<span class="badge text-info "  style="font-size:.9em">Staging</span>' : '<span class="badge text-orange "  style="font-size:.9em">Desarrollo</span>');
                    $sub_array[] = $row['est'] === 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-secondary">Inactivo</span>';
                    $sub_array[] = '
                    <span type="button" onClick="btnInactivarIp(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Inabilitar Ip" class="badge text-secondary" style="cursor: pointer; font-size:1em">
                        <i class="fas fa-arrow-circle-down"></i>
                    </span>
                    <span type="button" onClick="btnActivarIp(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Habilitar Ip" class="badge text-success" style="cursor: pointer; font-size:1em">
                        <i class="fas fa-arrow-alt-circle-up"></i>
                    </span>';
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

        case 'get_cantidad_ips':
            echo json_encode($activo->get_cantidad_ips($_POST['cliente_id']));
            break;

        case 'get_ip_x_id':
            echo json_encode($activo->get_ip_x_id($_POST['id']));
            break;

        case 'update_ips':
            $activo->update_ips($_POST['ip'], $_POST['id']);
            break;

        case 'cambiar_estado_ip':
            $activo->cambiar_estado_ip($_POST['est'], $_POST['id']);
            break;

        case 'insert_urls':
            $cliente_id = $_POST['cliente_id'];
            $url = $_POST['url'];
            $ambiente_id = $_POST['ambiente_id'];
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                $activo->insert_urls($cliente_id, $ambiente_id, $url);
                echo json_encode(["status" => "success", "message" => "url insertada correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "url inválida"]);
            }
            break;

        case 'get_urls':
            $datos = $activo->get_urls($_POST['cliente_id']);
            $data = array();
            if (is_array($datos) && count($datos) > 0) {
                foreach ($datos as $row) {
                    $sub_array = array();
                    $sub_array[] = '<span class="badge" style="font-size:.9em">'.$row['url'].'</span>';
                    $sub_array[] = $row['ambiente_id'] == 1 ? '<span class="badge text-secondary " style="font-size:.9em">Produccion</span>' : ($row['ambiente_id'] == 2 ? '<span class="badge text-info "  style="font-size:.9em">Staging</span>' : '<span class="badge text-orange "  style="font-size:.9em">Desarrollo</span>');
                    $sub_array[] = $row['est'] === 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-secondary">Inactivo</span>';
                    $sub_array[] = '
                        <span type="button" onClick="btnInactivarUrl(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Inabilitar Url" class="badge text-secondary" style="cursor: pointer; font-size:1em">
                            <i class="fas fa-arrow-circle-down"></i>
                        </span>
                        <span type="button" onClick="btnActivarUrl(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Habilitar Url" class="badge text-success" style="cursor: pointer; font-size:1em">
                            <i class="fas fa-arrow-alt-circle-up"></i>
                        </span>';
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


        case 'get_cantidad_urls':
            echo json_encode($activo->get_cantidad_urls($_POST['cliente_id']));
            break;

        case 'get_url_x_id':
            echo json_encode($activo->get_url_x_id($_POST['id']));
            break;

        case 'update_urls':
            $activo->update_urls($_POST['ip'], $_POST['id']);
            break;

        case 'cambiar_estado_url':
            $activo->cambiar_estado_url($_POST['est'], $_POST['id']);
            break;

        default:
            echo "Error en el ctrActivos";
            break;
    }
} catch (\PDOException $e) {
    echo "Error " . $e->getMessage();
}
