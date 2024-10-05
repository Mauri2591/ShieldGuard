<?php
require_once '../../Config/Conexion.php';
require_once '../Model/Sector.php';
$sector = new Sector();

try {
    switch ($_GET['sector']) {

        case 'insert_sector':
            $sector->insert_sector($_SESSION['empresa_id'], $_POST['cliente_id'], $_POST['uninegocio_id'], $_POST['sector_nombre']);
            break;

        case 'get_sector':
            echo json_encode($sector->get_sector($_POST['id'], $_POST['cliente_id']));
            break;

        case 'update_sector':
            echo json_encode($sector->update_sector($_POST['est'], $_POST['id']));
            break;

        case 'get_sectores':
            $datos = $sector->get_sectores($_POST['cliente_id']);
            $results = array();
            if (is_array($datos) && count($datos) > 0) {
                foreach ($datos as $row) {
                    $sub_array = array();
                    $sub_array[] = '<span class="badge" style="font-size:.9em">'.$row['sector_nombre'].'</span>';;
                    $sub_array[] = '<span class="badge" style="font-size:.9em">'.$row['uninegocio_nombre'].'</span>';;
                    $sub_array[] = $row['est'] == 1 ? '<span class="badge bg-success text-light">Activo</span>' : '<span class="badge bg-secondary text-light">Inactivo</span>';
                    $sub_array[] = '<div class="btn-group p-0 btn-group-sm">
                    <button type="button" class="btn btn-sm py-0 btn-default">Editar</button>
                    <button type="button" class="btn btn-sm py-0 btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" type="button" onclick="edit_estado_sector(' . $row['id'] . ')">Estado</a>
                      <a class="dropdown-item" type="button" onclick="edit_uniNegocio_sector(' . $row['id'] . ')">Unidad de Negocio</a>
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

        default:
            echo "Error ctrSector";
            break;
    }
} catch (\PDOException $e) {
    echo "Error" . $e->getMessage();
}
