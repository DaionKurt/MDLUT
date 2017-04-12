<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 27/03/2017
 * Time: 01:25 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require('gestorBD.php');
$conexion   = get_connection_test();
$request    = json_decode(file_get_contents("php://input"));
$nombre     = $request->nombre;
$apellido   = $request->apellido;
$correo     = $request->correo;
$usuario    = $request->usuario;
$pass       = $request->pass;
$telefono   = $request->telefono;
$sexo       = $request->sexo;
$edad       = $request->edad;
$fecha_n    = $request->fecha_nacimiento;

$aux_a   = substr($fecha_n,0,4);
$aux_b   = substr($fecha_n,5,2);
$aux_c   = substr($fecha_n,8,2);
$fecha_n = $aux_c."/".$aux_b."/".$aux_a;

$sentencia=$conexion->prepare(
    "INSERT INTO Usuario(nombre,apellido,sexo,fecha_nacimiento,telefono,edad,usuario,correo,pass) 
               VALUES (:nombre,:apellido,:sexo,:fecha,:telefono,:edad,:usuario,:correo,:pass)");
$sentencia->bindParam(':nombre'     , $nombre,  PDO::PARAM_STR);
$sentencia->bindParam(':apellido'   , $apellido,PDO::PARAM_STR);
$sentencia->bindParam(':sexo'       , $sexo,    PDO::PARAM_STR);
$sentencia->bindParam(':fecha'      , $fecha_n, PDO::PARAM_STR);
$sentencia->bindParam(':telefono'   , $telefono,PDO::PARAM_STR);
$sentencia->bindParam(':edad'       , $edad,    PDO::PARAM_INT);
$sentencia->bindParam(':usuario'    , $usuario, PDO::PARAM_STR);
$sentencia->bindParam(':correo'     , $correo,  PDO::PARAM_STR);
$sentencia->bindParam(':pass'       , $pass,    PDO::PARAM_STR);

try{
    $sentencia->execute();
    $conexion = null;
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}