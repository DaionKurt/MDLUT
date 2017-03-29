<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 28/03/2017
 * Time: 05:31 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
require('gestorBD.php');
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$JSON       = file_get_contents("php://input");
$request    = json_decode($JSON);
$tabla      = $request->tabla;
$elemento    = $request->elemento;
$sql =     "SELECT * FROM $tabla WHERE '$elemento' = '$usuario'";
try{
    $stmt = $conexion->query($sql);
    $resultado = $stmt->fetchObject();
    $conexion = null;
    echo  json_encode($resultado);
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}