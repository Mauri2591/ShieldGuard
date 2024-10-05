<?php
session_start();
define("URL","http://127.0.0.1/shieldguard");
define("KEY","ThisIsASecureKey1234567890ABCDEF"); //Con 4 caracteres funciona correctamente, si le agrego mas se rompe, despues lo averiguo
define("AES","AES-256-ECB");

class Conexion
{
    protected $conectar;
    protected function conectar()
    {
        try {
            $conn = $this->conectar = new PDO("mysql:host=localhost;dbname=shieldguard", "root", "");
            return $conn;
        } catch (\Exception $e) {
            echo "Error de conexion " . $e->getMessage();
            die();
        }
    }
}
