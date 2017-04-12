<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 27/03/2017
 * Time: 01:25 PM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
require('gestorBD.php');
include('../Entidades/Usuario.php');
include('../Entidades/Paciente.php');
include('../Entidades/Medico.php');
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$JSON       = file_get_contents("php://input");
$request    = json_decode($JSON);
$id    =        $_SESSION['usuario'];
$pass =         $request->pass;
$nueva_pass =   $request->nueva;
$telefono =     $request->telefono;
$correo =       $request->correo;
$sql =     "SELECT * FROM usuario WHERE usuario.id_usuario = '$id' AND usuario.pass= '$pass'";
try{
    $stmt = $conexion->query($sql);
    if ($stmt->rowCount()>=1) {
        $datos_u = $stmt->fetch(PDO::FETCH_ASSOC);
        $cambio_pass = false;
        $cambio_telefono = false;
        $cambio_correo = false;
        $objeto = unserialize($_SESSION['objeto']);
        $str = "";
        if ($datos_u['pass'] !== $nueva_pass) {
            $str = "pass = '$nueva_pass'";
            $cambio_pass = true;
        }
        if ($datos_u['telefono'] !== $telefono) {
            $str .= ($cambio_pass) ? ",telefono = '$telefono'" : "telefono = '$telefono'";
            $objeto->set_telefono($telefono);
            $cambio_telefono = true;
        }
        if ($datos_u['correo'] !== $correo) {
            $str .= ($cambio_pass || $cambio_telefono) ? ",correo = '$correo'" : "correo = '$correo'";
            $objeto->set_correo($correo);
            $cambio_correo = true;
        }
        if ($cambio_correo || $cambio_telefono || $cambio_pass) {
            $update = "UPDATE usuario SET " . $str . " WHERE id_usuario = '$id';";
            $success = $conexion->query($update);
            $_SESSION['objeto'] = serialize($objeto);
        }
        echo '{"pass":"' . $pass . '","nueva":"' . $nueva_pass . '","telefono":"' . $telefono . '","correo":"' . $correo . '"}';
    }else{
        echo '{"Error":"-1"}';
    }
    $conexion = null;
}catch(PDOException $e){
    echo '{"error":{"error":"error"}}';
}