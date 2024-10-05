<?php
require_once '../../Config/Conexion.php';

$url_api = "https://services.nvd.nist.gov/rest/json/cves/2.0";

switch ($_GET['op_api']) {

    case 'get_vulnerability_details_pruebas':
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($ch);
        curl_close($ch);
        $datos = json_decode($resp, true);
        $data = $datos['vulnerabilities'];
        echo json_encode($data);
        // foreach ($datos as $key => $row) {
        //     echo $row['cve']['id'] . "<br>";
        //     echo $row['cve']['sourceIdentifier'] . "<br>";
        //     echo $row['cve']['published'] . "<br>";

        //     if (isset($row['cve']['metrics']['cvssMetricV2'])) {
        //         foreach ($row['cve']['metrics']['cvssMetricV2'] as $key2 => $metric) {
        //             echo "Source: " . $metric['source'] . "<br>";
        //             echo "Type: " . $metric['type'] . "<br>";
        //             echo "Version: " . $metric['cvssData']['version'] . "<br>";
        //             echo "Vector String: " . $metric['cvssData']['vectorString'] . "<br>";
        //             echo "Access Vector: " . $metric['cvssData']['accessVector'] . "<br>";
        //             echo "Access Complexity: " . $metric['cvssData']['accessComplexity'] . "<br>";
        //             echo "Authentication: " . $metric['cvssData']['authentication'] . "<br>";
        //             echo "Confidentiality Impact: " . $metric['cvssData']['confidentialityImpact'] . "<br>";
        //             echo "Integrity Impact: " . $metric['cvssData']['integrityImpact'] . "<br>";
        //             echo "Availability Impact: " . $metric['cvssData']['availabilityImpact'] . "<br>";
        //             echo "Base Score: " . $metric['cvssData']['baseScore'] . "<br>";
        //             echo "Base Severity: " . $metric['baseSeverity'] . "<br>";
        //             echo "Exploitability Score: " . $metric['exploitabilityScore'] . "<br>";
        //             echo "Impact Score: " . $metric['impactScore'] . "<br>";
        //             echo "AC Insufficient Info: " . ($metric['acInsufInfo'] ? 'Yes' : 'No') . "<br>";
        //             echo "Obtain All Privilege: " . ($metric['obtainAllPrivilege'] ? 'Yes' : 'No') . "<br>";
        //             echo "Obtain User Privilege: " . ($metric['obtainUserPrivilege'] ? 'Yes' : 'No') . "<br>";
        //             echo "Obtain Other Privilege: " . ($metric['obtainOtherPrivilege'] ? 'Yes' : 'No') . "<br>";
        //             echo "User Interaction Required: " . ($metric['userInteractionRequired'] ? 'Yes' : 'No') . "<br>";
        //         }
        //     }
        // }
        break;


    case 'get_vulnerability_total':
        function convertir_fecha($fecha)
        {
            $fecha = substr($fecha, 0, 19);
            $datetime = new DateTime($fecha);
            return $datetime->format('d-m-Y');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($ch);
        curl_close($ch);
        if ($resp === false) {
            echo json_encode(['error' => 'Error en la solicitud cURL: ' . curl_error($ch)]);
            exit;
        }
        $datos = json_decode($resp, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['error' => 'Error al decodificar la respuesta JSON']);
            exit;
        }
        if (isset($datos['vulnerabilities'])) {
            $datos = $datos['vulnerabilities'];
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = isset($row['cve']['id']) ? $row['cve']['id'] : 'N/A';
                $sub_array[] = isset($row['cve']['lastModified']) ? convertir_fecha($row['cve']['lastModified']) : 'N/A';
                $sub_array[] = isset($row['cve']['vulnStatus']) ? $row['cve']['vulnStatus'] : 'N/A';
                $vectorString = 'N/A';
                if (isset($row['cve']['metrics']['cvssMetricV2'])) {
                    foreach ($row['cve']['metrics']['cvssMetricV2'] as $row2) {
                        if (isset($row2['cvssData']['vectorString'])) {
                            $vectorString = $row2['cvssData']['vectorString'];
                            break;
                        }
                    }
                }
                $sub_array[] = $vectorString;
                $sub_array[] = isset($row['cve']['id']) ? '<span type="button" onclick="ver_cve(\'' . $row['cve']['id'] . '\')" class="right badge badge-danger"><i class="fa fa-eye"></i></span>' : 'N/A';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);
        } else {
            echo json_encode(['error' => 'No se encontraron vulnerabilidades']);
        }
        break;

    case 'get_vulnerability_details':
        if (isset($_POST['id'])) {
            $url_params = $url_api . "?cveId=" . $_POST['id'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_params);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $resp = curl_exec($ch);
            curl_close($ch);

            if ($resp === false) {
                echo json_encode(['error' => 'Error en la solicitud cURL: ' . curl_error($ch)]);
                exit;
            }

            $datos = json_decode($resp, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['error' => 'Error al decodificar la respuesta JSON']);
                exit;
            }

            echo json_encode($datos);
        } else {
            echo json_encode(['error' => 'No se proporcionó un ID de CVE']);
        }
        break;


    default:
        echo json_encode(['error' => 'Operación no válida']);
        break;
}
