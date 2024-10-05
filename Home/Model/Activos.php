<?php
class Activos extends Conexion
{
    public function get_datos_usuarios_cliente($cliente_id, $empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM usuarios_cliente WHERE cliente_id = ? AND empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insert_usuario_cliente($rol_id, $empresa_id, $cliente_id, $email_usuario_cliente, $password_usuario_cliente)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO usuario_cliente (rol_id,empresa_id,cliente_id,email_usuario_cliente,password_usuario_cliente,usuario_cliente_fecha_creacion,usuario_cliente_est) VALUES (?,?,?,?,?,NOW(),1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $rol_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(3, $empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(4, htmlspecialchars($email_usuario_cliente, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(5, password_hash($password_usuario_cliente, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_datos_cuentas_cliente($cliente_id, $empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM usuario_cliente WHERE cliente_id = ? AND empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_datos_cuentas_cliente_estados($cliente_id, $empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT SUM(CASE WHEN usuario_cliente_est = 1 THEN 1 ELSE 0 END) AS total_activos, 
                        SUM(CASE WHEN usuario_cliente_est = 0 THEN 1 ELSE 0 END) AS total_inactivos 
                        FROM usuario_cliente WHERE cliente_id = ? AND empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insert_ips($cliente_id,$ambiente_id, $ip)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO ips (cliente_id, ambiente_id, ip, fecha_creacion, est) VALUES (?,?,?,NOW(), 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $ambiente_id, PDO::PARAM_INT);
        $stmt->bindValue(3, htmlspecialchars($ip, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function get_ambientes()
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM ambientes WHERE est=1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_ips($cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM ips WHERE cliente_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_ip_x_id($id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM ips WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update_ips($ip, $id) //Hacer logs
    {
        $conn = parent::conectar();
        $sql = "UPDATE ips SET ip = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $ip, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function cambiar_estado_ip($est, $id) //Hacer logs
    {
        $conn = parent::conectar();
        $sql = "UPDATE ips SET est = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $est, PDO::PARAM_INT);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function get_cantidad_ips($cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT SUM(CASE WHEN est = 1 THEN 1 ELSE 0 END) AS total_activos, SUM(CASE WHEN est = 0 THEN 1 ELSE 0 END) AS total_inactivos FROM ips WHERE cliente_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insert_urls($cliente_id,$ambiente_id, $url)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO urls (cliente_id,ambiente_id, url, fecha_creacion, est) VALUES (?,?,?,NOW(), 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $ambiente_id, PDO::PARAM_INT);
        $stmt->bindValue(3, htmlspecialchars($url, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function get_urls($cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM urls WHERE cliente_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_url_x_id($id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM urls WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update_urls($url, $id) //Hacer logs
    {
        $conn = parent::conectar();
        $sql = "UPDATE urls SET url = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $url, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function cambiar_estado_url($est, $id) //Hacer logs
    {
        $conn = parent::conectar();
        $sql = "UPDATE urls SET est = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $est, PDO::PARAM_INT);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function get_cantidad_urls($cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT SUM(CASE WHEN est = 1 THEN 1 ELSE 0 END) AS total_activos, SUM(CASE WHEN est = 0 THEN 1 ELSE 0 END) AS total_inactivos FROM urls WHERE cliente_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
