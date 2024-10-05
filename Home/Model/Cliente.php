<?php
class Cliente extends Conexion
{

    public function get_tipo_cliente()
    { //De la tabla tipo_cliente para saber si es cuil o cuit
        $conn = parent::conectar();
        $sql = "SELECT * FROM tipo_cliente WHERE est=1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_nuevo_cliente($cliente_id_root, $empresa_id, $id_tipo_cliente, $cliente_cuit_cuil, $cliente_nombre, $cliente_razon_social)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO cliente (cliente_id_root,empresa_id,id_tipo_cliente,cliente_cuit_cuil,cliente_nombre,cliente_razon_social,fecha_creacion,cliente_est) VALUES (?,?,?,?,?,?,now(),1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id_root, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(3, $id_tipo_cliente, PDO::PARAM_INT);
        $stmt->bindValue(4, $cliente_cuit_cuil, PDO::PARAM_STR);
        $stmt->bindValue(5, $cliente_nombre, PDO::PARAM_STR);
        $stmt->bindValue(6, $cliente_razon_social, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_total_cliente($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM cliente WHERE empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_total_clientes_iconos($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "  SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN cliente_est = 1 THEN 1 ELSE 0 END) as total_activos,
            SUM(CASE WHEN cliente_est = 0 THEN 1 ELSE 0 END) as total_inactivos
        FROM cliente 
        WHERE empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_estado_cliente($cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT CASE WHEN cliente_est=1 THEN 'Activo' 
                            WHEN cliente_est=0 THEN 'Inactivo' 
                            END AS cliente_estado 
                            FROM cliente WHERE cliente_id=?";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1,$cliente_id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update_cliente_inactivar($cliente_id, $empresa_id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE cliente SET cliente_est = 0 WHERE cliente_id = ? AND empresa_id = ? AND cliente_est = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update_cliente_activar($cliente_id, $empresa_id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE cliente SET cliente_est = 1 WHERE cliente_id = ? AND empresa_id = ? AND cliente_est = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function get_datos_cliente($cliente_id, $empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM cliente WHERE cliente_id = ? AND empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
