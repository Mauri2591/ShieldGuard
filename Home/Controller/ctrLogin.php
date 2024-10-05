<?php
require_once '../../Config/Conexion.php';
require_once '../Model/Login.php';
$login=new Login();

if(isset($_SERVER) && $_SERVER["REQUEST_METHOD"] == "POST"){
    $password_usuario_empresa=$_POST['password_usuario_empresa'];
    $email_usuario_empresa=$_POST['email_usuario_empresa'];
    $login->login($email_usuario_empresa,$password_usuario_empresa);
    echo $email_usuario_empresa,$password_usuario_empresa;
}