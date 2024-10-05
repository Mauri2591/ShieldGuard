<?php

class UsuarioEmpresa extends Conexion
{
    public function get_total_usuarios_empresa($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT COUNT(*) as total FROM usuario_empresa WHERE empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_rol_para_usuario()
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM rol WHERE rol_est = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function crear_usuario_empresa($rol_id, $usuario_empresa_creador, $empresa_id, $email_usuario_empresa, $password_usuario_empresa)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO usuario_empresa (rol_id,usuario_empresa_creador,empresa_id,email_usuario_empresa, password_usuario_empresa, usuario_empresa_est) VALUES (?,?,?,?,?,1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $rol_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $usuario_empresa_creador, PDO::PARAM_INT);
        $stmt->bindValue(3, $empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(4, htmlspecialchars($email_usuario_empresa,ENT_QUOTES), PDO::PARAM_STR);
        $stmt->bindValue(5, password_hash($password_usuario_empresa, PASSWORD_DEFAULT), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function crear_usuario_partner($rol_id, $usuario_empresa_creador, $empresa_id, $email_usuario_empresa, $password_usuario_empresa)
    {
        $conn = parent::conectar();
        $sql = "INSERT INTO usuario_empresa (rol_id,usuario_empresa_creador,empresa_id,email_usuario_empresa, password_usuario_empresa, usuario_empresa_est) VALUES (?,?,?,?,?,1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $rol_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $usuario_empresa_creador, PDO::PARAM_INT);
        $stmt->bindValue(3, $empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(4, htmlspecialchars($email_usuario_empresa,ENT_QUOTES), PDO::PARAM_STR);
        $stmt->bindValue(5, password_hash($password_usuario_empresa, PASSWORD_DEFAULT), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function get_consultar_usuarios_mi_empresa($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM usuario_empresa WHERE empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_consultar_usuarios_partner($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT * FROM usuario_empresa WHERE empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setear_password_usuario_empresa($password_usuario_empresa, $usuario_empresa_id, $empresa_id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE usuario_empresa SET password_usuario_empresa = ? WHERE usuario_empresa_id = ? AND empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, password_hash($password_usuario_empresa, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue(2, $usuario_empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(3, $empresa_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function desactivar_usuario_empresa($usuario_empresa_id, $empresa_id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE usuario_empresa SET usuario_empresa_est = 0 WHERE usuario_empresa_id = ? AND empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $usuario_empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function activar_usuario_empresa($usuario_empresa_id, $empresa_id)
    {
        $conn = parent::conectar();
        $sql = "UPDATE usuario_empresa SET usuario_empresa_est = 1 WHERE usuario_empresa_id = ? AND empresa_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $usuario_empresa_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $empresa_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function logs_usuarios($empresa_id)
    {
        $conn = parent::conectar();
        $sql = "SELECT 
        logs_usuarios_empresa.*, 
        creador.email_usuario_empresa AS email_creador, 
        pasivo.email_usuario_empresa AS email_pasivo
    FROM 
        logs_usuarios_empresa
    INNER JOIN 
        usuario_empresa AS creador 
        ON creador.usuario_empresa_id = logs_usuarios_empresa.usuario_empresa_creador
    INNER JOIN 
        usuario_empresa AS pasivo 
        ON pasivo.usuario_empresa_id = logs_usuarios_empresa.usuario_empresa_pasivo
    WHERE 
        logs_usuarios_empresa.empresa_id = ? ORDER BY logs_usuarios_empresa.fech_crea DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresa_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
