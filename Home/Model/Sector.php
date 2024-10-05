<?php
class Sector extends Conexion
{

    public function insert_sector($empresa_id, $cliente_id,$uninegocio_id, $sector_nombre)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO sector (empresa_id,cliente_id,uninegocio_id,sector_nombre,est) values (?,?,?,?,1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(3, $uninegocio_id, PDO::PARAM_INT);
        $stmt->bindValue(4, htmlspecialchars($sector_nombre,ENT_QUOTES), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function get_sectores($cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT sector.*,empresa.empresa_nombre,unidad_negocio.uninegocio_nombre 
        FROM sector INNER JOIN empresa ON sector.empresa_id=empresa.empresa_id 
        INNER JOIN unidad_negocio ON sector.uninegocio_id=unidad_negocio.id 
        WHERE sector.cliente_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_sector($id,$cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM sector WHERE id=? AND cliente_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->bindValue(2, $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update_sector($est,$id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE sector SET est = ? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $est, PDO::PARAM_INT);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
