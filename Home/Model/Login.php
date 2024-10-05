<?php
class Login extends Conexion
{
    public function login($email_usuario_empresa, $password_usuario_empresa)
    {
        $conn = parent::conectar();
        $sql = "SELECT usuario_empresa.*, empresa.* FROM usuario_empresa LEFT JOIN empresa ON usuario_empresa.empresa_id=empresa.empresa_id WHERE email_usuario_empresa = ? AND usuario_empresa_est = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $email_usuario_empresa);
        $stmt->execute();
        $resul = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resul) {
            $hash = $resul['password_usuario_empresa'];
            if (password_verify($password_usuario_empresa, $hash)) {
                session_regenerate_id(true); // Regenerar el ID de la sesión para prevenir fijación de sesión
                //Sesiones de usuario_empresa
                $_SESSION['usuario_empresa_id'] = $resul['usuario_empresa_id'];
                $_SESSION['rol_id'] = $resul['rol_id'];
                $_SESSION['usuario_empresa_creador'] = $resul['usuario_empresa_creador'];
                $_SESSION['empresa_id'] = $resul['empresa_id'];
                $_SESSION['email_usuario_empresa'] = $resul['email_usuario_empresa'];
                $_SESSION['password_usuario_empresa'] = $resul['password_usuario_empresa'];
                $_SESSION['usuario_empresa_fecha_creacion'] = $resul['usuario_empresa_fecha_creacion'];
                $_SESSION['usuario_empresa_est'] = $resul['usuario_empresa_est'];
                //Sesiones de empresa
                $_SESSION['root_id'] = $resul['root_id'];
                $_SESSION['empresa_nombre'] = $resul['empresa_nombre'];
                $_SESSION['empresa_cuit'] = $resul['empresa_cuit'];
                $_SESSION['empresa_razon_social'] = $resul['empresa_razon_social'];
                $_SESSION['empresa_est'] = $resul['empresa_est'];
                header("Location:" . URL . "/Home/View/");
                exit;
            } else {
                header("Location:" . URL);
                echo "Error 1";
                exit;
            }
        } else {
            header("Location:" . URL);
            echo "Error 2";
            exit;
        }
    }
}
