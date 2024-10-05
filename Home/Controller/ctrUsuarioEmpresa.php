<?php
require_once '../../Config/Conexion.php';
require_once '../Model/UsuarioEmpresa.php';
$usuario_empresa = new UsuarioEmpresa();

switch ($_GET['usuario_empresa']) {
    case 'get_total_usuarios_empresa':
        echo json_encode($usuario_empresa->get_total_usuarios_empresa($_SESSION['empresa_id']));
        break;

    case 'get_rol_para_usuario':
        $datos = $usuario_empresa->get_rol_para_usuario();
        $html = "";
        foreach ($datos as $key => $row) {
            $html .= '<option value="' . $row['rol_id'] . '">' . $row['rol_nombre'] . '</option>';
        }
        echo $html;
        break;

    case 'crear_usuario_empresa':
        $usuario_empresa->crear_usuario_empresa($_POST['rol_id'], $_SESSION['usuario_empresa_id'], $_SESSION['empresa_id'], $_POST['email_usuario_empresa'], $_POST['password_usuario_empresa']);
        break;

    case 'crear_usuario_partner':
        $usuario_empresa->crear_usuario_partner($_POST['rol_id'], $_SESSION['usuario_empresa_id'], $_POST['empresa_id'], $_POST['email_usuario_empresa'], $_POST['password_usuario_empresa']);
        break;

    case 'get_consultar_usuarios_mi_empresa':
        $datos = $usuario_empresa->get_consultar_usuarios_mi_empresa($_SESSION['empresa_id']);
        if (is_array($datos) && count($datos) > 0) {
            $data = array();
            $session_rol_id = $_SESSION['rol_id'];
            $session_usuario_empresa_id = $_SESSION['usuario_empresa_id'];
            foreach ($datos as $key => $row) {
                $sub_array = array();
                $sub_array[] = $row['email_usuario_empresa'];
                $sub_array[] = $row['rol_id'] === 1 ? "<span class='badge bg-warning'>Administrador</span>" : "<span class=' badge bg-info'>Usuario</span>";
                $sub_array[] = date("d-m-Y", strtotime($row['usuario_empresa_fecha_creacion']));
                $sub_array[] = $row['usuario_empresa_est'] === 1 ? "<span class='badge bg-success'>Activo</span>" : "<span class='badge bg-secondary'>Inactivo</span>";
                $botones = '';
                if ($session_usuario_empresa_id === $row['usuario_empresa_id'] || $session_rol_id === 1) {
                    $botones .= '<button type="button" onClick="btnReset_password_usuario_empresa(' . $row['usuario_empresa_id'] . ')" class="btn" data-toggle="tooltip" data-placement="top" title="Reset Password">
                                        <i style="color:#546bb5" class="fas fa-key"></i>
                                     </button>';
                }
                if ($session_rol_id === 1) {
                    $botones .= '<button type="button" onClick="btnActivar_usuario_empresa(' . $row['usuario_empresa_id'] . ')" class="btn" data-toggle="tooltip" data-placement="top" title="Activar Usuario">
                                        <i class="fa fa-user-plus text-success"></i>
                                     </button>';
                    $botones .= '<button type="button" onClick="btnDesactivar_usuario_empresa(' . $row['usuario_empresa_id'] . ')" class="btn" data-toggle="tooltip" data-placement="top" title="Inactivar Usuario">
                                        <i class="fa fa-user-times text-secondary"></i>
                                     </button>';
                }
                $sub_array[] = '<td>
                                    <div class="btn-group">
                                        ' . $botones . '
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
        }
        break;

    case 'get_consultar_usuarios_partner':
        $datos = $usuario_empresa->get_consultar_usuarios_partner($_POST['empresa_id']);
        if (is_array($datos) && count($datos) > 0) {
            $data = array();

            foreach ($datos as $key => $row) {
                $sub_array = array();
                $sub_array[] = $row['email_usuario_empresa'];
                $sub_array[] = $row['rol_id'] === 1 ? "<span class='badge bg-warning'>Administrador</span>" : "<span class=' badge bg-info'>Usuario</span>";
                $sub_array[] = $row['usuario_empresa_est'] === 1 ? "<span class='badge bg-success'>Activo</span>" : "<span class='badge bg-secondary'>Inactivo</span>";
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

    case 'setear_password_usuario_empresa':
        $usuario_empresa->setear_password_usuario_empresa($_POST['password_usuario_empresa'], $_POST['usuario_empresa_id'], $_SESSION['empresa_id']);
        break;

    case 'desactivar_usuario_empresa':
        $usuario_empresa->desactivar_usuario_empresa($_POST['usuario_empresa_id'], $_SESSION['empresa_id']);
        break;

    case 'activar_usuario_empresa':
        $usuario_empresa->activar_usuario_empresa($_POST['usuario_empresa_id'], $_SESSION['empresa_id']);
        break;

    case 'logs_usuarios':
        $datos = $usuario_empresa->logs_usuarios($_SESSION['empresa_id']);
        $data = array();
        foreach ($datos as $key => $row) {
            $sub_array = array();
            $sub_array[] = $row['email_creador'];
            $sub_array[] = $row['logs_accion'];
            $sub_array[] = $row['email_pasivo'];
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
        break;

    default:
        echo "Error en el controller ctrUsuarioEmpresa";
        break;
}
