<?php

class Empresa extends Conexion
{
    public function consultar_partners()
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM empresa";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_count_total_empresas()
    {
        $conn = parent::conectar();
        $sql = "SELECT COUNT(*) as total FROM empresa";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_count_total_empresas_alta()
    {
        $conn = parent::conectar();
        $sql = "SELECT COUNT(*) as total FROM empresa WHERE empresa_est = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_count_total_empresas_baja()
    {
        $conn = parent::conectar();
        $sql = "SELECT COUNT(*) as total FROM empresa WHERE empresa_est = 0";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function agregar_empresa($usuario_empresa_creador, $empresa_nombre, $empresa_cuit, $empresa_razon_social)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO empresa(root_id,usuario_empresa_creador,empresa_nombre, empresa_cuit, empresa_razon_social, empresa_est) VALUES (0,?,?,?,?,1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $usuario_empresa_creador, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_nombre, PDO::PARAM_STR);
        $stmt->bindValue(3, $empresa_cuit, PDO::PARAM_STR);
        $stmt->bindValue(4, $empresa_razon_social, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update_inactivar_empresa($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE empresa SET empresa_est = 0 WHERE empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update_activar_empresa($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE empresa SET empresa_est = 1 WHERE empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function logs_empresas_partners($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT logs_partners_empresas.*, usuario_empresa.empresa_id,usuario_empresa.email_usuario_empresa,
        empresa.empresa_nombre,empresa.empresa_razon_social FROM logs_partners_empresas 
        INNER JOIN usuario_empresa ON logs_partners_empresas.usuario_empresa_id=usuario_empresa.usuario_empresa_id
        INNER JOIN empresa ON logs_partners_empresas.empresa_id=empresa.empresa_id 
        WHERE usuario_empresa.empresa_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function logs_usuarios_empresas_partners($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT 
    logs_usuarios_empresa.*, 
    ue1.empresa_id AS empresa_id_creador, 
    ue1.email_usuario_empresa AS email_creador, 
    empresa.empresa_nombre, 
    em1.empresa_nombre AS partner, 
    empresa.empresa_razon_social, 
    ue2.empresa_id AS empresa_id_pasivo, 
    ue2.email_usuario_empresa AS email_pasivo 
FROM 
    logs_usuarios_empresa 
INNER JOIN 
    usuario_empresa AS ue1 
    ON logs_usuarios_empresa.usuario_empresa_creador = ue1.usuario_empresa_id 
INNER JOIN 
    empresa 
    ON ue1.empresa_id = empresa.empresa_id 
INNER JOIN 
    usuario_empresa AS ue2 
    ON logs_usuarios_empresa.usuario_empresa_pasivo = ue2.usuario_empresa_id 
INNER JOIN 
    empresa AS em1 
    ON ue2.empresa_id = em1.empresa_id 
WHERE 
    logs_usuarios_empresa.empresa_id = ? 
LIMIT 0, 25";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_datos_empresa($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT empresa.*, COUNT(usuario_empresa.empresa_id) AS total_usuarios FROM empresa 
        LEFT JOIN usuario_empresa ON empresa.empresa_id = usuario_empresa.empresa_id 
        WHERE empresa.empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
