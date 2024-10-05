<?php
require_once '../../Config/Conexion.php';
require_once '../Model/UnidadNegocio.php';
$unidad_negocio = new UnidadNegocio();

try {
    switch ($_GET['uni_negocio']) {

        case 'insert_unidad_negocio':
            $unidad_negocio->insert_unidad_negocio($_POST['cliente_id'], $_SESSION['empresa_id'], $_POST['uninegocio_nombre']);
            break;

        case 'insert_sector':
            $unidad_negocio->insert_sector($_POST['cliente_id'], $_SESSION['empresa_id'], $_POST['uninegocio_nombre']);
            break;

        case 'get_unidad_negocio':
            echo json_encode($unidad_negocio->get_unidad_negocio($_POST['id'], $_POST['cliente_id']));
            break;

        case 'get_unidades_negocio':
            $datos = $unidad_negocio->get_unidades_negocio($_POST['cliente_id']);
            $results = array();
            if (is_array($datos) && count($datos) > 0) {
                foreach ($datos as $row) {
                    $sub_array = array();
                    $sub_array[] = '<span class="badge" style="font-size:.9em">'.$row['uninegocio_nombre'].'</span>';;
                    $sub_array[] = '<div class="btn-group p-0 btn-group-sm">
                    <button type="button" class="btn btn-sm py-0 btn-default">Editar</button>
                    <button type="button" class="btn btn-sm py-0 btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item py-0 m-0" type="button" onclick="edit_estado_uniNegocio(' . $row['id'] . ')">Renombrar</a>
                    </div>
                  </div>';
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

        case 'select_get_unidades_negocio':
            $html = '';
            $dato = $unidad_negocio->get_unidades_negocio($_POST['cliente_id']);
            foreach ($dato as $key => $row) {
                $html .= '<option value="' . $row['id'] . '">' . $row['uninegocio_nombre'] . '</option>';
            }
            echo $html;
            break;

        case 'update_unidad_negocio_sector':
            $unidad_negocio->update_unidad_negocio_sector($_POST['uninegocio_id'], $_POST['cliente_id']);
            break;

        case 'update_unidad_negocio_nombre':
            $unidad_negocio->update_unidad_negocio_nombre($_POST['uninegocio_nombre'],$_POST['id'], $_POST['cliente_id']);
            break;

        default:
            echo "Error ctrUnidadNegocio";
            break;
    }
} catch (\PDOException $e) {
    echo "Error" . $e->getMessage();
}
