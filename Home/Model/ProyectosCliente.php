<?php

class ProyectoCliente extends Conexion
{
    public function get_ips_x_cliente($cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT id, cliente_id, ip FROM ips WHERE cliente_id = ? AND est=1";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(1,$cliente_id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_urls_x_cliente($cliente_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT id, cliente_id, url FROM urls WHERE cliente_id = ? AND est=1";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(1,$cliente_id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
