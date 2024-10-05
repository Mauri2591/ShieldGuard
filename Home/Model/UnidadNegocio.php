<?php
class UnidadNegocio extends Conexion
{

    public function insert_unidad_negocio($cliente_id, $empresa_id, $uninegocio_nombre)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO unidad_negocio (cliente_id,empresa_id,uninegocio_nombre,est) values (?,?,?,1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_STR);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(3, htmlspecialchars($uninegocio_nombre,ENT_QUOTES), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function insert_sector($cliente_id, $empresa_id, $uninegocio_nombre)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO sector (cliente_id,empresa_id,uninegocio_nombre,est) values (?,?,?,1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_STR);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(3, htmlspecialchars($uninegocio_nombre,ENT_QUOTES), PDO::PARAM_STR);
        $stmt->execute();
    }

        public function get_unidad_negocio($id, $cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM unidad_negocio WHERE id=? AND cliente_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->bindValue(2, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_unidades_negocio($cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT id, uninegocio_nombre, est FROM unidad_negocio WHERE cliente_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_unidad_negocio_sector($uninegocio_id, $cliente_id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE sector SET uninegocio_id = ? WHERE cliente_id=? ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $uninegocio_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update_unidad_negocio_nombre($uninegocio_nombre,$id, $cliente_id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE unidad_negocio SET uninegocio_nombre = ? WHERE id=? AND cliente_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, htmlspecialchars($uninegocio_nombre,ENT_QUOTES), PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->bindValue(3, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
