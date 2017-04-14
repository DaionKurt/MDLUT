<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 27/03/2017
 * Time: 01:25 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include('../Entidades/Usuario.php');
include('../Entidades/Administrador.php');
session_start();
require('gestorBD.php');
$conexion = get_connection_test();
$JSON       = file_get_contents("php://input");
$request    = json_decode($JSON);
$usuario    = $request->usuario;
$pass       = $request->pass;

$sentencia=$conexion->prepare("SELECT * FROM usuario WHERE usuario.usuario = :usuario AND usuario.pass = :pass");
$sentencia->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$sentencia->bindParam(':pass', $pass, PDO::PARAM_STR);

$admon=$conexion->prepare("SELECT administrador.clave,administrador.id_admon FROM usuario INNER JOIN administrador ON 
        usuario.id_usuario=administrador.no_usuario AND usuario.usuario=:usuario");
$admon->bindParam(':usuario', $usuario, PDO::PARAM_STR);

try{
    $sentencia->execute();
    $admon->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
    $activo_u = $usuario['activo'];
    $nombre_u = $usuario['nombre'];
    $apellido_u = $usuario['apellido'];
    $sexo_u = $usuario['sexo'];
    $fecha_nacimiento_u = $usuario['fecha_nacimiento'];
    $telefono_u = $usuario['fecha_nacimiento'];
    $edad_u = $usuario['edad'];
    $usuario_u = $usuario['usuario'];
    $correo_u = $usuario['correo'];
    $id_u = $usuario['id_usuario'];
    $img = $usuario['imagen'];
    $_SESSION['usuario'] = $id_u;
    $_SESSION['edad'] = $edad_u;
    $_SESSION['imagen'] = $img;
    if ($admon->rowCount() >= 1) {
        $administrador = $admon->fetch(PDO::FETCH_ASSOC);
        $clave = $administrador['clave'];
        $id_a = $administrador['id_admon'];
        $administrador_objeto = new \Entidades\Administrador($nombre_u, $apellido_u, $sexo_u, $fecha_nacimiento_u,
            $telefono_u, $edad_u, $usuario_u, $correo_u, $activo_u, $id_u,$clave,$id_a);
        $_SESSION['admon'] = $id_a;
        $_SESSION['clave'] = $clave;
        $_SESSION['objeto'] = serialize($administrador_objeto);
    }
    echo json_encode($usuario);
    $conexion = null;
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}