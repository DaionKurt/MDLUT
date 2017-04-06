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
include('../Entidades/Paciente.php');
session_start();
require('gestorBD.php');
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$request = json_decode(file_get_contents("php://input"));
$nombre = $request->nombre;
$apellido = $request->apellido;
$correo = $request->correo;
$usuario = $request->usuario;
$pass = $request->pass;
$telefono = $request->telefono;
$sexo = $request->sexo;
$edad = $request->edad;
$fecha_nacimiento = $request->fecha_nacimiento;
$aux_a = substr($fecha_nacimiento,0,4);
$aux_b = substr($fecha_nacimiento,5,2);
$aux_c = substr($fecha_nacimiento,8,2);
$fecha_nacimiento = $aux_c."/".$aux_b."/".$aux_a;
$sql = "INSERT INTO Usuario(nombre,apellido,sexo,fecha_nacimiento,telefono,edad,usuario,correo,pass)
 VALUES ('$nombre','$apellido','$sexo','$fecha_nacimiento','$telefono','$edad','$usuario','$correo','$pass');";
try{
    $stmt = $conexion->query($sql);
    $conexion = null;
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}