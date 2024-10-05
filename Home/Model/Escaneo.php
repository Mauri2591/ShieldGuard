<?php
try {
    class Escaneo extends Conexion
    {
        public function gestionar_nuevo_escaneo($cliente_id, $usuario_id, $escaneo_titulo, $tipo_gestion, $escaneo_fecha)
        {
            try {
                $conn = parent::conectar();
                $sql = "INSERT INTO escaneo (cliente_id,usuario_id,escaneo_titulo, tipo_gestion, escaneo_fecha,est) VALUES (?,?,?,?,?,1)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
                $stmt->bindValue(2, $usuario_id, PDO::PARAM_INT);
                $stmt->bindValue(3, $escaneo_titulo, PDO::PARAM_STR);
                $stmt->bindValue(4, $tipo_gestion, PDO::PARAM_STR);
                $stmt->bindValue(5, $escaneo_fecha, PDO::PARAM_STR);
                $stmt->execute();
            } catch (\PDOException $e) {
                echo "Error" . $e->getMessage();
                return false;
            } finally {
                $conn = null;
            }
        }

        public function get_historial_escaneo_nombre($escaneo_id)
        {
            try {
                $conn = parent::conectar();
                $sql = "SELECT historial_escaneos.*, estados_escaneos.estado_escaneo FROM historial_escaneos INNER JOIN estados_escaneos ON historial_escaneos.id_estado_escaneo=estados_escaneos.id WHERE historial_escaneos.escaneo_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $escaneo_id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                echo "Error" . $e->getMessage();
                return false;
            } finally {
                $conn = null;
            }
        }

        public function insert_ips_escaneo_nombre($escaneo_id, $ips_id)
        {
            try {
                $conn = parent::conectar();
                $sql = "INSERT INTO escaneo_ips (escaneo_id, ips_id) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $escaneo_id, PDO::PARAM_INT);
                $stmt->bindValue(2, $ips_id, PDO::PARAM_STR);
                $stmt->execute();
            } catch (\PDOException $e) {
                echo "Error" . $e->getMessage();
                return false;
            } finally {
                $conn = null;
            }
        }

        public function insert_urls_escaneo_nombre($escaneo_id, $urls_id)
        {
            try {
                $conn = parent::conectar();
                $sql = "INSERT INTO escaneo_urls (escaneo_id, urls_id) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $escaneo_id, PDO::PARAM_INT);
                $stmt->bindValue(2, $urls_id, PDO::PARAM_STR);
                $stmt->execute();
            } catch (\PDOException $e) {
                echo "Error" . $e->getMessage();
                return false;
            } finally {
                $conn = null;
            }
        }

        public function insert_nuevo_escaneo_historial_escaneos($escaneo_id, $id_estado_escaneo)
        {
            try {
                $conn = parent::conectar();
                $sql = "INSERT INTO historial_escaneos (escaneo_id, id_estado_escaneo) VALUES (?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $escaneo_id, PDO::PARAM_INT);
                $stmt->bindValue(2, $id_estado_escaneo, PDO::PARAM_INT);
                $stmt->execute();
            } catch (\PDOException $e) {
                echo "Error" . $e->getMessage();
                return false;
            } finally {
                $conn = null;
            }
        }

        public function get_creacion_escaneo($cliente_id)
        {
            try {
                $conn = parent::conectar();
                $sql = "SELECT DISTINCT escaneo.*, 
       usuario_empresa.email_usuario_empresa, 
       historial_escaneos.escaneo_id, 
       historial_escaneos.id_estado_escaneo, 
       historial_escaneos.fecha_estado, 
       estados_escaneos.estado_escaneo 
        FROM escaneo 
        LEFT JOIN usuario_empresa ON escaneo.usuario_id = usuario_empresa.usuario_empresa_id 
        LEFT JOIN historial_escaneos ON escaneo.id = historial_escaneos.escaneo_id 
        LEFT JOIN estados_escaneos ON historial_escaneos.id_estado_escaneo = estados_escaneos.id 
        WHERE escaneo.cliente_id = ? 
        AND historial_escaneos.fecha_estado = (
        SELECT MAX(h.fecha_estado) 
        FROM historial_escaneos h 
        WHERE h.escaneo_id = escaneo.id
        AND escaneo.est=1)
        ORDER BY escaneo.fecha_creacion DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                echo "Error" . $e->getMessage();
                return false;
            } finally {
                $conn = null;
            }
        }

        public function get_assets_escaneo($id)
        {
            try {
                $conn = parent::conectar();
                $sql = "SELECT 
                escaneo.*,
                GROUP_CONCAT(DISTINCT ips.ip) AS ips,
                GROUP_CONCAT(DISTINCT urls.url) AS urls
            FROM escaneo
            LEFT JOIN escaneo_ips ON escaneo.id = escaneo_ips.escaneo_id
            LEFT JOIN ips ON escaneo_ips.ips_id = ips.id
            LEFT JOIN escaneo_urls ON escaneo.id = escaneo_urls.escaneo_id
            LEFT JOIN urls ON escaneo_urls.urls_id = urls.id
            WHERE escaneo.id = ?
            GROUP BY escaneo.id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            } catch (\PDOException $e) {
                echo "Error " . $e->getMessage();
                return false;
            } finally {
                $conn = null;
            }
        }

        public function disabled_escanner($id)
        {
            try {
                $conn = parent::conectar();
                $sql = "UPDATE escaneo SET est=0 WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $id, PDO::PARAM_INT);
                $stmt->execute();
            } catch (\PDOException $e) {
                echo "Error " . $e->getMessage();
                return false;
            } finally {
                $conn = null;
            }
        }
    }
} catch (\PDOException $e) {
    echo "Error" . $e->getMessage();
    exit();
}
