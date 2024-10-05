<?php
require_once '../../Config/Conexion.php';
require_once '../Model/ProyectosCliente.php';
$proy = new ProyectoCliente();

try {
    switch ($_GET['proy']) {
        case 'get_ips_x_cliente':
            $html = '';
            $data = $proy->get_ips_x_cliente($_POST['cliente_id']);
            foreach ($data as $key => $row) {
                $html .= '<option value="'.$row['id'].'">' . $row['ip'] . '</option>';
            }
            echo $html;
            break;

        case 'get_urls_x_cliente':
            $html = '';
            $data = $proy->get_urls_x_cliente($_POST['cliente_id']);
            foreach ($data as $key => $row) {
                $html .= '<option value="'.$row['id'].'">' . $row['url'] . '</option>';
            }
            echo $html;
            break;
            
        default:
            echo "Error, ninguna opcion disponible";
            break;
    }
} catch (\PDOException $e) {
    echo "Error" . $e->getMessage();
}
