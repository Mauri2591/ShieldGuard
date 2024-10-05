<?php
require_once '../../Config/Conexion.php';
require_once '../Model/Escaneo.php';
$date = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
$escaneo = new Escaneo();

try {
    switch ($_GET['escan']) {
        case 'gestionar_nuevo_escaneo':
            $escaneo->gestionar_nuevo_escaneo($_POST['cliente_id'], $_SESSION['usuario_empresa_id'], $_POST['escaneo_titulo'], $_POST['tipo_gestion'], $_POST['escaneo_fecha']);
            break;

        case 'get_creacion_escaneo':
            $datos = $escaneo->get_creacion_escaneo($_POST['cliente_id']);
            $data = array();
            // Definición del estado del escaneo
            $estado_escaneo = [
                1 => "<span class='badge border border-secondary text-secondary'>Creado</span>",
                2 => "<span class='badge border border-info text-info'>Assets Agregados</span>",
                3 => "<span class='badge border border-warning bg-warning text-dark' style='display: inline-flex; align-items: center;'>
                En Proceso
                <i class='spinner-border' style='width: 1rem; height: 1rem; margin-left: 5px; padding:0' role='status'>
                    <span class='sr-only'>En Proceso...</span>
                </i>
              </span>",

                4 => "<span class='badge border border-success text-success'>En Espera</span>",
                5 => "<span class='badge bg-danger'>Cancelado</span>",
                6 => "<span class='badge bg-success'>Finalizado</span>"
            ];
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = '<span class="badge" style="font-size:.9em">' . $row['tipo_gestion'] . '</span>';
                $sub_array[] = '<span class="badge" style="font-size:.9em">' . $row['escaneo_titulo'] . '</span>';
                $sub_array[] = '<span class="badge" style="font-size:.9em">' . $row['email_usuario_empresa'] . '</span>';
                $sub_array[] = '<span class="badge" style="font-size:.9em">' . $row['escaneo_fecha'] . '</span>';
                $sub_array[] = $row['id_estado_escaneo'] == 1 ? '<div class="btn-group p-0 btn-group-sm">
                        <button type="button" class="btn btn-sm py-0 btn-default" data-toggle="tooltip"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-sm py-0 btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item py-0 m-0" type="button" onclick="agregar_activos_ips_urls(' . $row['id'] . ')">Agregar Activos</a>
                        </div>
                      </div>' : '<div class="btn-group p-0 btn-group-sm">
                        <button type="button" class="btn btn-sm py-0 btn-default" data-toggle="tooltip" data-placement="top" title="Ver Assets" onclick="verAssetsAgregador(' . $row['id'] . ')"><i class="fas fa-eye"></i></button>';
                $sub_array[] = '<span><i class="fas fa-eye text-secondary" style="font-size:1.2em" type="button" onclick="verDetalleEscaneo(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Ver detalle del escaneo"></i></span>';
                $sub_array[] = $estado_escaneo[$row['id_estado_escaneo']];
                switch ($row['id_estado_escaneo']) {
                    case 1:
                        $sub_array[] = '<span><i class="fas fa-play text-secondary" style="font-size:1.2em" type="button" disabled data-toggle="tooltip" data-placement="top" title="Debe agregar las Ips/Urls"></i></span>';
                        break;
                    case 2:
                        $sub_array[] = '<span><i class="fas fa-play text-primary" style="font-size:1.2em" type="button" data-toggle="tooltip" data-placement="top" onclick="btn_lanzar_escaneo(' . $row['id'] . ')" title="Lanzar Escaneo"></i></span>';
                        break;
                    case 3:
                        $sub_array[] = '<span><i class="fas fa-caret-square-right text-warning" style="font-size:1.4em" type="button" data-toggle="tooltip" data-placement="top" onclick="btn_escaneo_en_proceso(' . $row['id'] . ')" title="En Proceso"></i></span>';
                        break;
                    case 4:
                        $sub_array[] = '<span><i class="fas fa-caret-square-right text-danger" style="font-size:1.4em" type="button" disabled data-toggle="tooltip" data-placement="top" title="Debe agregar las Ips/Urls"></i></span>';
                        break;
                    case 5:
                        $sub_array[] = '<span><i class="fas fa-caret-square-right text-danger" style="font-size:1.4em" type="button" disabled data-toggle="tooltip" data-placement="top" title="Debe agregar las Ips/Urls"></i></span>';
                        break;
                    default:
                        echo "Ningún valor coincide en el switch para el estado del escaneo.";
                        break;
                };
                switch ($row['id_estado_escaneo']) {
                    case 1:
                        $sub_array[] = '<span><i class="fas fa-trash text-danger" style="font-size:1.2em" type="button" onclick="eliminarEscaneo(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top"></i></span>';
                        break;
                    case 2:
                        $sub_array[] = '<span><i class="fas fa-trash text-danger" style="font-size:1.2em" type="button" onclick="eliminarEscaneo(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top"></i></span>';
                        break;
                    case 3:
                        $sub_array[] = '<span><i class="fas fa-trash text-secondary" style="font-size:1.2em" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" title="No se puede eliminar en esta etapa"></i></span>';
                        break;
                    case 4:
                        $sub_array[] = '<span><i class="fas fa-trash text-secondary" style="font-size:1.2em" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" title="No se puede eliminar en esta etapa"></i></span>';
                        break;
                    case 5:
                        $sub_array[] = '<span><i class="fas fa-trash text-danger" style="font-size:1.2em" type="button" onclick="eliminarEscaneo(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top"></i></span>';
                        break;
                    case 6:
                        $sub_array[] = '<span><i class="fas fa-trash text-danger" style="font-size:1.2em" type="button" onclick="eliminarEscaneo(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top"></i></span>';
                        break;
                    default:
                        echo "Ningún valor coincide en el switch para el estado del escaneo.";
                        break;
                };
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

        case 'get_assets_escaneo':
            $data = $escaneo->get_assets_escaneo($_POST['id']);
?>
<div class="row">
    <div class="col-sm-6">
        <span class="badge bg-light border text-dark">Ips</span>
        <textarea class="form-control" style="font-size: .8em; font-weight:bold" rows="6"
            disabled=""><?php echo  $data->ips; ?></textarea>
    </div>
    <div class="col-sm-6">
        <span class="badge bg-light border text-dark">Urls</span>
        <textarea class="form-control" style="font-size: .8em; font-weight:bold" rows="6"
            disabled=""><?php echo $data->urls; ?></textarea>
    </div>
    <?php
                break;

            case 'insert_ips_escaneo_nombre':
                // Asegúrate de que $_POST['ips_id'] es un array
                if (isset($_POST['ips_id']) && is_array($_POST['ips_id'])) {
                    foreach ($_POST['ips_id'] as $ips_id) {
                        $escaneo->insert_ips_escaneo_nombre($_POST['escaneo_id'], $ips_id);
                    }
                }
                break;

            case 'insert_urls_escaneo_nombre':
                // Asegúrate de que $_POST['urls_id'] es un array
                if (isset($_POST['urls_id']) && is_array($_POST['urls_id'])) {
                    foreach ($_POST['urls_id'] as $urls_id) {
                        $escaneo->insert_urls_escaneo_nombre($_POST['escaneo_id'], $urls_id);
                    }
                }
                break;

            case 'insert_nuevo_escaneo_historial_escaneos':
                $escaneo->insert_nuevo_escaneo_historial_escaneos($_POST['escaneo_id'], $_POST['id_estado_escaneo']);
                break;


            case 'get_historial_escaneo_nombre':
                $data = $escaneo->get_historial_escaneo_nombre($_POST['escaneo_id']);
                $estado_escaneo = [1 => "<span class='badge border border-secondary text-secondary'>Creado</span>", 2 => "<span class='badge border border-info text-info'>Assets Agregados</span>", 3 => "<span class='badge border border-primary text-primary'>En Proceso</span>", 4 => "<span class='badge border border-success text-success'>En Espera</span>", 5 => "<span class=badge bg-danger>Cancelado</span>", 6 => "<span class=badge bg-success>Finalizado</span>"];
                foreach ($data as $key => $row) {
                ?>
    <div class="timeline">
        <div class="time-label">
            <span class="bg-red py-0"
                style="font-size: .8em;"><?php echo date('d-m-Y', strtotime($row['fecha_estado'])) ?></span>
        </div>
        <div>
            <i class="fas fa-clock bg-blue"></i>
            <div class="timeline-item">
                <span class="time"><i
                        class="fas fa-clock"></i><?php echo date('H:i:s', strtotime($row['fecha_estado'])) ?></span>
                <h3 class="timeline-header"><?php echo $estado_escaneo[$row['id_estado_escaneo']]; ?></h3>
            </div>
        </div>
    </div>
</div>
<?php
                }
                break;

            case 'disabled_escanner':
                $escaneo->disabled_escanner($_POST['id']);
                break;

            default:
                echo "Error, ninguna opcion disponible";
                break;
        }
    } catch (\PDOException $e) {
        echo "Error" . $e->getMessage();
    }